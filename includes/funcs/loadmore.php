<?php

function load_posts_by_ajax_callback() {

    $paged = $_POST['page'];
    $category_name = $_POST['category_name'];
    $tag_name = $_POST['tag_name'];
    $numof = $_POST['numof'];
    $hasexcerpt = $_POST['hasexcerpt'];
    $totalnumcat = get_term_by('slug', $category_name, 'category')->count;
    $howmany = $paged * $numof;

        if($category_name){
            $queryArgs = array(
                'category_name' => $category_name,
                'post_type' => 'post',
                'post_status' => 'publish',
                'posts_per_page' => $numof,
                'paged' => $paged,
                'orderby' => 'post_date',
                'order' => 'DESC',
            );
        }else{
            $queryArgs = array(
                'post_type' => 'post',
                'post_status' => 'publish',
                'posts_per_page' => $numof,
                'paged' => $paged,
                'orderby' => 'post_date',
                'order' => 'DESC',
            );
        }
        $mcListQuery = new WP_Query($queryArgs);

        $cat = get_term_by( 'slug', $category_name, 'category');

        //$output = '';
        
        if($mcListQuery->have_posts()){
            
            $x = 0;
            $thumb;

            while($mcListQuery->have_posts()){
                
                $mcListQuery->the_post();
                $title = get_the_title();
                $link = get_the_permalink();
                $format = get_post_format() ? 'video' : 'standard';

                $thumb = '
                <figure class="thumb">
                    <div class="wrapper">
                        '.theThumb($args = array( 'pID' => $post->ID, 'whichOne' => 'tiny' )).'
                    </div>
                </figure>
                ';

                if($hasexcerpt){
                    $excerpt = '<p>'.get_the_excerpt().'</p>';
                }else{
                    $excerpt = '';
                }

                if($format === 'video'){
                    $itemfooter = '<footer><span>Watch Video</span></footer>';
                }else{
                    $itemfooter = '<footer><span>Read Article</span></footer>';
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
                <article class="grid-item '.$format.'" style="--order: '.$x.'">
                    <a href="'.$link.'">
                        <div class="wrapper">
                            <div class="thumb-wrapper" data-num="'.$x.'">
                                '.$thumb.'
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
            
        }else{

        }
        wp_reset_postdata();
 
    wp_die();
}

add_action('wp_ajax_load_posts_by_ajax', 'load_posts_by_ajax_callback');
add_action('wp_ajax_nopriv_load_posts_by_ajax', 'load_posts_by_ajax_callback');