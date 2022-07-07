<?php get_header();
    global $post;
    $has_carousel = get_post_meta($post->ID,'pagecarousel', true);    
?>

    <div class="main-wrap">
        <main class="site-main" role="main">
            <?php if($has_carousel){
                echo do_shortcode('[carousel category_name='.$has_carousel.']');
            } ?>
            <div class="gridcols">
                <div class="gridcol">
                    <?php the_content(); ?>
                    <?php if(is_active_sidebar('abovefooter')){ dynamic_sidebar('abovefooter'); } ?>
                </div>
                <div class="gridcol">
                    <?php get_sidebar(); ?>
                </div>
            </div>
        </main>
    </div>

<?php get_footer(); ?>