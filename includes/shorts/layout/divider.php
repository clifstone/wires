<?php

    function divider_func( $atts = array(), $content="null" ){

        global $post;
  
        extract(shortcode_atts(array(
            'classname' => ''
        ), $atts));

        $output = '<div class="divider '.$classname.'"><div class="wrapper"><div class="dividerimg"></div></div></div>';

        return $output;
    };
    add_shortcode('divider', 'divider_func');