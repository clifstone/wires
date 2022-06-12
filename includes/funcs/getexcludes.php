<?php

function getExcludes($args){
    $get_excludes = array(
        'post_status' => 'publish',
        'category_name' => $exclude
    );
    $excludequery = new WP_Query( $get_excludes );
    $excludearr = [];
    if($excludequery->have_posts()){
        while($excludequery->have_posts()){
            $excludequery->the_post();
            array_push($excludearr, get_the_ID());
        }
    }
    wp_reset_postdata();
    return $excludearr;
}