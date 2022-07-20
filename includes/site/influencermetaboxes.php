<?php

$metaboxes = array(
    array('facebooklink', 'FACEBOOK LINK:', 'influencersections'),
    array('twitterlink', 'TWITTER LINK:', 'influencersections'),
    array('instagramlink', 'INSTAGRAM LINK', 'influencersections'),
    array('youtubelink', 'YOUTUBE LINK', 'influencersections')
);

function createmetaboxfields($post, $args){
    global $post;
    $theposttype = get_post_type( get_queried_object_id() );

    $getid = json_decode(json_encode($args), FALSE);
    $mcid = $getid->id;
    $ptype = $post->post_type;

    if($theposttype === $ptype){
        echo '<input type="text" name="_'.$mcid.'_field" id="_'.$mcid.'_field" rows="1" value="'.get_post_meta($post->ID, $mcid, true).'" style="width:100%">';
    }
}

function savemetabox(){
    global $post;
    global $metaboxes;
    foreach($metaboxes as $metabox){
        (isset($_POST['_'.$metabox[0].'_field'])) ? (update_post_meta($post->ID, $metabox[0], $_POST['_'.$metabox[0].'_field'])) : null;
    }
}

function createmetabox(){
    global $metaboxes;
    foreach($metaboxes as $metabox){
        add_meta_box($metabox[0], $metabox[1], 'createmetaboxfields', $metabox[2], 'normal', 'high', $metabox[0] );
    }
}

add_action('add_meta_boxes', 'createmetabox');
add_action('save_post', 'savemetabox');