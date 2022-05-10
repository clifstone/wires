<?php 
    $recent_posts = wp_get_recent_posts(array(
        'numberposts' => 4,
        'post_status' => 'publish',
        'exclude' => get_the_ID()
    ));
?>
<div class="most-recent">
    <div class="wrapper">

        <div class="header"><span>Most Recent</span></div>

        <?php
        
        foreach( $recent_posts as $post_item ){
            $title = get_the_title($post_item['ID']);
            $link = get_the_permalink($post_item['ID']);
            $format = get_post_format($post_item['ID']) ? 'video' : 'standard';
            $mcThumb_small = wp_get_attachment_image_src( get_post_thumbnail_id($post_item['ID']), 'small' );
            $mcThumb_extra_small = wp_get_attachment_image_src( get_post_thumbnail_id($post_item['ID']), 'extra-small' );
            $mcThumb_tiny = wp_get_attachment_image_src( get_post_thumbnail_id($post_item['ID']), 'tiny' );
            $thmbalt;
            $imgalt = get_post_meta( get_post_thumbnail_id($post_item['ID']), '_wp_attachment_image_alt', true);
            $whichcat = get_the_category($post_item['ID']);
            $postpricat = get_post_primary_category($post_item['ID'], 'category'); 
            $pricat = $postpricat['primary_category'];
            $priname = $pricat->name;
            $prislug = $pricat->slug;
            $x = 0;
            $thmbalt;

            if($imgalt){
                $thmbalt = $imgalt;
            }else{
                $thmbalt = get_the_excerpt($post_item['ID']);
            }
            $date = $post_item['post_date'];
            $time = get_post_time('U', true, get_post($post_item['ID']));
            $mytime = time() - $time;
            if($mytime > 0 && $mytime < 7*24*60*60){
                $mytimestamp = '<div class="timestamp"><span>NEW</span></div>';
            }else{
                $mytimestamp = '';
            }

            $thumb = '
            <figure class="thumb">
                <div class="wrapper">
                    <picture class="lozad" data-iesrc="'.$mcThumb_extra_small[0].'" data-alt="'.$thmbalt.'">
                        <source srcset="'.$mcThumb_small[0].'" media="(min-width: 320px)">
                        <source srcset="'.$mcThumb_extra_small[0].'">
                        <noscript><img src="'.$mcThumb_small[0].'" alt=""></noscript>
                    </picture>
                </div>
            </figure>
            ';
            

            echo '
            <article class="grid-item '.$format.'" style="--order: '.$x.'">
                <a href="'.$link.'">
                    <div class="wrapper">
                        <figure class="thumb">
                            <div class="wrapper" data-num="'.$x.'">
                                '.$thumb.'
                            </div>
                        </figure>
                        <div class="item-body">
                            <header>
                                <h3><span aria-label="'.$title.'" title="'.$title.'">'.$title.'</span></h3>
                            </header>
                            '.$mytimestamp.'
                        </div>
                    </div>
                </a>
            </article>';

            $x++;

        }

        ?>

    </div>
</div>