<?php $vjs = get_post_meta($post->ID,'vid_embed_metabox', true); ?>

<div class="vid-header vjs">
    <div class="wrapper">
        <?php echo getMetas($vjs); ?>
    </div>
</div>

<?php add_action('wp_footer', function() use($vjs){ ?>

<script type="module">
    window.addEventListener('load', () =>{
        let vidheaderdiv = document.querySelector('.vid-header > .wrapper'),
            blip = '<script async src="<?php echo getScrSrc($vjs); ?>"><\/script>';

        setTimeout(()=>{ postscribe(vidheaderdiv, blip); },0);
    });
</script>

<?php }, 1001); ?>