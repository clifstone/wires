<?php get_header(); ?>

    <div class="main-wrap">
        <main class="site-main" role="main">            
            <?php the_content(); ?>
            <?php if(is_active_sidebar('abovefooter')){ dynamic_sidebar('abovefooter'); } ?>
        </main>
    </div>

<?php get_footer(); ?>