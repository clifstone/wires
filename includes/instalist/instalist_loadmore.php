<?php

function instalist_loadmore_function() {

    $paged = $_POST['page'];
    $category_name = $_POST['category_name'];
    $tag_name = $_POST['tag_name'];
    $numof = $_POST['numof'];
    $hasexcerpt = $_POST['hasexcerpt'];
    $excludecategory = $_POST['excludecat'];
    $totalnumcat = get_term_by('slug', $category_name, 'category')->count;
    $howmany = $paged * $numof;

    $exclude_categories = ($excludecategory) ? ( mcExclude($excludecategory) ) : ('');

        if($category_name || $tag_name){
            $args = array(
                'loopname' => 'instalist',
                'category_name' => $category_name,
                'tag_name' => $tag_name,
                'post_type' => 'post',
                'post_status' => 'publish',
                'posts_per_page' => $numof,
                'paged' => $paged,
                'orderby' => 'post_date',
                'order' => 'DESC'
            );
        }else{
            $args = array(
                'loopname' => 'instalist',
                'post_type' => 'post',
                'post_status' => 'publish',
                'posts_per_page' => $numof,
                'paged' => $paged,
                'orderby' => 'post_date',
                'order' => 'DESC'
            );
        }
        
        echo useloop($args);
 
    wp_die();
}

add_action('wp_ajax_load_posts_by_ajax', 'instalist_loadmore_function');
add_action('wp_ajax_nopriv_load_posts_by_ajax', 'instalist_loadmore_function');