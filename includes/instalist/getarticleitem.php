<?php
function getarticleitem($args){
    extract($args);
    $instalistquery = new WP_Query( $args );
    $x = 0;
    if(have_posts()){
        while($instalistquery->have_posts()){
            $instalistquery->the_post();

            $title = get_the_title();
            $link = get_the_permalink();
            $thumb = theThumb($args = array( 'pID' => $post->ID, 'size' => 'tiny' ));
            $timestamp = dynamicTime();
            $format = get_post_format($post->ID) ? 'video' : 'standard';
            ($hasexcerpt) ? ($excerpt = '<p>'.get_the_excerpt($post->ID).'</p>') : ($excerpt = '');
            ($format === 'video') ? ($itemfooter = '<footer><span>Watch Video</span></footer>') : ($itemfooter = '<footer><span>Read Article</span></footer>');

            $articleItem .='
            <article class="grid-item '.$format.'" style="--order: '.$x.'">
                <a href="'.$link.'">
                    <div class="wrapper">
                        <div class="thumb-wrapper" data-num="'.$x.'">
                            <figure class="thumb">
                                <div class="wrapper">
                                    '.$thumb.'
                                </div>
                            </figure>
                            '.$timestamp.'
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
    }
    wp_reset_postdata();

    return $articleItem;
}