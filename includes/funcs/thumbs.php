<?php

function theThumb($args){
    extract($args);
    $mcThumb_exlarge = wp_get_attachment_image_src( get_post_thumbnail_id($pID), 'ex-large' );
    $mcThumb_large = wp_get_attachment_image_src( get_post_thumbnail_id($pID), 'large' );
    $mcThumb_medium = wp_get_attachment_image_src( get_post_thumbnail_id($pID), 'medium' );
    $mcThumb_small = wp_get_attachment_image_src( get_post_thumbnail_id($pID), 'small' );
    $mcThumb_extra_small = wp_get_attachment_image_src( get_post_thumbnail_id($pID), 'extra-small' );
    $mcThumb_tiny = wp_get_attachment_image_src( get_post_thumbnail_id($pID), 'tiny' );

    $imgalt = get_post_meta( $pID, '_wp_attachment_image_alt', true);
    ($imgalt) ? ($thumbalt = $imgalt) : ($thumbalt = get_the_excerpt($pID));

    switch ($size) {
        case 'single':
            $theThumb = '
            <img
            src="'.$mcThumb_tiny[0].'" alt="'.$thumbalt.'"
            srcset="
            '.$mcThumb_extra_small[0].' 240w,
            '.$mcThumb_small[0].' 375w,
            '.$mcThumb_medium[0].' 768w,
            '.$mcThumb_large[0].' 1366w" 
            alt="'.$thumbalt.'"
            width="300" 
            height="169" 
             />
            ';
            
        break;

        case 'small':
            $theThumb = '
            <img
            src="'.$mcThumb_tiny[0].'"
            loading="lazy"
            alt="'.$thumbalt.'"
            srcset="
            '.$mcThumb_extra_small[0].' 240w,
            '.$mcThumb_small[0].' 375w,
            '.$mcThumb_medium[0].' 768w"
            alt="'.$thumbalt.'"
            width="300" 
            height="169"
            />
            ';
        break;

        case 'tiny':
            $theThumb = '
            <img
            src="'.$mcThumb_tiny[0].'"
            loading="lazy"
            alt="'.$thumbalt.'"
            srcset="
            '.$mcThumb_extra_small[0].' 240w,
            '.$mcThumb_small[0].' 375w"
            alt="'.$thumbalt.'"
            width="300" 
            height="169"
            />
            ';
        break;
        
        case 'preload':
            $theThumb = '
            <link
            rel="preload"
            as="image"
            href="'.$mcThumb_tiny[0].'" 
            imagesrcset="'.$mcThumb_extra_small[0].' 240w, 
            '.$mcThumb_small[0].' 375w, 
            '.$mcThumb_medium[0].' 768w, 
            '.$mcThumb_large[0].' 1366w"
             >
            ';
        break;
    }

    return $theThumb;
}
