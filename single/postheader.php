<?php
global $post;
$cat = get_the_category();
$catcat = $cat[0];
$catslug = $catcat->slug;
$author_id = $post->post_author;
$format = get_post_format() ? 'video' : 'standard';
$post_categories = get_post_primary_category($post->ID, 'category'); 
$primary_category = $post_categories['primary_category'];
$hasplaylist = get_post_meta($post->ID,'vid_playlist_urls', true);

if(!$hasplaylist){
    $date = '<div class="post-date"><div class="date"><span>'.get_the_date().'</span></div></div>';
    $pricat = '<div class="post-category"><a href="'.get_home_url().'/'.'category/'.$primary_category->slug.'"><span>'.$primary_category->name.'</span></a></div>';
}

echo '
<div class="post-header '.$format.'">
    <div class="wrapper">
        '.$pricat.'
        <div class="post-title">
            <h1 data-before="'.get_the_title().'">
                <span>'.get_the_title().'</span>
            </h1>
        </div>
        '.$date.'
    </div>
</div>
';