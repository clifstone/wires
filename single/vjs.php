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
    <div class="wrapper">
        <?php if(count($vjs_sources) === 7){ ?>
            <div itemscope itemtype="https://schema.org/VideoObject"><meta itemprop="uploadDate" content="<?php echo $vjs_sources[0]; ?>"/><meta itemprop="name" content="<?php echo esc_js($vjs_sources[1]); ?>"/><meta itemprop="description" content="<?php echo esc_js($vjs_sources[2]); ?>"/><meta itemprop="duration" content="<?php echo $vjs_sources[3]; ?>" /><meta itemprop="thumbnailUrl" content="<?php echo $vjs_sources[4]; ?>"/><meta itemprop="contentUrl" content="<?php echo $vjs_sources[5]; ?>"/></div>
        <?php }
        if(count($vjs_sources) === 6){ ?>
            <div itemscope itemtype="https://schema.org/VideoObject"><meta itemprop="uploadDate" content="<?php echo $vjs_sources[0]; ?>"/><meta itemprop="name" content="<?php echo esc_js($vjs_sources[1]); ?>"/><meta itemprop="description" content="<?php echo esc_js($vjs_sources[2]); ?>"/><meta itemprop="thumbnailUrl" content="<?php echo $vjs_sources[3]; ?>"/><meta itemprop="contentUrl" content="<?php echo $vjs_sources[4]; ?>"/></div>
        <?php } ?>
    </div>
</div>

<?php

add_action('wp_footer', function() use($vjs_sources){ ?>

<script>

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

</script>

<?php }, 1001);

?>