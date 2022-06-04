<?php
    add_action( 'wp_head', function(){ echo theThumb(array( 'pID' => $post->ID, 'whichOne' => 'preload' )); }, 99);
    get_header();
    if(is_active_sidebar('headeradslot')){ dynamic_sidebar('headeradslot'); }
?>
    <div class="main-wrap gridcols">
        <div class="gridcol">
            <main class="site-main" role="main">
                <?php if( function_exists('yoast_breadcrumb') ) { yoast_breadcrumb( '<div class="breadcrumbs">','</div>' ); } ?>
                    <div class="articlehero">
                        <figure class="featured-thumb thumb" style="background-image:url(<?php echo get_stylesheet_directory_uri(); ?>/images/gzlogofull.gif);">
                            <div class="wrapper">
                                
                            </div>
                        </figure>
                        <?php get_template_part( 'single/checkvid' ); ?>
                    </div>
                    <?php get_template_part( 'single/postheader' ); ?>
                <div class="post-content-wrapper">
                    <?php get_template_part( 'single/sharepost' ); ?>
                    <div class="post-content">
                        <div class="the-content">
                            <?php the_content(); ?>
                        </div>
                        <?php wp_link_pages('before=<nav class="pagination"><div class="wrapper"><span class="label">Pages</span>&after=</div></nav>'); ?>
                    </div>
                </div>
                <?php get_template_part( 'single/single-comments' ); ?>
                <?php get_template_part( 'single/single-related-cats', '', $args = array('pID' => $post->ID) ); ?>
                <?php if(is_active_sidebar('abovefooter')){ dynamic_sidebar('abovefooter'); } ?>
            </main>
        </div>
        <div class="gridcol">
            <?php get_sidebar(); ?>
        </div>
    </div>
<?php get_footer(); ?>