<?php
    global $post;
    $cat = get_the_category();
    $catcat = $cat[0];
    $catslug = $catcat->slug;
    $author_id = $post->post_author;
    $vidCode = get_post_meta($post->ID,'vid_embed_metabox', true);
    $ytCode = get_post_meta($post->ID,'yt_metabox', true);
    $format = get_post_format() ? 'video' : 'standard';
    $prev_post = get_previous_post();
    $next_post = get_next_post();
    $post_categories = get_post_primary_category($post->ID, 'category'); 
    $primary_category = $post_categories['primary_category'];
    //var_dump(get_the_category_by_ID($primary_category->parent));
?>

<?php
    if($vidCode){
        get_template_part( 'single/vjs', 'single' );
    }else if($ytCode){
        get_template_part( 'single/yt', 'single' );
    }else{
        get_template_part( 'single/featuredthumb', 'single' );
    }
?>

<div class="post-header <?php echo $format; ?>">
    <div class="wrapper">
        <div class="post-category"><?php echo '<a href="'.get_home_url().'/'.'category/'.$primary_category->slug.'"><span>'.$primary_category->name.'</span></a> '?></div>
        <div class="post-title">
            <h1 data-before="<?php the_title(); ?>">
                <span><?php the_title(); ?></span>
            </h1>
        </div>
        <div class="post-date">
            <?php echo '<div class="date"><span>'.get_the_date().'</span></div>'; ?>
        </div>
    </div>
</div><!-- POST HEADER -->