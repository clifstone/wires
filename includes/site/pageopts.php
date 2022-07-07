<?php
function pagecarousel(){
    add_meta_box('pagecarousel', 'CAROUSEL CATEGORY SLUG:', 'pagecarousel_fields', 'page', 'normal', 'high' );
    add_meta_box('pagecarousel_label', 'CAROUSEL HEADER LABEL:', 'pagecarousel_label_fields', 'page', 'normal', 'high' );
}
add_action('add_meta_boxes', 'pagecarousel');

 
function pagecarousel_fields(){
    global $post;
    echo '<input class="wp-editor-area" name="_pagecarousel_field" id="_pagecarousel_field" style="width:100%; border:1px solid #DDD" value="'.get_post_meta($post->ID, 'pagecarousel', true).'">
    <br>
    <small>Display the first 6 items from the specified category.</small>';
}

function pagecarousel_label_fields(){
    global $post;
    echo '<input class="wp-editor-area" name="_pagecarousel_label_field" id="_pagecarousel_label_field" style="width:100%; border:1px solid #DDD" value="'.get_post_meta($post->ID, 'pagecarousel_label', true).'">';
}

function save_pagecarousel(){
    global $post;
 
    if(isset($_POST["_pagecarousel_field"])){
        update_post_meta($post->ID, 'pagecarousel', $_POST["_pagecarousel_field"]);
    }

    if(isset($_POST["_pagecarousel_label_field"])){
        update_post_meta($post->ID, 'pagecarousel_label', $_POST["_pagecarousel_label_field"]);
    }
}
 
add_action('save_post', 'save_pagecarousel');