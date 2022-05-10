<?php
function carousel_func( $atts = array(), $content="null" ) {

    extract(shortcode_atts(array(
        'numofmobile' => '8',
        'numofdesktop' => '8',
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
        'fwdbck' => '',
        'loadmoreonclick' => '',
        'loadmoreonscroll' => null,
        'listlabel' => '',
        'noviewall' => '',
        'noheader' => '',
        'nofooter' => false,
        'usehtwo' => '',
        'usehthree' => 'true',
        'usehfour' => '',
        'ovlist' => ''
    ), $atts));

    $output;
    $mcRand = rand( 0 , 999999 );
    $numof;
    $mcpages;
    $x = 0;

    ob_start();
    
    if(wp_is_mobile()){
        if($numofmobile){
            $numof = $numofmobile;
        }else{
            $numof = 4;
        }
    }else{
        if($numofmobile){
            $numof = $numofdesktop;
        }else{
            $numof = 6;
        }
    }

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

    if($mw === 'true'){
        $mw = 'mw';
    }else{
        $mw = '';
    }

    if($category_name && !$noviewall){
        $viewalllink = '<a href="'.home_url().'/'.'category/'.$category_name.'">View All</a>';
    }
    else if($tag_name && !$noviewall){
        $viewalllink = '<a href="'.home_url().'/'.'tag/'.$tag_name.'">View All</a>';
    }
    else if($noviewall && $tag_name || $noviewall && $category_name){
        $viewalllink = '';
    }

    $rowheaderslug;
    if($usehtwo){
        $rowheaderslug = '<h2>'.$slugname.'</h2>';
    }else if($usehthree){
        $rowheaderslug = '<h3>'.$slugname.'</h3>';
    }else if($usehfour){
        $rowheaderslug = '<h4>'.$slugname.'</h4>';
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
    
    if($nofooter){
        $rowfooter = '';
    }else{
        $rowfooter = '
        <footer class="row-footer">
            <div class="wrapper">
            </div>
        </footer>
        ';
    }

    if($ovlist === true){
        $mcov = 'mcov';
    }
    
    $mcRowStart = '<div id="mclist-'.$mcRand.'" class="mclist carousel">';
    $mcRowEnd = '</div>';
    $mcGridStart = '<div id="mcgrid-'.$mcRand.'" class="tnslid">';
    $mcGridEnd = '</div>';
    
    if($category_name){
        $recent_posts = wp_get_recent_posts(array(
            'numberposts' => $numof,
            'post_status' => 'publish',
            'category_name' => $category_name,
            'exclude' => get_the_ID()
        ));
    }else if($tag_name){
        $recent_posts = wp_get_recent_posts(array(
            'numberposts' => $numof,
            'post_status' => 'publish',
            'tag' => $tag_name,
            'exclude' => get_the_ID()
        ));
    }else{
        $recent_posts = wp_get_recent_posts(array(
            'numberposts' => $numof,
            'post_status' => 'publish',
            'exclude' => get_the_ID()
        ));
    }

    foreach( $recent_posts as $post_item ){
        $title = get_the_title($post_item['ID']);
        $link = get_the_permalink($post_item['ID']);
        $format = get_post_format($post_item['ID']) ? 'video' : 'standard';

        $mcThumb_small = wp_get_attachment_image_src( get_post_thumbnail_id($post_item['ID']), 'small' );
        $mcThumb_extra_small = wp_get_attachment_image_src( get_post_thumbnail_id($post_item['ID']), 'extra-small' );
        $mcThumb_tiny = wp_get_attachment_image_src( get_post_thumbnail_id($post_item['ID']), 'tiny' );
        $imgalt = get_post_meta( get_post_thumbnail_id($post_item['ID']), '_wp_attachment_image_alt', true);

        $thmbalt;
        if($imgalt){
            $thmbalt = $imgalt;
        }else{
            $thmbalt = get_the_excerpt($post_item['ID']);
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
        
        if($hasexcerpt === false){
            $excerpt = '';
        }else{
            $excerpt = '<p>'.get_the_excerpt($post_item['ID']).'</p>';
        }

        $date = $post_item['post_date'];
        $time = get_post_time('U', true, get_post($post_item['ID']));
        $mytime = time() - $time;
        if($mytime > 0 && $mytime < 7*24*60*60){
            $mytimestamp = '<div class="timestamp"><span>NEW</span></div>';
        }else{
            $mytimestamp = '';
        }

        if($format === 'video'){
            $itemfooter = '<footer><span>Watch Video</span></footer>';
        }else{
            $itemfooter = '<footer><span>Read Article</span></footer>';
        }

        echo '
        <article class="grid-item '.$artclass.' '.$format.'" style="--order: '.$x.'">
            <a href="'.$link.'">
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
            </a>
        </article>
        ';
        
        $x++;
    }
    
    
    $derff = ob_get_contents();
    ob_end_clean();

    return $mcRowStart.$rowheader.$mcGridStart.$derff.$mcGridEnd.$rowfooter.$slergh.$mcRowEnd;
 
}
add_shortcode( 'carousel', 'carousel_func' );
?>