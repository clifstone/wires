<?php extract($args); ?>

<header class="influencerpageheader">
    <div class="wrapper">
        <figure class="influencer-thumb thumb squarethumb">
            <div class="wrapper">
                <?php echo theThumb($args = array( 'pID' => $post->ID, 'size' => $imgsize )); ?>
            </div>
        </figure>
        <div class="influencer-title">
            <span class="influencer-label">GetZone Influencer</span>
            <?php if(is_single()){ ?>
                <h1 class="influencer-name"><span><?php echo get_the_title($pID); ?></span></h1>
            <?php }else{ ?>
                <h2 class="influencer-name"><span><?php echo get_the_title($pID); ?></span></h2>
            <?php } ?>
        </div>
        <?php get_template_part('parts/influencersocial', '', $args = array('pID' => $pID)); ?>
    </div>
</header>