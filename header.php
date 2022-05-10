<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <?php
        if(!is_page_template('search.php')){ 
            echo '<meta name="robots" content="index, follow">';
        }else{
            echo '<meta name="robots" content="noindex, follow"/>';
        }
    ?>
    <title><?php echo wp_title( '|', true, 'right' ); ?></title>
    <?php wp_head(); ?>
    <noscript><style>body { opacity:1 }</style></noscript>
</head>

<body <?php body_class(); ?> itemscope="itemscope" itemtype="https://schema.org/WebPage" style="opacity:0">
<script>0</script>
    <div class="site-wrapper">
        <?php
            if(is_active_sidebar('headeradslot') && !is_single()){ dynamic_sidebar('headeradslot'); }
            get_template_part( 'parts/mobheader' );
            get_template_part( 'parts/categorynav' );
            get_template_part( 'parts/siteaside' );
        ?>