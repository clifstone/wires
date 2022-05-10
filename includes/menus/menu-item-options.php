<?php
function dropdown_category_fields($item_id, $item) {

	wp_nonce_field('dropdowncat_meta_nonce', '_dropdowncat_meta_nonce_name');
	$dropdowncat_meta = get_post_meta($item_id, '_dropdowncat_meta', true);

	?>

	<div class="field-dropdowncat_meta description-wide" style="padding:8px; margin:8px 0; background:#006699; box-sizing: border-box; border-radius:8px">

	    <p class="description" style="padding:4px; color:#FFFFFF;">
            <strong>Dropdown Category Slug</strong><br />
            <small style="font-size:10px;">To create a dropdown, put in your category slugs here</small>
        </p>

	    <input type="hidden" class="nav-menu-id" value="<?php echo $item_id ;?>" />

	    <div class="logged-input-holder">
	        <input type="text" name="dropdowncat_meta[<?php echo $item_id ;?>]" id="dropdowncat-<?php echo $item_id ;?>" value="<?php echo esc_attr($dropdowncat_meta); ?>" style="width:100%; color:#006699;" />
	        <label for="custom-menu-meta-for-<?php echo $item_id ;?>"></label>
	    </div>

	</div>

	<?php
}
add_action('wp_nav_menu_item_custom_fields', 'dropdown_category_fields', 10, 2);

function dropdown_category_fields_update($menu_id, $menu_item_db_id) {

	// Verify this came from our screen and with proper authorization.
	if (! isset($_POST['_dropdowncat_meta_nonce_name']) || ! wp_verify_nonce($_POST['_dropdowncat_meta_nonce_name'], 'dropdowncat_meta_nonce')) {
		return $menu_id;
	}

	if (isset($_POST['dropdowncat_meta'][$menu_item_db_id])) {
		$sanitized_data = sanitize_text_field($_POST['dropdowncat_meta'][$menu_item_db_id]);
		update_post_meta($menu_item_db_id, '_dropdowncat_meta', $sanitized_data);
	} else {
		delete_post_meta($menu_item_db_id, '_dropdowncat_meta');
	}
}
add_action('wp_update_nav_menu_item', 'dropdown_category_fields_update', 10, 2);

class mcMenuWalker extends Walker_Nav_Menu {
    
    function start_el(&$output, $item, $depth=0, $args=array(), $id = 0) {
    	$object = $item->object;
    	$type = $item->type;
    	$title = $item->title;
    	$description = $item->description;
    	$permalink = $item->url;

		$dropdowncat_meta = get_post_meta($item->ID, '_dropdowncat_meta', true);

		if($dropdowncat_meta){
			$output .= '<li class="'.implode(" ", $item->classes).' has-supernav">';
		}else{
			$output .= '<li class="'.implode(" ", $item->classes).'">';
		}
        
		if( $permalink && $permalink != '#' ) {
			$output .= '<a href="'.$permalink.'">';
		} else {
			$output .= '<span>';
		}

		$output .= $title;

		// if( $description != '' && $depth == 0 ) {
		// 	$output .= '<small class="description">' . $description . '</small>';
		// }

		if( $permalink && $permalink != '#' ) {
			$output .= '</a>';
		} else {
			$output .= '</span>';
		}

		if($dropdowncat_meta){

			$slugarr = preg_split('/(\s|,\s)/', $dropdowncat_meta);
			$rands = [];

			$output .= '<div class="supernav">
							<div class="wrapper grid"><ul class="supernav-options">';

			for ($x = 0; $x < count($slugarr); $x++){

				$mcRand = rand( 0 , 999999 );

				$derf = get_category_by_slug( $slugarr[$x] );

				if($x === 0){ $isactive = ''; }else{ $isactive = ''; }
				$output .= '<li class="supernav-option '.$isactive.'" data-id="'.$mcRand.'">
								<a href="'.home_url().'/'.'category/'.$slugarr[$x].'">'.$derf->name.'</a>
							</li>';
				array_push($rands, $mcRand);
			}

			$output .= '</ul>';

			if(!wp_is_mobile()){
				for ($y = 0; $y < count($slugarr); $y++){
					if($y === 0){ $isactive = ''; }else{ $isactive = ''; }
					$output .= '<div class="supernav-articles '.$isactive.'" data-id="'.$rands[$y].'">'.do_shortcode('[instalist category_name='.$slugarr[$y].' mw=false numofmobile=4 hasexcerpt="false" numofdesktop=4 gridclass="sm-4" rowclass="supernav-item" fwdbck=true]').'</div>';
				}
			}

			ob_start();

            ?>
                
            <?php 
            $rollScript = ob_get_contents();
        	ob_end_clean();

			$output .= $rollScript.'</div>
					</div>';
		}
    }
}