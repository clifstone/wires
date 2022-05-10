<?php

function ad_tag_store() {
    $labels = array(
        'name' => _x( 'AD TAGS', 'post type general name' ),
        'singular_name' => _x( 'Ad Tag', 'post type singular name' ),
    );
    $args = array(
        'labels' => $labels,
        'description' => 'Holds your ad tags',
        'public' => true,
        'supports' => array( 'title' ),
        'has_archive' => true,
        'menu_icon' => get_template_directory_uri().'/images/icons/ads.svg',
        'exclude_from_search' => true,
        'capabilities' => array(
            'edit_post'          => 'update_core',
            'read_post'          => 'update_core',
            'delete_post'        => 'update_core',
            'edit_posts'         => 'update_core',
            'edit_others_posts'  => 'update_core',
            'delete_posts'       => 'update_core',
            'publish_posts'      => 'update_core',
            'read_private_posts' => 'update_core',
        ),
    );
    register_post_type( 'ad_store', $args ); 
} 
add_action( 'init', 'ad_tag_store' );

//Add Custom Metabox
function ad_tag_metabox(){
    add_meta_box('ad_tag_metabox', 'Put your ad tag here:', 'ad_tag_metabox_fields', 'ad_store', 'normal' );
}
 
add_action('add_meta_boxes', 'ad_tag_metabox');
 
 
function ad_tag_metabox_fields(){
     
    global $post;
     
    ?>
 
    <textarea name="_ad_tag_metabox_field" id="" rows="32" style="width:100%"><?php echo get_post_meta($post->ID, 'ad_tag_metabox', true); ?></textarea>
 
    <?php
 
}
 
function save_ad_tag_metabox(){
 
    global $post;
 
    if(isset($_POST["_ad_tag_metabox_field"])):
         
        update_post_meta($post->ID, 'ad_tag_metabox', $_POST["_ad_tag_metabox_field"]);
     
    endif;
}
 
add_action('save_post', 'save_ad_tag_metabox');

