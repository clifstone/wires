<?php
    add_action( 'wp_head', function(){ echo theThumb(array( 'pID' => $post->ID, 'size' => 'preload' )); }, 99);
    $author = get_the_author();
    get_header();
    if(is_active_sidebar('headeradslot')){ dynamic_sidebar('headeradslot'); }
?>
    <div class="main-wrap">
    <?php if( function_exists('yoast_breadcrumb') ) { yoast_breadcrumb( '<div class="breadcrumbs">','</div>' ); } ?>
        <main class="site-main" role="main">
            <div class="gridcol">
                <section class="theinfluencer">

                    <header class="influencerpageheader">
                        <div class="wrapper">
                            <span class="influencer-label">GetZone Influencer</span>
                            <h1><span><?php the_title(); ?></span></h1>
                            <?php get_template_part('single/influencersocial'); ?>
                        </div>
                    </header>

                    <figure class="influencer-thumb thumb squarethumb">
                        <div class="wrapper">
                            <?php echo theThumb($args = array( 'pID' => $post->ID, 'size' => 'small' )); ?>
                        </div>
                    </figure>

                </section>

                <div class="articlehero">
                    <?php echo do_shortcode('[carousel category_name=featured]'); ?>
                </div>
                <?php echo do_shortcode('[instalist author="'.$author.'" hasexcerpt=false numofmobile=16 numofdesktop=16 gridclass="lg2-2 lg3-3" loadmoreonclick=true]'); ?>
            </div>
            <div class="gridcol">
                <?php get_sidebar(); ?>
            </div>
        </main>
    </div>
<?php get_footer(); ?>