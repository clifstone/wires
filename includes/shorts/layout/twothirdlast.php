<?php

function two_third_last_func($atts, $content = '', $code = NULL) {

    extract(shortcode_atts(array(
        'classname' => ''
    ), $atts));

    $output = '<div class="two-third last '.$classname.'"><div class="wrapper">'.$content.'</div></div>';

    return $output;
    }
    
add_shortcode('two_third_last', 'two_third_last_func');