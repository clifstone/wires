<?php

function one_third_func($atts, $content = '', $code = NULL) {

    extract(shortcode_atts(array(
        'classname' => ''
    ), $atts));

    $output = '<div class="one-third '.$classname.'"><div class="wrapper">'.$content.'</div></div>';

    return $output;
    }
    
add_shortcode('one_third', 'one_third_func');