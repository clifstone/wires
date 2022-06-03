<?php
    get_header();
    $cat = get_category( get_query_var( 'cat' ) );
    $cat_id = $cat->cat_ID;
    $cat_name = $cat->name;
    $cat_description = $cat->description;
    $cat_slug = $cat->slug;
    $cat_parent_id = $cat->parent;
    $cat_parent = get_category($cat_parent_id);
    $cat_children = array('child_of' => $cat_id);
?>

    <div class="main-wrap">
        <main class="site-main" role="main">
            <header class="page-header">
                <h1>
                    <span><?php echo $cat_name; ?></span>
                </h1>
                <?php if($cat_description){
                    echo '<div class="description">'.$cat_description.'</div>';
                } ?>
            </header>
            <section class="archive-content">
                <?php echo do_shortcode('[instalist category_name='.$cat_slug.' numofmobile="24" numofdesktop="24" gridclass="sm-1 lg2-2 lg3-4" loadmoreonscroll=true noheader=true noviewall=true]'); ?>
            </section>
            <?php if(is_active_sidebar('abovefooter')){ dynamic_sidebar('abovefooter'); } ?>
        </main>
        <?php get_sidebar(); ?>
    </div>

<?php get_footer(); ?>