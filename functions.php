<?php
ob_start();
// error_reporting(E_ALL);
// ini_set('display_errors', true);
// ini_set('display_startup_errors', FALSE);

function stop_heartbeat() {
wp_deregister_script('heartbeat');
}
add_action( 'init', 'stop_heartbeat', 1 );

function redirect_after_logout() {
    $redirect_url = site_url();
    wp_safe_redirect( $redirect_url );
    exit;
}
add_action( 'wp_logout', 'redirect_after_logout' );

function disable_emojis() {
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_action( 'admin_print_styles', 'print_emoji_styles' ); 
    remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
    remove_filter( 'comment_text_rss', 'wp_staticize_emoji' ); 
    remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
    add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
    add_filter( 'wp_resource_hints', 'disable_emojis_remove_dns_prefetch', 10, 2 );
}
add_action( 'init', 'disable_emojis' );
   
function disable_emojis_tinymce( $plugins ) {
    if ( is_array( $plugins ) ) {
        return array_diff( $plugins, array( 'wpemoji' ) );
    } else {
        return array();
    }
}
   
function disable_emojis_remove_dns_prefetch( $urls, $relation_type ) {
    if( 'dns-prefetch' == $relation_type ) {
        $emoji_svg_url = apply_filters( 'emoji_svg_url', 'https://s.w.org/images/core/emoji/2/svg/' );
        $urls = array_diff( $urls, array( $emoji_svg_url ) );
    }
    return $urls;
}


if (!current_user_can('edit_users')) {
    add_action('init', function($a){ remove_action('init', 'wp_version_check'); },2);
    add_filter('pre_option_update_core', function($a){ return null; });
}

// get the first category id
function get_first_category_ID() {
    $category = get_the_category();
    return $category[0]->cat_ID;
}

function no_wordpress_errors(){
  return 'Oh Noes!';
}
add_filter( 'login_errors', 'no_wordpress_errors' );

function registerMenus(){

    register_nav_menus(array(
        'menu_header' => __( 'Site Header Menu' ),
        'menu_mobile_nav' => __( 'Mobile Nav Menu' )
    ));

}
add_action( 'init', 'registerMenus' );

add_theme_support( 'post-thumbnails' );
add_image_size( 'ex-large', 1920, 1080 );
add_image_size( 'large', 1366, 768 );
add_image_size( 'medium', 768, 432 );
add_image_size( 'small', 600, 338 );
add_image_size( 'extra-small', 338, 190 );
add_image_size( 'tiny', 180, 101 );

set_post_thumbnail_size( 600, 338, array( 'top', 'left')  );

function getPostViews($postID){
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0 View";
    }
    return $count.' Views';
}

function dynamictime() {
  global $post;
  $date = $post->post_date;
  $time = get_post_time('G', true, $post);
  $mytime = time() - $time;
  if($mytime > 0 && $mytime < 7*24*60*60)
    //$mytimestamp = '<div class="timestamp"><span>NEW</span>'.sprintf(__('%s ago'), human_time_diff($time)).'</div>';
    $mytimestamp = '<div class="timestamp"><span>NEW</span></div>';
  else
    $mytimestamp = '';
  return $mytimestamp;
}
add_filter('the_time', 'dynamictime');

function add_file_types_to_uploads($file_types){
    $new_filetypes = array();
    $new_filetypes['svg'] = 'image/svg+xml';
    $file_types = array_merge($file_types, $new_filetypes );
    return $file_types;
}
add_filter('upload_mimes', 'add_file_types_to_uploads');

