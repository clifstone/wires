<?php
function social_section_description(){
    echo '<h3 style="border-bottom:1px solid rgba(0,0,0,0.3); padding:32px 0 8px; margin:8px 0 0">Social</h3>';
}

function render_social_fields($args){
    $str = implode($args);
    switch($str){
        case 'fb':
            echo '<input type="text" name="fb_url" id="fb_url" value="'.get_option('fb_url').'" />';
        break;
        case 'tw':
            echo '<input type="text" name="tw_url" id="tw_url" value="'.get_option('tw_url').'" />';
        break;
        case 'ig':
            echo '<input type="text" name="ig_url" id="ig_url" value="'.get_option('ig_url').'" />';
        break;
        case 'yt':
            echo '<input type="text" name="yt_url" id="yt_url" value="'.get_option('yt_url').'" />';
        break;
        case 'et':
            echo '<input type="text" name="et_url" id="et_url" value="'.get_option('et_url').'" />';
        break;
        case 'pt':
            echo '<input type="text" name="pt_url" id="pt_url" value="'.get_option('pt_url').'" />';
        break;
    }
}

function add_social_settings(){
    add_settings_section( 'social_section', '', 'social_section_description', 'social-options');

    add_settings_field('fb_url', 'Facebook', 'render_social_fields', 'social-options', 'social_section', $args = array('fb'));
    register_setting( 'social_options', 'fb_url');
    
    add_settings_field('tw_url', 'Twitter', 'render_social_fields', 'social-options', 'social_section', $args = array('tw'));
    register_setting( 'social_options', 'tw_url');
    
    add_settings_field('ig_url', 'Instagram', 'render_social_fields', 'social-options', 'social_section', $args = array('ig'));
    register_setting( 'social_options', 'ig_url');

    add_settings_field('yt_url', 'YouTube', 'render_social_fields', 'social-options', 'social_section', $args = array('yt'));
    register_setting( 'social_options', 'yt_url');
    
    add_settings_field('et_url', 'Etsy', 'render_social_fields', 'social-options', 'social_section', $args = array('et'));
    register_setting( 'social_options', 'et_url');
    
    add_settings_field('pt_url', 'Pinterest', 'render_social_fields', 'social-options', 'social_section', $args = array('pt'));
    register_setting( 'social_options', 'pt_url');
}
add_action('admin_init','add_social_settings');