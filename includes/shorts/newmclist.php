<?php
function instalist_func( $atts = array(), $content="null" ) {

    extract(shortcode_atts(array(
        'numofmobile' => '4',
        'numofdesktop' => '4',
        'thumbshapesm' => '',
        'thumbshapemd' => '',
        'thumbshapelg' => '',
        'category_name' => '',
        'tag_name' => '',
        'rowclass' => '',
        'gridclass' => '',
        'hasexcerpt' => 'true',
        'colorscheme' => '',
        'hasads' => '',
        'mw' => null,
        'fwdbck' => null,
        'loadmoreonclick' => 'true',
        'loadmoreonscroll' => null,
        'listlabel' => '',
        'noviewall' => '',
        'noheader' => '',
        'nofooter' => '',
        'usehtwo' => '',
        'usehthree' => 'true',
        'usehfour' => '',
        'ovlist' => '',
        'exclude' => ''
    ), $atts));

    $output;
    $mcRand = rand( 0 , 999999 );
    $numof;
    $mcpages;
    $x = 0;

    (wp_is_mobile()) ? ($numof = $numofmobile) : ($numof = $numofdesktop);
    ($mw) ? ($mw = 'mw') : ($mw = '');

    if(!$listlabel){
        if($category_name){
            $cat = get_term_by( 'slug', $category_name, 'category');
            $slugname = $cat->name;
            $mcpages = (int) ($cat->count / $numof) + 1;
        }
        if($tag_name){
            $mctag = get_term_by( 'slug', $tag_name, 'post_tag');
            $slugname = $mctag->name;
            $mcpages = (int) ($mctag->count / $numof) + 1;
        }
    }else{
        $slugname = $listlabel;
    }

    if($category_name){
        $rowheaderslug = '<h2><a href="'.home_url().'/'.'category/'.$category_name.'"><span>'.$slugname.'</span></a></h2>';
    }else{
        $rowheaderslug = '<h2><span>'.$slugname.'</span></h2>';
    }

    if($loadmoreonclick){
        $listtype = 'loadmoreonclick';
        $mcloadmore = '<div id="loadmore-'.$mcRand.'" class="load-more-posts lmbtn" data-id="'.$mcRand.'" data-catname="'.$category_name.'" data-tagname="'.$tag_name.'" data-numof="'.$numof.'" data-totalnum="'.$totalnum.'" data-excerpt="'.$hasexcerpt.'"><span>Show More posts</span><i><svg viewBox="0 0 24 24" preserveAspectRatio="xMidYMid meet" focusable="false"><g><path d="M12,15.7L5.6,9.4l0.7-0.7l5.6,5.6l5.6-5.6l0.7,0.7L12,15.7z"></path></g></svg></i></div>';
    }
    if($loadmoreonscroll){
        $listtype = 'loadmoreonscroll';
        $mcloadmore = '<div id="loadmore-'.$mcRand.'" class=" load-more-posts" data-id="'.$mcRand.'" data-catname="'.$category_name.'" data-tagname="'.$tag_name.'" data-numof="'.$numof.'"></div>' . $viewalllink;
    }

    if($noheader){
        $rowheader = '';
    }else{
        $rowheader = '
        <header class="row-header">
            <div class="wrapper">
                '.$rowheaderslug.$viewalllink.'
            </div>
        </header>
        ';
    }

    $args;

    if($category_name){
        $args = array(
            'posts_per_page' => $numof,
            'post_status' => 'publish',
            'category_name' => $category_name,
            'post__not_in' => array('')
        );
        //$recent_posts = wp_get_recent_posts($args);
        $totalnum = get_term_by('slug', $category_name, 'category')->count;
    }else if($tag_name){
        $args = array(
            'posts_per_page' => $numof,
            'post_status' => 'publish',
            'tag' => $tag_name,
            'post__not_in' => array('')
        );
        //$recent_posts = wp_get_recent_posts($args);
        $totalnum = get_term_by('slug', $tag_name, 'post_tag')->count;
    }else{
        $args = array(
            'posts_per_page' => $numof,
            'post_status' => 'publish',
            'post__not_in' => array('')
        );
        //$recent_posts = wp_get_recent_posts($args);
        $totalnum = wp_count_posts()->publish;
    }

    if($loadmoreonclick){
        $listtype = 'loadmoreonclick';
        $mcloadmore = '<div id="loadmore-'.$mcRand.'" class="load-more-posts lmbtn" data-id="'.$mcRand.'" data-catname="'.$category_name.'" data-tagname="'.$tag_name.'" data-numof="'.$numof.'" data-totalnum="'.$totalnum.'" data-excerpt="'.$hasexcerpt.'"><span>Show More posts</span><i><svg viewBox="0 0 24 24" preserveAspectRatio="xMidYMid meet" focusable="false"><g><path d="M12,15.7L5.6,9.4l0.7-0.7l5.6,5.6l5.6-5.6l0.7,0.7L12,15.7z"></path></g></svg></i></div>';
    }
    if($loadmoreonscroll){
        $listtype = 'loadmoreonscroll';
        $mcloadmore = '<div id="loadmore-'.$mcRand.'" class=" load-more-posts" data-id="'.$mcRand.'" data-catname="'.$category_name.'" data-tagname="'.$tag_name.'" data-numof="'.$numof.'"></div>' . $viewalllink;
    }

    if($nofooter){
        $rowfooter = '';
    }else{
        $rowfooter = '
        <footer class="row-footer">
            <div class="wrapper">
                '.$mcloadmore.'
            </div>
        </footer>
        ';
    }
    
    $articleItem;
    
    $instalistquery = new WP_Query( $args );
    
    if(have_posts()){
        while($instalistquery->have_posts()){
            $instalistquery->the_post();

            $title = get_the_title();
            $link = get_the_permalink();
            $thumb = theThumb($args = array( 'pID' => $post->ID, 'whichOne' => 'tiny' ));
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
    }else{}
    wp_reset_postdata();

    $mclist = '
    <div id="mclist-'.$mcRand.'" class=" mclist '.$colorscheme.' '.$rowclass.' '.$listtype.'">
        <div class="wrapper '.$mw.'">
            '.$rowheader.'
            <div class="grid-wrapper">
                <div id="mcgrid-'.$mcRand.'" class="grid '.$gridclass.'">
                '.$articleItem.'
                </div>
            </div>
            '.$rowfooter.'
        </div>
    </div>
    ';

    return $mclist;
 
}
add_shortcode( 'instalist', 'instalist_func' );