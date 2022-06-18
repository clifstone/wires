<?php

//rest api filter by category slug
function rest_filter_by_custom_taxonomy( $args, $request ) {

    if ( isset($request['category_slug']) )
    {
        //$category_slug = sanitize_text_field($request['category_slug']);
        $args['tax_query'] = [
            [
                'taxonomy' => 'category',
                'field'    => 'slug',
                'terms'    => $request['category_slug'],
            ]
        ];
    }
    
    return $args;

}
add_filter('rest_post_query', 'rest_filter_by_custom_taxonomy', 10, 3);