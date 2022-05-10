<?php
    $mcThumb = get_option('aside_logo_url');
?>

<aside class="site-aside">
    <div class="wrapper">
        <header class="aside-header">
            <div class="site-logo"><a href="<?php echo home_url(); ?>"><?php echo '<img class="logo-img" src="'.$mcThumb.'" alt="site-logo" width="100%" height="auto" loading="lazy" />'; ?></a></div>
        </header>
        
        <div class="nav">
            <div class="navtitle">
                <span>Sections</span>
            </div>
            <nav><?php wp_nav_menu( array( 'theme_location' => 'menu_mobile_nav', 'menu_class' => 'site-aside-menu menu' ) ); ?></nav>
        </div>
        <button id="searchbtn" class="searchbtn" aria-label="Search site">
            <i class="i-search"></i><span>Search</span>
        </button>
        <?php get_template_part( 'parts/social'); ?>
        <?php get_template_part( 'parts/userlogin'); ?>
    </div>
</aside>