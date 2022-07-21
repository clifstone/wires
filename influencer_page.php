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
                        $infQuery->the_post(); ?>

                    <section class="theinfluencer">

                        <header class="influencerpageheader">
                            <div class="wrapper">
                                <span class="influencer-label">GetZone Influencer</span>
                                <h2><span><?php the_title(); ?></span></h2>
                                <div class="influencer-social social">
                                    <div class="wrapper">
                                        <div class="socialbtns">
                                            <?php
                                            if(get_post_meta($post->ID, 'facebooklink', true)){
                                                echo '<a href="'.get_post_meta('facebooklink', true).'" target="_blank" rel="nofollow noopener noreferrer"  class="socialbtn fb headerbtn" name="Click here to visit the '.get_bloginfo().' '.$iconname.' page"><i class="i-facebook"></i></a>';
                                            }
                                            if(get_post_meta($post->ID, 'twitterlink', true)){
                                                echo '<a href="'.get_post_meta('twitterlink', true).'" target="_blank" rel="nofollow noopener noreferrer"  class="socialbtn tw headerbtn" name="Click here to visit the '.get_bloginfo().' '.$iconname.' page"><i class="i-twitter"></i></a>';
                                            }
                                            if(get_post_meta($post->ID, 'instagramlink', true)){
                                                echo '<a href="'.get_post_meta('instagramlink', true).'" target="_blank" rel="nofollow noopener noreferrer"  class="socialbtn ig headerbtn" name="Click here to visit the '.get_bloginfo().' '.$iconname.' page"><i class="i-instagram"></i></a>';
                                            }
                                            if(get_post_meta($post->ID, 'youtubelink', true)){
                                                echo '<a href="'.get_post_meta('youtubelink', true).'" target="_blank" rel="nofollow noopener noreferrer"  class="socialbtn yt headerbtn" name="Click here to visit the '.get_bloginfo().' '.$iconname.' page"><i class="i-youtube"></i></a>';
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </header>

                        <figure class="influencer-thumb thumb squarethumb">
                            <div class="wrapper">
                                <?php echo theThumb($args = array( 'pID' => $pID, 'size' => 'small' )); ?>
                            </div>
                        </figure>
                        
                        <div class="influencerbio">
                            <div class="the-content">
                                <h3><span>About </span><span><?php the_title(); ?></span></h3>
                                <?php the_content(); ?>
                            </div>
                        </div>

                        <div class="influencerbutton">
                            <div class="wrapper">
                                <a href="<?php the_permalink(); ?>" class="influencerlink">View posts by <?php echo get_the_title(); ?></a>
                            </div>
                        </div>

                    </section>
                        
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