<?php
    function trythis(){
        echo '<link rel="preload" as="image" href="important.png">';
    }
    add_action( 'wp_head', 'trythis', 99);

    get_header();
    if(is_active_sidebar('headeradslot')){ dynamic_sidebar('headeradslot'); }
?>
    <div class="main-wrap gridcols">
            <div class="gridcol">
                <main class="site-main" role="main">
                    <?php
                        if( function_exists('yoast_breadcrumb') ) { yoast_breadcrumb( '<div class="breadcrumbs">','</div>' ); }
                        get_template_part( 'single/checkvid' );
                        get_template_part( 'single/postheader' );
                    ?>
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
            </div>
            <div class="gridcol">
                <?php get_sidebar(); ?>
            </div>
    </div>
<meta>
<?php get_footer(); ?>