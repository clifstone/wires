<?php
    $yt = get_post_meta($post->ID,'yt_metabox', true);
    $ytID = preg_match('![?&]{1}v=([^&]+)!', $yt . '&', $m);
    $mcThumb_medium = wp_get_attachment_image_src( get_post_thumbnail_id(), 'medium' );
?>

<div class="vid-header yt" style="background:url(<?php echo $mcThumb_medium[0]; ?>) no-repeat 50% 50% / cover">
    <div class="wrapper">
        <iframe width="288" height="162" src="https://www.youtube.com/embed/<?php echo $m[1]; ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        <div class="close-btn"><i class="i-cross"></i></div>
    </div>
</div>