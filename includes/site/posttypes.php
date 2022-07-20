<?php
function InfluencerSections() {

$labels = array(
    'name'                => _x( 'Influencer Sections', 'Post Type General Name', '' ),
    'singular_name'       => _x( 'Influencer Section', 'Post Type Singular Name', '' ),
    'menu_name'           => __( 'Influencer Sections', '' ),
    'parent_item_colon'   => __( 'Parent Influencer Section', '' ),
    'all_items'           => __( 'All Influencer Sections', '' ),
    'view_item'           => __( 'View Influencer Section', '' ),
    'add_new_item'        => __( 'Add New Influencer Section', '' ),
    'add_new'             => __( 'Add Influencer Section', '' ),
    'edit_item'           => __( 'Edit Influencer Section', '' ),
    'update_item'         => __( 'Update Influencer Section', '' ),
    'search_items'        => __( 'Search Influencer Section', '' ),
    'not_found'           => __( 'Not Found', '' ),
    'not_found_in_trash'  => __( 'Not found in Trash', '' ),
);
    
$args = array(
    'label'               => __( 'Influencer Section', '' ),
    'description'         => __( 'Influencer Sections', '' ),
    'labels'              => $labels,
    'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
    'hierarchical'        => false,
    'public'              => true,
    'show_ui'             => true,
    'show_in_menu'        => true,
    'show_in_nav_menus'   => false,
    'show_in_admin_bar'   => true,
    'menu_position'       => 5,
    'can_export'          => true,
    'has_archive'         => false,
    'exclude_from_search' => false,
    'publicly_queryable'  => true,
    'capability_type'     => 'post',
    'show_in_rest' => true,
    'show_in_graphql' => true,
    'graphql_single_name' => 'InfluencerSections',
    'graphql_plural_name' => 'InfluencerSectionss',
);
register_post_type( 'InfluencerSections', $args );
}
add_action( 'init', 'InfluencerSections', 0 );