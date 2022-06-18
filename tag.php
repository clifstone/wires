<?php
    get_header();
    $mctag = get_queried_object();
    $mctag_name = $mctag->name;
    $mctag_description = $mctag->description;
    $mctag_slug = $mctag->slug;
    if(is_active_sidebar('headeradslot')){ dynamic_sidebar('headeradslot'); }
?>

    <div class="main-wrap">
        <main class="site-main" role="main">
            <header class="page-header">
                <h1>
                    <span><?php echo $mctag_name; ?></span>
                </h1>
                <?php if($cat_description){
                    echo '<div class="description">'.$mctag_description.'</div>';
                } ?>
            </header>
            <section class="archive-content">
                <?php echo do_shortcode('[instalist tag_name="'.$mctag_slug.'" numofmobile="24" numofdesktop="24" gridclass="sm-1 md-3 lg2-4" loadmoreonscroll="true" noheader=true noviewall=true]'); ?>
            </section>
            <?php if(is_active_sidebar('abovefooter')){ dynamic_sidebar('abovefooter'); } ?>
        </main>
        <?php get_sidebar(); ?>
    </div>

<?php get_footer(); ?>