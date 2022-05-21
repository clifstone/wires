<?php
$hasplaylist = get_post_meta($post->ID,'vid_playlist_urls', true);

if( !$hasplaylist ) {
    include(get_template_directory().'/single_standard.php');
}else{
    include(get_template_directory().'/single_playlist.php');
    function wp_body_classes( $classes ) {
        $classes[] = 'has-playlist';
          
        return $classes;
    }
    add_filter( 'body_class','wp_body_classes' );
}