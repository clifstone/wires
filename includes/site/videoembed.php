<?php

function vid_embed_metabox(){
    add_meta_box('yt_metabox', 'YOUTUBE LINK:', 'yt_embed_metabox_fields', 'post', 'normal', 'high' );
    add_meta_box('vid_embed_metabox', 'VIDEO EMBED CODE:', 'vid_embed_metabox_fields', 'post', 'normal', 'high' );
}
add_action('add_meta_boxes', 'vid_embed_metabox');

function yt_embed_metabox_fields(){
    global $post;
    echo '<input type="text" class="wp-editor-area" name="_yt_metabox_field" id="_yt_metabox_field" rows="1" style="width:100%; border:1px solid #DDD" value="'.get_post_meta($post->ID, 'yt_metabox', true).'" />';
}
 
function vid_embed_metabox_fields(){
    global $post;
    echo '<textarea class="wp-editor-area" name="_vid_embed_metabox_field" id="_vid_embed_metabox_field" rows="16"  style="width:100%; border:1px solid #DDD">'.get_post_meta($post->ID, 'vid_embed_metabox', true).'</textarea>';
}

function save_vid_embed_metabox(){
    global $post;
    if(isset($_POST["_yt_metabox_field"])){
        update_post_meta($post->ID, 'yt_metabox', $_POST["_yt_metabox_field"]);
    }
 
    if(isset($_POST["_vid_embed_metabox_field"])){
        update_post_meta($post->ID, 'vid_embed_metabox', $_POST["_vid_embed_metabox_field"]);
    }
}
 
add_action('save_post', 'save_vid_embed_metabox');