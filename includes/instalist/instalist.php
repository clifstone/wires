<?php
function mcExclude($excludecategory){
    $get_excludes = array(
        'post_status' => 'publish',
        'category_name' => $excludecategory
    );
    $excludequery = new WP_Query( $get_excludes );
    $excludearr = [];
    if(have_posts()){
        while($excludequery->have_posts()){
            $excludequery->the_post();
            array_push($excludearr, get_the_ID());
        }
    }
    wp_reset_postdata();
    return $excludearr;
}
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
        'hasexcerpt' => true,
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
        'excludecategory' => ''
    ), $atts));

    $output;
    $mcRand = rand( 0 , 999999 );
    $numof;
    $mcpages;

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

    $exclude_categories = ($excludecategory) ? ( mcExclude($excludecategory) ) : ('');
    $exclude_single = (is_single()) ? (get_the_ID()) : ('');

    if($category_name || $tag_name){
        $args = array(
            'loopname' => 'instalist',
            'post_type' => 'post',
            'posts_per_page' => $numof,
            'post_status' => 'publish',
            'category_name' => $category_name,
            'tag' => $tag_name,
            'hasexcerpt' => $hasexcerpt,
            'post__not_in' => array($exclude_single, $exclude_categories)
        );
        ($category_name) ? ($totalnum = get_term_by('slug', $category_name, 'category')->count) : ($totalnum = get_term_by('slug', $tag_name, 'post_tag')->count);
    }else{
        $args = array(
            'loopname' => 'instalist',
            'post_type' => 'post',
            'posts_per_page' => $numof,
            'post_status' => 'publish',
            'hasexcerpt' => $hasexcerpt,
            'post__not_in' => array($exclude_single, $exclude_categories)
        );
        $totalnum = wp_count_posts()->publish;
    }
    $datas = 'data-id="'.$mcRand.'" data-catname="'.$category_name.'" data-tagname="'.$tag_name.'" data-numof="'.$numof.'" data-totalnum="'.$totalnum.'" data-excerpt="'.$hasexcerpt.'" data-exclude="'.$excludecategory.'"';

    if($loadmoreonclick){
        $listtype = 'loadmoreonclick';
        $mcloadmore = '<div id="loadmore-'.$mcRand.'" class="load-more-posts lmbtn" '.$datas.'><span>Show More posts</span><i><svg viewBox="0 0 24 24" preserveAspectRatio="xMidYMid meet" focusable="false"><g><path d="M12,15.7L5.6,9.4l0.7-0.7l5.6,5.6l5.6-5.6l0.7,0.7L12,15.7z"></path></g></svg></i></div>';
    }
    if($loadmoreonscroll){
        $listtype = 'loadmoreonscroll';
        $mcloadmore = '<div id="loadmore-'.$mcRand.'" class="load-more-posts lmblock" '.$datas.'><div class="loading-animation">'.getLoader('dots').'</div></div>' . $viewalllink;
    }
    if($totalnum <= $numof){
        $nofooter = true;
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
    
    $articleItem = useloop($args);

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