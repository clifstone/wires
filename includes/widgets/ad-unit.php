<?php

class Ad_Slot extends WP_Widget {

	public function __construct() {
		parent::__construct(
			'adunit',
			__( '*THEME* Ad Unit', 'text_domain' ),
			array(
				'customize_selective_refresh' => true,
			)
		);
	}

	public function form( $instance ) {

		$defaults = array(
            'select'   => '',
			'picktag'   => '',
			'pos' => ''
		);
		
        extract( wp_parse_args( ( array ) $instance, $defaults ) ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'select' ); ?>">What size is the ad?</label>
			<select name="<?php echo $this->get_field_name( 'select' ); ?>" id="<?php echo $this->get_field_id( 'select' ); ?>" class="widefat">
			<?php

			$options = array(
				''        => __( 'Select', 'text_domain' ),
				'lb' => __( 'Leaderboard / Mobile Banner', 'text_domain' ),
                'mr' => __( 'Medium Rectangle', 'text_domain' ),
                'mr2' => __( 'Medium Rectangle / Mobile Banner', 'text_domain' ),
				'mb' => __( 'Mobile Banner', 'text_domain' ),
			);

			foreach ( $options as $key => $name ) {
				echo '<option value="' . esc_attr( $key ) . '" id="' . esc_attr( $key ) . '" '. selected( $select, $key, false ) . '>'. $name . '</option>';

			} ?>
			</select>
        </p>

		<p>
			<label for="<?php echo $this->get_field_id( 'picktag' ); ?>">Pick a tag</label>
			<select name="<?php echo $this->get_field_name( 'picktag' ); ?>" id="<?php echo $this->get_field_id( 'picktag' ); ?>" class="widefat">
			<?php

			$adquery = new WP_Query(
				array(
					'post_type' => 'ad_store',
					'posts_per_page' => -1,
				)
			);

			if ( $adquery->have_posts() ) :
			while ( $adquery->have_posts() ) : $adquery->the_post();
			global $post;
			$post_slug = $post->post_name;
			$post_title = $post->post_title;
			//var_dump($post);
			echo '<option value="' . esc_attr( $post_slug ) . '" id="' . esc_attr( $post_slug ) . '" '. selected( $picktag, $post_slug, false ) . '>'. $post_title . '</option>';
			endwhile;
			wp_reset_postdata();
			else :
			endif; ?>

			</select>
        </p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'pos' ) ); ?>">Position <small style="font-size:10px; font-style:italic; color:#999999">More than 1 one of the same size ad? Leave blank if not</small></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'pos' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'pos' ) ); ?>" type="number" value="<?php echo esc_attr( $pos ); ?>" />
		</p>

	<?php }

	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['select']   = isset( $new_instance['select'] ) ? wp_strip_all_tags( $new_instance['select'] ) : '';
		$instance['picktag']   = isset( $new_instance['picktag'] ) ? wp_strip_all_tags( $new_instance['picktag'] ) : '';
		$instance['pos'] = isset( $new_instance['pos'] ) ? wp_strip_all_tags( $new_instance['pos'] ) : '';
		return $instance;
	}

	public function widget( $args, $instance ) {

		extract( $args );

		$select   = isset( $instance['select'] ) ? $instance['select'] : '';
		$picktag   = isset( $instance['picktag'] ) ? $instance['picktag'] : '';
		$pos = isset( $instance['pos'] ) ? $instance['pos'] : '';

        echo $before_widget;
		
		$adquery = new WP_Query(
			array(
				'post_type' => 'ad_store',
				'name' => $picktag,
				'posts_per_page' => 1,
			)
		);

		if ( $adquery->have_posts() ) :
		while ( $adquery->have_posts() ) : $adquery->the_post();

		$the_tag = get_post_meta(get_the_ID(), 'ad_tag_metabox', true);

		?>

		<div class="plaidslot mw <?php echo $select.' pos_'.$pos; ?>">
			<div class="wrapper">
				<?php
					echo $the_tag;
				?>
			</div>
		</div>

		<?php
		
		endwhile;
		wp_reset_postdata();
		else :
		endif;
		
		echo $after_widget;

	}

}

// Register the widget
function register_ad_slot() {
	register_widget( 'Ad_Slot' );
}
add_action( 'widgets_init', 'register_ad_slot' );