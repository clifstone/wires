<?php

function caption_func($atts, $content = '', $code = NULL) {

    extract(shortcode_atts(array(
        'id' => '',
        'align' => '',
        'width' => '',
        'classname' => ''
    ), $atts));

    $output = '<div class="wp-caption '.$classname.'"><div class="wrapper">'.$content.'</div></div>';

    return $output;

}
    
add_shortcode('caption', 'caption_func');