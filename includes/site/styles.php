<?php

function dequeuestuff() {
    global $post;
    wp_dequeue_style( 'wp-block-library' );
    wp_dequeue_style( 'global-styles' );
}
add_action( 'wp_enqueue_scripts', 'dequeuestuff', 99);

function loadstyles() {
    $template_directory = get_template_directory_uri();
    $stylever = '1.1.0';
    
    echo '<link rel="preload" href="'.$template_directory.'/style.css?v='.$stylever.'" as="style"  onload="this.rel=\'stylesheet\'" >';
    echo '<link rel="preload" href="'.$template_directory.'/fonts/baseicons/style.min.css?v='.$stylever.'" as="style"  onload="this.rel=\'stylesheet\'" >';
}
add_action( 'wp_head', 'loadstyles', -1);