<?php
    /**
* Template Name: BLANK HIDDEN NAV
*/
    get_header();
    if(is_active_sidebar('headeradslot')){ dynamic_sidebar('headeradslot'); }
?>
    <div class="main-wrap">
        <?php if( function_exists('yoast_breadcrumb') ) { yoast_breadcrumb( '<div class="breadcrumbs">','</div>' ); } ?>
        <main class="site-main" role="main">
            <div class="gridcols">
                <div class="gridcol">
                    <?php the_content(); ?>
                </div>
                <div class="gridcol">
                    <?php get_sidebar(); ?>
                </div>
            </div>
        </main>
        <?php if(is_active_sidebar('abovefooter')){ dynamic_sidebar('abovefooter'); } ?>
    </div>
<?php get_footer(); ?>