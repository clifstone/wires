<?php
$vjs = get_post_meta($post->ID,'vid_embed_metabox', true);
$videoIDs = preg_match( '~/players/([[a-zA-Z\d]+)-([[a-zA-Z\d]+)~', getScrSrc($vjs), $theIDs );
$vidID = $theIDs[1];
$playerID = $theIDs[2];
?>

<div class="vid-header vjs">
    <div class="wrapper">
        <?php echo getMetas($vjs); ?>
        <amp-jwplayer data-player-id="<?php echo $playerID; ?>" data-media-id="<?php echo $vidID; ?>" layout="responsive" width="16" height="9"></amp-jwplayer>
    </div>
</div>

<?php
add_action('wp_footer', function(){
    echo '
        <script async src="https://cdn.ampproject.org/v0.js"></script>
        <script async custom-element="amp-jwplayer" src="https://cdn.ampproject.org/v0/amp-jwplayer-0.1.js"></script>
        <script async custom-element="amp-video-docking" src="https://cdn.ampproject.org/v0/amp-video-docking-0.1.js"></script>
    ';
}, 1001);
?>