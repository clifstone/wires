<?php get_header(); ?>
    <?php if(is_active_sidebar('headeradslot')){ dynamic_sidebar('headeradslot'); } ?>
    <div class="main-wrap">
        <main class="site-main" role="main">
            <?php if ( function_exists('yoast_breadcrumb') ) { yoast_breadcrumb( '<div class="breadcrumbs">','</div>' ); } ?>
            <?php get_template_part( 'single/singleloop' ); ?>
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
        </main>
        <?php get_sidebar(); ?>
    </div>

<?php get_footer(); ?> 