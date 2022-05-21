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