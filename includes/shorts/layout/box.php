<?php

function box_func( $atts, $content = null ) {

    extract(shortcode_atts(array(
        'type' => '',
        'classname' => ''
    ), $atts));

    $output = '<div class="box '.$type.' '.$classname.'"><div class="wrapper">'.do_shortcode($content).'</div></div>';

    return $output;
    }
    
add_shortcode('box', 'box_func');

// function tie_shortcode_box( $atts, $content = null ) {

// 	$type = $align = $class = $width = '';
//     @extract($atts);

// 	$type =  ($type)  ? ' '.$type  :'shadow' ;
// 	$align = ($align) ? ' '.$align : '';
// 	$class = ($class) ? ' '.$class : '';
// 	$width = ($width) ? ' style="width:'.$width.'"' : '';

// 	$out = '<div class="box'.$type.$class.$align.'"'.$width.'><div class="box-inner-block"><i class="tieicon-boxicon"></i>
// 			' .do_shortcode($content). '
// 			</div></div>';
//     return $out;
// }
// add_shortcode('box', 'tie_shortcode_box');