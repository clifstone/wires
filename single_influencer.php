<?php
    add_action( 'wp_head', function(){ echo theThumb(array( 'pID' => $post->ID, 'size' => 'preload' )); }, 99);
    $author = get_the_author();
    get_header();
    if(is_active_sidebar('headeradslot')){ dynamic_sidebar('headeradslot'); }
    $pID = get_the_ID();
?>
    <div class="main-wrap">
    <?php if( function_exists('yoast_breadcrumb') ) { yoast_breadcrumb( '<div class="breadcrumbs">','</div>' ); } ?>
        <main class="site-main" role="main">
            <div class="gridcol">

                <?php get_template_part('parts/influencerheader', '', $args = array('pID' => $pID, 'imgsize' => 'small')); ?>
                <div class="influencerbio">
                    <h3 class="influencerbio-title"><span>About </span><span><?php echo get_the_title($pID); ?></span></h3>
                    <div class="influencerbio-content the-content">
                        <div class="wrapper">
                            <?php the_content(); ?>
                        </div>
                        <div class="influencer-readmorebtn">
                            <div class="wrapper">
                                <span>Read More</span>
                            </div>
                        </div>
                    </div>
                </div>
                <?php echo do_shortcode('[instalist author="'.$author.'" hasexcerpt=false numofmobile=16 numofdesktop=16 gridclass="lg2-2 lg3-3" loadmoreonclick=true]'); ?>
            </div>
            <div class="gridcol">
                <?php get_sidebar(); ?>
            </div>
        </main>
    </div>
<?php get_footer(); ?>