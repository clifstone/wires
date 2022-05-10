<?php
    $mcThumb_large = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' );
    $mcThumb_medium = wp_get_attachment_image_src( get_post_thumbnail_id(), 'medium' );
    $mcThumb_small = wp_get_attachment_image_src( get_post_thumbnail_id(), 'small' );
    $mcThumb_extra_small = wp_get_attachment_image_src( get_post_thumbnail_id(), 'extra-small' );
    $mcThumb_tiny = wp_get_attachment_image_src( get_post_thumbnail_id(), 'tiny' );
    $mcThumb_large_square = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large-square' );
    $mcThumb_medium_square = wp_get_attachment_image_src( get_post_thumbnail_id(), 'medium-square' );
    $mcThumb_small_square = wp_get_attachment_image_src( get_post_thumbnail_id(), 'small-square' );
    $mcThumb_exta_small_square = wp_get_attachment_image_src( get_post_thumbnail_id(), 'extra-small-square' );
    $mcThumb_tiny_square = wp_get_attachment_image_src( get_post_thumbnail_id(), 'tiny-square' );

    $format = get_post_format() ? 'video' : 'standard';
?>

<figure class="featured-thumb thumb">
    <div class="wrapper">
        <picture class="lozad" data-iesrc="<?php echo $mcThumb_small['0']; ?>" data-alt="">
            <source media="(min-width:1366px)" srcset="<?php echo $mcThumb_large['0']; ?>">
            <source media="(min-width:1024px)" srcset="<?php echo $mcThumb_medium['0']; ?>">
            <source media="(min-width:768px)" srcset="<?php echo $mcThumb_medium['0']; ?>">
            <source srcset="<?php echo $mcThumb_small['0']; ?>">
            <img width="640" height="360" src="<?php echo get_template_directory_uri(); ?>/assets/images/placeholder.gif" alt="<?php echo get_the_excerpt(); ?>">
        </picture>
    </div>
</figure>