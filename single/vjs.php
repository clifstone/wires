<?php $vjs = get_post_meta($post->ID,'vid_embed_metabox', true); ?>

<div class="vid-header vjsplayer">
    <div class="wrapper">
        <?php echo getMetas($vjs); ?>
        <?php echo '<script async src="'.getScrSrc($vjs).'"></script>' ?>
    </div>
</div>