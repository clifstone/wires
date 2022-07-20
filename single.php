<?php
$hasplaylist = get_post_meta($post->ID,'vid_playlist_urls', true);

//var_dump(get_post_type());

if( !$hasplaylist && !is_singular('influencersections') ) {
    include(get_template_directory().'/single_standard.php');
}else if(is_singular('influencersections')){
    include(get_template_directory().'/single_influencer.php');
}else{
    include(get_template_directory().'/single_playlist.php');
    function wp_body_classes( $classes ) {
        $classes[] = 'has-playlist';
          
        return $classes;
    }
    add_filter( 'body_class','wp_body_classes' );
}