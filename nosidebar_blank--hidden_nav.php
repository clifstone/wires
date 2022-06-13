<?php 

/**
* Template Name: BLANK HIDDEN NAV NO SIDEBAR
*/

get_header();
if(is_active_sidebar('headeradslot')){ dynamic_sidebar('headeradslot'); }
?>

    <div class="main-wrap">
        <?php if( function_exists('yoast_breadcrumb') ) { yoast_breadcrumb( '<div class="breadcrumbs">','</div>' ); } ?>
        <main class="site-main" role="main">            
            <?php the_content(); ?>
            <?php if(is_active_sidebar('abovefooter')){ dynamic_sidebar('abovefooter'); } ?>
        </main>
    </div>

<?php get_footer(); ?>