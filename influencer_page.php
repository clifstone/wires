<?php

    /**
    * Template Name: INFLUENCER PAGE
    */

    add_action( 'wp_head', function(){ echo theThumb(array( 'pID' => $post->ID, 'size' => 'preload' )); }, 99);
    get_header();
    if(is_active_sidebar('headeradslot')){ dynamic_sidebar('headeradslot'); }
?>
    <div class="main-wrap">
        <?php if( function_exists('yoast_breadcrumb') ) { yoast_breadcrumb( '<div class="breadcrumbs">','</div>' ); } ?>
        <main class="site-main" role="main">
            <div class="gridcol">
                <div class="pagetitle">
                    <h1><span><?php the_title(); ?></span></h1>
                </div>
                <?php
                $args = array(
                    'post_type' => 'influencersections',
                    'posts_per_page' => $numof,
                    'post_status' => 'publish',
                    'hasexcerpt' => $hasexcerpt,
                );
                $x = 0;
                $infQuery = new WP_Query($args);
                if($infQuery->have_posts()){
                    while($infQuery->have_posts() && $x <= ($posts_per_page + 1)){
                        $infQuery->the_post();
                        $pID = get_the_ID();
                        ?>

                    <div class="theinfluencer">

                        <?php get_template_part('parts/influencerheader', '', $args = array('pID' => $pID, 'imgsize' => 'small')); ?>

                        <?php echo do_shortcode('[instalist category_name=featured numofmobile=4 numofdesktop=4 gridclass="md-2" hasexcerpt=false noheader=true nofooter=true loadmoreonclick=true]'); ?>

                        <div class="influencerbutton">
                            <div class="wrapper">
                                <a href="<?php the_permalink(); ?>" class="influencerlink">View posts by <?php echo get_the_title($pID); ?></a>
                            </div>
                        </div>

                    </div>
                        
                    <?php }
                }
                wp_reset_query();
                ?>
            </div>
            <div class="gridcol">
                <?php if(is_active_sidebar('homepage_rail')){
                    dynamic_sidebar('homepage_rail');
                } ?>
            </div>
        </main>
    </div>
<?php get_footer(); ?>