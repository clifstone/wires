<?php
function getScrSrc($vjs){
    $html = html_entity_decode($vjs);
    $dom = new DOMDocument;
    @$dom->loadHTML($html);
    $scrsrc = $dom->getElementsByTagName('script');
    foreach ($scrsrc as $srcs){
        $scriptsource = $srcs->getAttribute('src');
        return $scriptsource;
    }
}

function getMetas($vjs){
    $metas = preg_replace('#<script(.*?)>(.*?)</script>#is', '', $vjs);
    return $metas;
}

function getPlaylistURLS($pID){
    $plistURLS = explode(",", get_post_meta($pID,'vid_playlist_urls', true) );
    return $plistURLS;
}

function getPlayerID($vjs){
    $videoIDs = preg_match( '~/players/([[a-zA-Z\d]+)-([[a-zA-Z\d]+)~', $vjs, $theIDs );
    return $theIDs[2];
}

function getVideoID($vjs){
    $videoIDs = preg_match( '~/players/([[a-zA-Z\d]+)-([[a-zA-Z\d]+)~', $vjs, $theIDs );
    return $theIDs[1];
}