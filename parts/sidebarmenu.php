<?php
    $mcLogo = get_option('aside_logo_url');
?>

<div class="sidebarmenu">
    <div class="wrapper">
        <div class="row">
            <header class="sidebarmenu-header">
                <div class="site-logo">
                    <a href="<?php echo home_url(); ?>"><?php echo '<img class="logo-img" src="'.$mcLogo.'" alt="site-logo" width="100%" height="auto" loading="lazy" />'; ?></a>
                </div>
            </header>
        </div>
        <div class="row">
            <div class="nav">
                <div class="navtitle">
                    <span>Sections</span>
                </div>
                <nav><?php wp_nav_menu( array( 'theme_location' => 'menu_mobile_nav', 'menu_class' => 'site-aside-menu menu' ) ); ?></nav>
            </div>
        </div>
        <div class="row">
            <?php get_template_part( 'parts/searchform' ); ?>
        </div>
        <div class="row">
            <?php get_template_part( 'parts/social'); ?>
        </div>
        <div class="row">
            <?php get_template_part( 'parts/userlogin'); ?>
        </div>
    </div>
</div>