<?php
    global $post;
    $vidCode = get_post_meta($post->ID,'vid_embed_metabox', true);
    $playlist = get_post_meta($post->ID,'vid_playlist_urls', true);
    $ytCode = get_post_meta($post->ID,'yt_metabox', true);
?>

<?php
    if($vidCode){
        get_template_part( 'single/vjs', 'single' );
    }else if($ytCode){
        get_template_part( 'single/yt', 'single' );
    }else if(has_post_thumbnail() && !$vidCode && !$ytCode){
        get_template_part( 'single/featuredthumb', 'single' );
    }else{
        return;
    }
?>