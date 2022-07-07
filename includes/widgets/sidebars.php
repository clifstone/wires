<?php 
//MOBILE SIDEBAR
register_sidebar( array(
    'name' => __( 'MOBILE SIDEBAR: ABOVE NAV', 'base' ),
    'id' => 'mobilesidebartop',
    'before_widget' => '',
    'after_widget' => '',
) );
register_sidebar( array(
    'name' => __( 'MOBILE SIDEBAR: BELOW NAV', 'base' ),
    'id' => 'mobilesidebar',
    'before_widget' => '',
    'after_widget' => '',
) );
//DEFAULT AD SLOTS
register_sidebar( array(
    'name' => __( 'HEADER AD SLOT', 'base' ),
    'id' => 'headeradslot',
    'before_widget' => '<div class="plaid headerplaidslot"><div class="wrapper">',
    'after_widget' => '</div></div>',
) );

//HOMEPAGE RAIL
register_sidebar( array(
    'name' => __( 'HOMEPAGE RAIL', 'base' ),
    'id' => 'homepage_rail',
    'before_widget' => '<div class="homepage-rail rail"><div class="wrapper">',
    'after_widget' => '</div></div>',
) );

//SINGLE POSTS
register_sidebar( array(
    'name' => __( 'SINGLE POST RAIL', 'base' ),
    'id' => 'single_post_rail',
    'before_widget' => '<div class="post-rail rail"><div class="wrapper">',
    'after_widget' => '</div></div>',
) );

//ARCHIVES
register_sidebar( array(
    'name' => __( 'ARCHIVES RAIL', 'base' ),
    'id' => 'archives_rail',
    'before_widget' => '<div class="archives-rail rail"><div class="wrapper">',
    'after_widget' => '</div></div>',
) );

//SITE FOOTER
register_sidebar( array(
    'name' => __( 'ABOVE THE FOOTER', 'base' ),
    'id' => 'abovefooter',
    'before_widget' => '<section class="abovesitefooter"><div class="wrapper">',
    'after_widget' => '</div></section>',
) );

register_sidebar( array(
    'name' => __( 'SITE FOOTER TOP', 'base' ),
    'id' => 'infootertop',
    'before_widget' => '<div class="infootertop"><div class="wrapper">',
    'after_widget' => '</div></div>',
) );

register_sidebar( array(
    'name' => __( 'SITE FOOTER BOTTOM', 'base' ),
    'id' => 'infooterbottom',
    'before_widget' => '<div class="infooterbottom"><div class="wrapper">',
    'after_widget' => '</div></div>',
) );

//AMP
register_sidebar( array(
    'name' => __( 'AMP AD SLOT : 1', 'base' ),
    'id' => 'singleampadslot1',
    'before_widget' => '<div class="singleampadslot1 ampsidebar">',
    'after_widget' => '</div>',
) );

register_sidebar( array(
    'name' => __( 'AMP AD SLOT : 2', 'base' ),
    'id' => 'singleampadslot2',
    'before_widget' => '<div class="singleampadslot2 ampsidebar">',
    'after_widget' => '</div>',
) );