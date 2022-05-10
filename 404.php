<?php get_header(); ?>

    <div class="main-wrap">
        <main class="site-main" role="main">
            <div class="wrapper" style="min-height:calc((100vh - 90px) - var(--shH)); display:flex; flex-wrap:wrap; align-items:center;">
            <div class="message" style="text-align:center; padding:16px; width:100%">
                    <div class="big" style="font-size:84px; font-weight:700">404</div>
                    <h1>Page Not Found</h1>
                    <p style="padding:16px">The page you were looking for could not be found. It might have been removed, renamed, or did not exist in the first place.</p>
                </div>
            </div>
            <?php if(is_active_sidebar('abovefooter')){ dynamic_sidebar('abovefooter'); } ?>
        </main>
    </div>

<?php get_footer(); ?>