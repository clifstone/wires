<?php
function vid_embed_metabox(){
    add_meta_box('yt_metabox', 'YOUTUBE LINK:', 'yt_embed_metabox_fields', 'post', 'normal', 'high' );
    add_meta_box('vid_embed_metabox', 'VIDEO EMBED CODE:', 'vid_embed_metabox_fields', 'post', 'normal', 'high' );
    add_meta_box('vid_embed_chapterscript', 'VIDEO EMBED CODE - CHAPTER SCRIPT:', 'vid_embed_chapterscript_fields', 'post', 'normal', 'high' );
}
 
add_action('add_meta_boxes', 'vid_embed_metabox');

function yt_embed_metabox_fields(){
     
    global $post; ?>

    <textarea name="_yt_metabox_field" id="_yt_metabox_field" rows="1" style="width:100%"><?php echo get_post_meta($post->ID, 'yt_metabox', true); ?></textarea>
 
<?php }
 
 
function vid_embed_metabox_fields(){
     
    global $post; ?>
 
    <textarea name="_vid_embed_metabox_field" id="_vid_embed_metabox_field" rows="8" style="width:100%"><?php echo get_post_meta($post->ID, 'vid_embed_metabox', true); ?></textarea>
 
<?php }

function vid_embed_chapterscript_fields(){
     
    global $post; ?>
 
    <textarea name="_vid_embed_chapterscript_field" id="vid_embed_chapterscript_field" rows="8" style="width:100%"><?php echo get_post_meta($post->ID, 'vid_embed_chapterscript', true); ?></textarea>
 
<?php }


 
function save_vid_embed_metabox(){
 
    global $post;

    if(isset($_POST["_yt_metabox_field"])):
         
        update_post_meta($post->ID, 'yt_metabox', $_POST["_yt_metabox_field"]);
     
    endif;
 
    if(isset($_POST["_vid_embed_metabox_field"])):
         
        update_post_meta($post->ID, 'vid_embed_metabox', $_POST["_vid_embed_metabox_field"]);
     
    endif;

    if(isset($_POST["_vid_embed_metabox_field"])):
         
        update_post_meta($post->ID, 'vid_embed_chapterscript', $_POST["_vid_embed_chapterscript_field"]);
     
    endif;
    
}
 
add_action('save_post', 'save_vid_embed_metabox');