function addsomebodyclasses( $classes ){  
    $include = array(
        'is-iphone'            => $GLOBALS['is_iphone'],
        'is-chrome'            => $GLOBALS['is_chrome'],
        'is-safari'            => $GLOBALS['is_safari'],
        'is-ns4'               => $GLOBALS['is_NS4'],
        'is-opera'             => $GLOBALS['is_opera'],
        'is-mac-ie'            => $GLOBALS['is_macIE'],
        'is-win-ie'            => $GLOBALS['is_winIE'],
        'is-gecko'             => $GLOBALS['is_gecko'],
        'is-lynx'              => $GLOBALS['is_lynx'],
        'is-ie'                => $GLOBALS['is_IE'],
        'is-edge'              => $GLOBALS['is_edge'],
        'is-archive'           => is_archive(),
        'is-post_type_archive' => is_post_type_archive(),
        'is-attachment'        => is_attachment(),
        'is-author'            => is_author(),
        'is-category'          => is_category(),
        'is-tag'               => is_tag(),
        'is-tax'               => is_tax(),
        'is-date'              => is_date(),
        'is-day'               => is_day(),
        'is-feed'              => is_feed(),
        'is-comment-feed'      => is_comment_feed(),
        'is-front-page'        => is_front_page(),
        'is-home'              => is_home(),
        'is-privacy-policy'    => is_privacy_policy(),
        'is-month'             => is_month(),
        'is-page'              => is_page(),
        'is-paged'             => is_paged(),
        'is-preview'           => is_preview(),
        'is-robots'            => is_robots(),
        'is-search'            => is_search(),
        'is-single'            => is_single(),
        'is-singular'          => is_singular(),
        'is-time'              => is_time(),
        'is-trackback'         => is_trackback(),
        'is-year'              => is_year(),
        'is-404'               => is_404(),
        'is-embed'             => is_embed(),
        'is-mobile'            => wp_is_mobile(),
        'is-desktop'           => ! wp_is_mobile(),
        'has-blocks'           => function_exists( 'has_blocks' ) && has_blocks(),
        'single_standard'      => ( !get_post_meta(get_the_ID(), 'vid_playlist_urls', true) && is_single() ),
        'single_playlist'      => get_post_meta(get_the_ID(), 'vid_playlist_urls', true),
    );
 
    foreach ( $include as $class => $do_include ){
        if ( $do_include ) $classes[ $class ] = $class;
    }

    $classes[] = str_replace(' ', '-', strtolower(wp_get_theme()[0]));
 
    global $post;
    if ( isset( $post ) ){
        $classes[] = $post->post_type . ' ' . $post->post_name;
    }
 
    return $classes;
}
 
add_filter( 'body_class', 'addsomebodyclasses' );

add_theme_support('post-formats', array( 'aside', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'video', 'audio'));

foreach ( array( 'pre_term_description' ) as $filter ) {
	remove_filter( $filter, 'wp_filter_kses' );
	if ( ! current_user_can( 'unfiltered_html' ) ) {
		add_filter( $filter, 'wp_filter_post_kses' );
	}
}
 
foreach ( array( 'term_description' ) as $filter ) {
	remove_filter( $filter, 'wp_kses_data' );
}

ob_end_clean();

function removeyoastfromcustomposttypes(){
    remove_meta_box('wpseo_meta', array('ad_store','the_playlists'), 'normal');
}
add_action( 'add_meta_boxes', 'removeyoastfromcustomposttypes', 11 );
add_filter( 'wpseo_metabox_prio', function() {return 'low';} );

function remove_admin_bar() {
    if (!current_user_can('administrator') && !is_admin()) {
    show_admin_bar(false);
    }
}
add_action('after_setup_theme', 'remove_admin_bar');
add_theme_support( 'responsive-embeds' );

//

function get_post_primary_category($post_id, $term='category', $return_all_categories=false){
    $return = array();

    if (class_exists('WPSEO_Primary_Term')){
        // Show Primary category by Yoast if it is enabled & set
        $wpseo_primary_term = new WPSEO_Primary_Term( $term, $post_id );
        $primary_term = get_term($wpseo_primary_term->get_primary_term());

        if (!is_wp_error($primary_term)){
            $return['primary_category'] = $primary_term;
        }
    }

    if (empty($return['primary_category']) || $return_all_categories){
        $categories_list = get_the_terms($post_id, $term);

        if (empty($return['primary_category']) && !empty($categories_list)){
            $return['primary_category'] = $categories_list[0];  //get the first category
        }
        if ($return_all_categories){
            $return['all_categories'] = array();

            if (!empty($categories_list)){
                foreach($categories_list as &$category){
                    $return['all_categories'][] = $category->term_id;
                }
            }
        }
    }

    return $return;
}

remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

function attachment_image_link_remove_filter( $content ) {
    $content = preg_replace(array('{<a(.*?)(wp-att|wp-content\/uploads)[^>]*><img}','{ wp-image-[0-9]*" /></a>}'),array('<img', '" />'), $content);
    return $content;
}
add_filter( 'the_content', 'attachment_image_link_remove_filter' );

function numberedPagination() {

    global $wp_query;
    $big = 9999999;
      echo paginate_links( array(
        'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
        'format' => '?paged=%#%',
        'current' => max( 1, get_query_var('paged') ),
        'total' => $wp_query->max_num_pages,
        'show_all' => False,
        'prev_next' => True,
        'prev_text' => __('Previous Page'),
        'next_text' => __('Next Page'),
        'add_args' => ''
       ) );
}

include "includes/includes.php";

function formatvideoposts(){
    $args = array(
        'numberposts' => -1
      );
    $mcposts = get_posts( $args );
    
    foreach( $mcposts as $post ){
        
        $yt = get_post_meta($post->ID,'yt_metabox', true);
        $jwp = get_post_meta($post->ID,'vid_embed_metabox', true);
    
        if($yt || $jwp){
            set_post_format($post->ID, 'video' );
        }
    }
    
}
add_action('init','formatvideoposts');