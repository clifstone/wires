<?php

function tweet_func( $atts = array(), $content=null ) {

    extract(shortcode_atts(array(
        'classname' => ''
    ), $atts));

    $output = '<button class="shbtn tw '.$classname.'" name="share this article on twitter" aria-label="share this article on twitter"><a href="http://twitter.com/intent/tweet?original_referer='.get_permalink($post->ID).'&text='.get_the_title($post->ID).'&url='.get_permalink($post->ID).'" target="_blank" name="share this article on twitter" rel="noopener"><i class="i-twitter"></i></a></button>';

    return $output;
    }
    
add_shortcode('tweet', 'tweet_func');