<?php 
    add_action( 'wp_head', function(){ echo theThumb(array( 'pID' => $post->ID, 'whichOne' => 'preload' )); }, 99);
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
        <div class="gridcols">
            <div class="gridcol">
                <div class="post-content-wrapper">
                    <?php get_template_part( 'single/sharepost' ); ?>
                    <div class="post-content">
                        <div class="the-content">
                            <?php the_content(); ?>
                        </div>
                        <div class="theplaylist-content">
                            <?php get_template_part( 'single/playlistcontent' ); ?>
                        </div>
                    </div>
                </div>
                <?php get_template_part( 'single/single-comments' ); ?>
                <?php get_template_part( 'single/single-related-cats' ); ?>
                <?php if(is_active_sidebar('abovefooter')){ dynamic_sidebar('abovefooter'); } ?>
            </div>
            <div class="gridcol">
                <?php get_sidebar(); ?>
            </div>
        </div>
    </div>

<?php get_footer(); ?>