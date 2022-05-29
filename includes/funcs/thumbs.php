<?php

function getPicture($pID, $whichOne){
    $mcThumb_exlarge = wp_get_attachment_image_src( get_post_thumbnail_id($pID), 'ex-large' );
    $mcThumb_large = wp_get_attachment_image_src( get_post_thumbnail_id($pID), 'large' );
    $mcThumb_medium = wp_get_attachment_image_src( get_post_thumbnail_id($pID), 'medium' );
    $mcThumb_small = wp_get_attachment_image_src( get_post_thumbnail_id($pID), 'small' );
    $mcThumb_extra_small = wp_get_attachment_image_src( get_post_thumbnail_id($pID), 'extra-small' );
    $mcThumb_tiny = wp_get_attachment_image_src( get_post_thumbnail_id($pID), 'tiny' );

    $imgalt = get_post_meta( $pID, '_wp_attachment_image_alt', true);
    ($imgalt) ? ($thmbalt = $imgalt) : ($thmbalt = get_the_excerpt($pID));

    if($whichOne === $single){
        $theImage = '
        <img
        src="'.$mcThumb_tiny[0].'"
        srcset="
        '.$mcThumb_extra_small[0].' 240w,
        '.$mcThumb_small[0].' 375w,
        '.$mcThumb_medium[0].' 768w,
        '.$mcThumb_large[0].' 1366w",
        '.$mcThumb_exlarge[0].' 1920w"
        />
        ';
        return $theImage;
    }

    if($whichOne === $fullPic){
        $thePicture = '
        <picture>
            <source media="(min-width:1366px)" srcset="'.$mcThumb_large[0].'">
            <source media="(min-width:1024px)" srcset="'.$mcThumb_medium[0].'">
            <source media="(min-width:768px)" srcset="'.$mcThumb_medium[0].'">
            <source media="(min-width:375px)" srcset="'.$mcThumb_small[0].'">
            <source media="(min-width:240px)" srcset="'.$mcThumb_extra_small[0].'">
            <img width="100%" height="auto" src="'.$mcThumb_tiny[0].'" alt="'.$thumbalt.'" loading="lazy">
        </picture>
        ';
        return $thePicture;
    }
    if($whichOne === $smallPic){
        $thePicture = '
        <picture>
            <source media="(min-width:768px)" srcset="'.$mcThumb_medium[0].'">
            <source media="(min-width:375px)" srcset="'.$mcThumb_small[0].'">
            <source media="(min-width:240px)" srcset="'.$mcThumb_extra_small[0].'">
            <img width="100%" height="auto" src="'.$mcThumb_tiny[0].'" alt="'.$thumbalt.'" loading="lazy">
        </picture>
        ';
        return $thePicture;
    }
    if($whichOne === $tinyPic){
        $thePicture = '
        <picture>
            <source media="(min-width:375px)" srcset="'.$mcThumb_small[0].'">
            <source media="(min-width:240px)" srcset="'.$mcThumb_extra_small[0].'">
            <img width="100%" height="auto" src="'.$mcThumb_tiny[0].'" alt="'.$thumbalt.'" loading="lazy">
        </picture>
        ';
        return $thePicture;
    }
}
