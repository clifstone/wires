    <?php
        get_header();
        $hasplaylist = get_post_meta($post->ID,'vid_playlist_urls', true);
    ?>
    <?php if(is_active_sidebar('headeradslot') && !$hasplaylist){ dynamic_sidebar('headeradslot'); } ?>

    <div class="main-wrap">
        
        <?php 
            ($hasplaylist) ? ( get_template_part( 'single/postheader' ) ) : null;
            ($hasplaylist) ? (get_template_part( 'single/vjsplaylist' )) : null;
        ?>
        
        <main class="site-main" role="main">
            <?php if ( function_exists('yoast_breadcrumb') ) { yoast_breadcrumb( '<div class="breadcrumbs">','</div>' ); } ?>
            <?php get_template_part( 'single/checkvid' ); ?>
            <?php if(is_active_sidebar('headeradslot') && $hasplaylist){ dynamic_sidebar('headeradslot'); } ?>
            <?php ($hasplaylist) ? null : ( get_template_part( 'single/postheader' ) ); ?>
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