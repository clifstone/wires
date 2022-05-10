<?php get_header(); ?>
    <?php if(is_active_sidebar('headeradslot')){ dynamic_sidebar('headeradslot'); } ?>
    <div class="main-wrap">
        <main class="site-main" role="main">
            <?php get_template_part( 'parts/searchform' ); ?>
            <?php
                global $query_string;
                global $wp_query;
                $query_args = explode("&", $query_string);
                $search_query = array();

                foreach($query_args as $key => $string) {
                    $query_split = explode("=", $string);
                    $search_query[$query_split[0]] = $query_split[1];
                }
                $total_results = $wp_query->found_posts;
                $search = new WP_Query($search_query);

                $mcRowStart = '<div class="mclist"><div class="wrapper">';
                $mcRowEnd = '</div></div>';
                $mcGridStart = '<div class="grid-wrapper"><div class="grid sm-1 thL-t thL-d">';
                $mcGridEnd = '</div></div>';
                $mcSearchStuff = '<div class="searchinfo"><div class="wrapper"><span>You searched for: <span><strong>'.$search_query[$query_split[0]] = $query_split[1].'</strong></div></div>';

                if(have_posts()){
                    
                    $x = 0;
                    $thumb;

                    echo $mcRowStart.$mcSearchStuff.$mcGridStart;
        
                    while(have_posts()){
                        
                        the_post();
                        $title = get_the_title();
                        $link = get_the_permalink();
                        $mcThumb_large = wp_get_attachment_image_url( get_post_thumbnail_id(), 'large' );
                        $mcThumb_medium = wp_get_attachment_image_url( get_post_thumbnail_id(), 'medium' );
                        $mcThumb_small = wp_get_attachment_image_url( get_post_thumbnail_id(), 'small' );
                        $mcThumb_extra_small = wp_get_attachment_image_url( get_post_thumbnail_id(), 'extra-small' );
                        $mcThumb_tiny = wp_get_attachment_image_url( get_post_thumbnail_id(), 'tiny' );
                        $format = get_post_format() ? 'video' : 'standard';
        
                        $thumb = get_the_post_thumbnail( get_the_ID(), 'medium' );
        
                        $excerpt = '<p>'.get_the_excerpt().'</p>';
        
                        if($format === 'video'){
                            $itemfooter = '<footer>Watch Video</footer>';
                        }else{
                            $itemfooter = '<footer>Read Article</footer>';
                        };
                        $date = $post_item['post_date'];
                        $time = get_post_time('U', true, get_post($post_item['ID']));
                        $mytime = time() - $time;
                        if($mytime > 0 && $mytime < 7*24*60*60){
                            $mytimestamp = '<div class="timestamp"><span>NEW</span></div>';
                        }else{
                            $mytimestamp = '';
                        }
                        echo '
                        <article class="grid-item '.$artclass.' '.$format.'" style="--order: '.$x.'">
                            <a href="'.$link.'">
                                <div class="wrapper">
                                    <div class="thumb-wrapper" data-num="'.$x.'">
                                        <div class="thumb">
                                            <div class="wrapper">'.$thumb.'</div>
                                        </div>
                                        '.$mytimestamp.'
                                    </div>
                                    <div class="item-body">
                                        <header>
                                            <h3><span aria-label="'.$title.'" title="'.$title.'">'.$title.'</span></h3>
                                        </header>
                                        '.$excerpt.'
                                        '.$itemfooter.'
                                    </div>
                                </div>
                            </a>
                        </article>
                        ';
                        
                        $x++;
                    }

                    echo $mcGridEnd.$mcRowEnd;

                    if(previous_posts_link()){
                        echo '<div class="search-nav prev"><i class="i-previous2"></i>'.previous_posts_link( 'Next Page' ).'</div>';
                    }
                    if(next_posts_link()){
                        echo '<div class="search-nav next">'.next_posts_link( 'Prev Page' ).'<i class="i-next2"></i></div>';
                    }

                }else{
                    echo '<p>Uh oh... Nothing here...</p>';
                }
                wp_reset_postdata();


            ?>
        </main>
        <?php get_sidebar(); ?>
    </div>

<?php get_footer(); ?>