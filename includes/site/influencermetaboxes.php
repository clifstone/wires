<?php

$metaboxes = array(
    array('authorname', 'AUTHOR NAME:', 'influencersections'),
    array('facebooklink', 'FACEBOOK LINK:', 'influencersections'),
    array('twitterlink', 'TWITTER LINK:', 'influencersections'),
    array('instagramlink', 'INSTAGRAM LINK:', 'influencersections'),
    array('youtubelink', 'YOUTUBE LINK:', 'influencersections')
);

function createmetaboxfields($post, $args){
    global $post;
    $theposttype = get_post_type( get_queried_object_id() );

    $getid = json_decode(json_encode($args), FALSE);
    $mcid = $getid->id;
    $ptype = $post->post_type;

    if($theposttype === $ptype){
        echo '<input class="wp-editor-area" type="text" name="_'.$mcid.'_field" id="_'.$mcid.'_field" rows="1" value="'.get_post_meta($post->ID, $mcid, true).'" style="width:100%">';
    } ?>

    <style>

        #facebooklink,
        #twitterlink,
        #instagramlink,
        #youtubelink,
        #facebooklink .toggle-indicator,
        #twitterlink .toggle-indicator,
        #instagramlink .toggle-indicator,
        #youtubelink .toggle-indicator{
            color:white;
        }
        #facebooklink{
            background-color:#3b5998;
        }
        #twitterlink{
            background-color:#1DA1F2;
        }
        #instagramlink{
            background-image:radial-gradient(circle farthest-corner at 32% 106%, #ffe17d 0%, #ffcd69 10%, #fa9137 28%, #eb4141 42%, transparent 82%), linear-gradient( 135deg, #234bd7 12%, #c33cbe 58%);
        }
        #youtubelink{
            background-color:#FF0000;
        }

        @media (min-width:1024px){
            .meta-box-sortables{
                display:grid;
                grid-template-columns:1fr 1fr;
            }

            #authorname,
            #postcustom,
            #wpseo_meta{
                grid-column: span 2;
            }
        }

    </style>

<?php }

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