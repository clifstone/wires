<?php 
    get_header();
?>
    <div class="main-wrap">
        <main class="site-main" role="main">
            <?php
                if( function_exists('yoast_breadcrumb') ) { yoast_breadcrumb( '<div class="breadcrumbs">','</div>' ); }
                get_template_part( 'single/postheader' );
                get_template_part( 'single/vjsplaylist' );
                if(is_active_sidebar('headeradslot')){ dynamic_sidebar('headeradslot'); }
            ?>
        </main>
        <div class="grid-cols">
            <div class="grid-col">
                <div class="post-content-wrapper">
                    <?php get_template_part( 'single/sharepost' ); ?>
                    <div class="post-content">
                        <div class="the-content">
                            <?php the_content(); ?>
                        </div>
                        
                    </div>
                </div>
                <?php get_template_part( 'single/single-comments' ); ?>
                <?php get_template_part( 'single/single-related-cats' ); ?>
                <?php if(is_active_sidebar('abovefooter')){ dynamic_sidebar('abovefooter'); } ?>
            </div>
            <div class="grid-col">
                <?php get_sidebar(); ?>
            </div>
        </div>
    </div>

<?php get_footer(); ?>