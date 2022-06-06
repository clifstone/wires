<?php
    add_action( 'wp_head', function(){ echo theThumb(array( 'pID' => $post->ID, 'size' => 'preload' )); }, 99);
    get_header();
    if(is_active_sidebar('headeradslot')){ dynamic_sidebar('headeradslot'); }
?>
    <div class="main-wrap">
        <?php if( function_exists('yoast_breadcrumb') ) { yoast_breadcrumb( '<div class="breadcrumbs">','</div>' ); } ?>
        <main class="site-main" role="main">
            <div class="gridcol">
                <div class="articlehero">
                    <figure class="featured-thumb thumb">
                        <div class="wrapper">
                            <?php echo theThumb($args = array( 'pID' => $post->ID, 'size' => 'single' )); ?>
                        </div>
                    </figure>
                    <?php get_template_part( 'single/checkvid' ); ?>
                    <?php get_template_part( 'single/postheader' ); ?>
                </div>
                <div class="post-content-wrapper">
                    <div class="post-content">
                        <div class="the-content">
                            <?php the_content(); ?>
                        </div>
                        <?php wp_link_pages('before=<nav class="pagination"><div class="wrapper"><span class="label">Pages</span>&after=</div></nav>'); ?>
                    </div>
                    <?php get_template_part( 'single/sharepost' ); ?>
                </div>
            </div>
            <div class="gridcol">
                <?php get_sidebar(); ?>
            </div>
        </main>
        <?php get_template_part( 'single/single-comments' ); ?>
        <?php get_template_part( 'single/single-related-cats', '', $args = array('pID' => $post->ID) ); ?>
        <?php if(is_active_sidebar('abovefooter')){ dynamic_sidebar('abovefooter'); } ?>
    </div>
<?php get_footer(); ?>