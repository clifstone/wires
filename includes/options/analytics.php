<?php
function gtag_section_description(){
    echo '<h3 style="border-bottom:1px solid rgba(0,0,0,0.3); padding:32px 0 8px; margin:8px 0 0">Google Analytics Tracking Code</h3>';
}

function render_gtag_field($args){
    $str = implode($args);
    switch($str){
        case 'gtag':
            echo '<input type="text" name="gtag_code" id="gtag_code" value="'.get_option('gtag_code').'" />';
        break;
    }
}

function add_gtag(){
    add_settings_section( 'gtag_section', '', 'gtag_section_description', 'gtag-code');

    add_settings_field('gtag_code', 'Google Analytics', 'render_gtag_field', 'gtag-code', 'gtag_section', $args = array('gtag'));
    register_setting( 'gtag_section', 'gtag_code');
}
add_action('admin_init','add_gtag');