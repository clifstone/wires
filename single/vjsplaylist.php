<?php

$plisturls = explode(",", get_post_meta($post->ID,'vid_playlist_urls', true) );
$plistslugs = [];

foreach($plisturls as $plisturl){
    $pID = url_to_postid( basename($plisturl) );
    $pmeta = get_post_meta($pID,'vid_embed_metabox', true);
    array_push( $plistslugs, $pmeta );
}

var_dump($plistslugs);

// function plistscript(){
// }
// add_action( 'wp_footer', 'plistscript', 99);