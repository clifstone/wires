<?php

function buildgzvideositemap() {
    $postsForSitemap = get_posts(array(
        'numberposts' => -1,
        'orderby' => 'modified',
        'post_type' => array('post','page'),
        'order' => 'DESC'
    ));

    $sitemap = '<?xml version="1.0" encoding="UTF-8"?>
    <urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:video="http://www.google.com/schemas/sitemap-video/1.1">';

    foreach($postsForSitemap as $post) {
        setup_postdata($post);
        $postdate = explode(" ", $post->post_modified);
        $vjs = get_post_meta($post->ID,'vid_embed_metabox', true);

        if($vjs){
            $html = $vjs;
            $dom = new DOMDocument;
            @$dom->loadHTML($html);
            $metas = $dom->getElementsByTagName('meta');
            $vjs_sources = [];
            foreach ($metas as $meta){
                $metacontent = $meta->getAttribute('content');
                array_push($vjs_sources, $metacontent);
            }
            $uploaddate = $vjs_sources[0];
            $vidname = $vjs_sources[1];
            $viddescription = $vjs_sources[2];
            $vidduraton = substr($vjs_sources[3], -6);
            $vidthumb = $vjs_sources[4];
            $vidvid = $vjs_sources[5];

            $durmins = substr($vidduraton, 0, -4);
            $dursecs = substr($vidduraton, 3, -1);
            $seconds = ($durmins * 60) + $dursecs;

            if(count($vjs_sources) === 6){
                $sitemap .='
                <url>
                    <loc>'.get_permalink($post->ID).'</loc>
                    <video:video>
                        <video:title><![CDATA['.$vidname.']]></video:title>
                        <video:description><![CDATA['.$viddescription.']]></video:description>
                        <video:content_loc>'.$vidvid.'</video:content_loc>
                        <video:duration>'.$seconds.'</video:duration> 
                        <video:thumbnail_loc>'.$vidthumb.'</video:thumbnail_loc>
                        <video:family_friendly>yes</video:family_friendly>
                        <video:requires_subscription>no</video:requires_subscription>
                        <video:live>no</video:live>
                    </video:video>
                </url>
                ';
            }
        }
    }

    $sitemap .= '</urlset>';
    $fp = fopen(ABSPATH . "gz_video_sitemap.xml", 'w');
    fwrite($fp, $sitemap);
    fclose($fp);
}
add_action("publish_post", "buildgzvideositemap");