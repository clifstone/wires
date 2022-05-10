<?php
function deregisterstuff(){
    wp_deregister_script('jquery');
}
add_action('wp_enqueue_scripts', 'deregisterstuff');

function headerscripts(){
    $template_directory = get_template_directory_uri();
    echo '<link rel="preconnect" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js">';
    echo '<link rel="preload" href="'.$template_directory.'/js/lozad.js" as="script">';
    echo '<link rel="preload" href="'.$template_directory.'/js/inview.js" as="script">';
    echo '<link rel="preload" href="'.$template_directory.'/js/postscribe.js" as="script">';
    echo '<script async src="'.$template_directory.'/js/lozad.js"></script>';
}
add_action( 'wp_head', 'headerscripts', 99);

function footerScripts(){
    $template_directory = get_template_directory_uri();
    echo '<script>!function(e){"function"==typeof define&&define.amd?define(e):e()}(function(){var e,t=["scroll","wheel","touchstart","touchmove","touchenter","touchend","touchleave","mouseout","mouseleave","mouseup","mousedown","mousemove","mouseenter","mousewheel","mouseover"];if(function(){var e=!1;try{var t=Object.defineProperty({},"passive",{get:function(){e=!0}});window.addEventListener("test",null,t),window.removeEventListener("test",null,t)}catch(e){}return e}()){var n=EventTarget.prototype.addEventListener;e=n,EventTarget.prototype.addEventListener=function(n,o,r){var i,s="object"==typeof r&&null!==r,u=s?r.capture:r;(r=s?function(e){var t=Object.getOwnPropertyDescriptor(e,"passive");return t&&!0!==t.writable&&void 0===t.set?Object.assign({},e):e}(r):{}).passive=void 0!==(i=r.passive)?i:-1!==t.indexOf(n)&&!0,r.capture=void 0!==u&&u,e.call(this,n,o,r)},EventTarget.prototype.addEventListener._original=e}});</script>';
    echo '<script async src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>';
    echo '<script async src="'.$template_directory.'/js/inview.js"></script>';
    echo '<script async src="'.$template_directory.'/js/postscribe.js"></script>';
    echo '<script src="'.$template_directory.'/js/base.js"></script>';
}
add_action( 'wp_footer', 'footerScripts', 99);