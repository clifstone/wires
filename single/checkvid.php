<?php
    global $post;
    $vidCode = get_post_meta($post->ID,'vid_embed_metabox', true);
    $ytCode = get_post_meta($post->ID,'yt_metabox', true);
?>

<?php
    if($vidCode){
        get_template_part( 'single/vjs_fast', 'single' );
    }else if($ytCode){
        get_template_part( 'single/yt', 'single' );
    }else{
        return;
    }
?>