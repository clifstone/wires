<?php

    $vjs = get_post_meta($post->ID,'vid_embed_metabox', true);
    $vjschap = get_post_meta($post->ID,'vid_embed_chapterscript', true);

    $html = html_entity_decode($vjs);

    $dom = new DOMDocument;
    @$dom->loadHTML($html);

    $metas = $dom->getElementsByTagName('meta');
    $scrsrc = $dom->getElementsByTagName('script');
    $vjs_sources = [];

    foreach ($metas as $meta){
        $metacontent = $meta->getAttribute('content');
        array_push($vjs_sources, $metacontent);
    }
    foreach ($scrsrc as $srcs){
        $scriptsource = $srcs->getAttribute('src');
        array_push($vjs_sources, $scriptsource);
    }

    $mcThumb_medium = wp_get_attachment_image_src( get_post_thumbnail_id(), 'medium' );
    $mcThumb_small = wp_get_attachment_image_src( get_post_thumbnail_id(), 'small' );

?>

<div class="vid-header vjs">
<script async src="https://cdn.ampproject.org/v0.js"></script>
    <script async custom-element="amp-jwplayer" src="https://cdn.ampproject.org/v0/amp-jwplayer-0.1.js"></script>
    <script async custom-element="amp-video-docking" src="https://cdn.ampproject.org/v0/amp-video-docking-0.1.js"></script>
    <div class="wrapper">
        <?php
        $vidID = preg_match( '~/players/([[a-zA-Z\d]+)~', $vjs_sources[6], $matches );
        ?>
        <div class="amp-jwvideo">
            <amp-jwplayer data-player-id="CjzCyNb7" data-media-id="<?php echo $matches[1] ?>" layout="responsive" width="16" height="9"></amp-jwplayer>
        </div>
    </div>
</div>

<?php

add_action('wp_footer', function() use($vjs_sources){ ?>

<!-- <script>

    document.onreadystatechange = function () {
        if (document.readyState == "complete") {
            var vidheader = document.querySelector('.vid-header'),
                vidheaderdiv = document.querySelector('.vid-header > .wrapper');

        function addIt(){
            vidheader.removeEventListener('click', addIt);

            <?php

            if(count($vjs_sources) === 1){ ?>
                blip = '<script defer src="<?php echo $vjs_sources[0]; ?>"><\/script>';
            <?php }
            
            if(count($vjs_sources) === 7){ ?>
                blip = '<script defer src="<?php echo $vjs_sources[6]; ?>"><\/script>';
            <?php }
            if(count($vjs_sources) === 6){ ?>
                blip = '<script defer src="<?php echo $vjs_sources[5]; ?>"><\/script>';
            <?php } 
            
            if($vid_embed_chapterscript){ ?>
                flip = '<script defer src="<?php echo $vjschap; ?>"><\/script>';
            <?php } ?>
            
            inView('.vid-header').once("enter", function(){
                postscribe(vidheaderdiv, blip);
            });
            
            <?php if($vid_embed_chapterscript){ ?>
                postscribe(vidheaderdiv, flip);
            <?php } ?>
            
        };
        
        addIt();
        
        }
    }

</script> -->

<?php }, 1001);

?>