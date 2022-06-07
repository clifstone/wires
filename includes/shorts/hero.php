<?php

function hero_func( $atts = array(), $content="null" ){
    extract(shortcode_atts(array(
        'herolabel' => '',
        'categoryslug' => '',
        'featuredvid' => '',
        'addclass' => '',
        'adslot1' => '',
        'adslot2' => '',
        'noexcerpt' => false,
        'playerid' => 'pcE6fYUD'
       ), $atts));

   global $post;

   $output = '';

   ($categoryslug) ? $categoryslug = $categoryslug : $categoryslug='featured';
   ($featuredvid) ? $f = ' has-featured-vid' : $f='';

   $blip;

   if($featuredvid){
        $p = get_page_by_path( $featuredvid, OBJECT, 'post' );
        $pID = $p->ID;
        $pTitle = $p->post_title;
        $vid = get_post_meta($pID,'vid_embed_metabox', true);
        $vidcategory = get_post_primary_category($pID, 'category')['primary_category'];
        $html = html_entity_decode($vid);
        $dom = new DOMDocument;
        @$dom->loadHTML($html);
        $playerID = $playerid;

        $metas = $dom->getElementsByTagName('meta');
        $scrsrc = $dom->getElementsByTagName('script');
        $vid_sources = [];

        foreach ($metas as $meta){
            $metacontent = $meta->getAttribute('content');
            array_push($vid_sources, $metacontent);
        }
        foreach ($scrsrc as $srcs){
            $scriptsource = $srcs->getAttribute('src');
            array_push($vid_sources, $scriptsource);
        }
        $vsource = basename($vid_sources[6], '.js');
        $pscript = explode('-', $vsource);
        $blip = '<div itemscope itemtype="https://schema.org/VideoObject"><meta itemprop="uploadDate" content="'.$vid_sources[0].'"/><meta itemprop="name" content="'.esc_js($vid_sources[1]).'"/><meta itemprop="description" content="'.esc_js($vid_sources[2]).'"/><meta itemprop="duration" content="'.$vid_sources[3].'" /><meta itemprop="thumbnailUrl" content="'.$vid_sources[4].'"/><meta itemprop="contentUrl" content="'.$vid_sources[5].'"/><script src="https://cdn.jwplayer.com/players/'.$pscript[0].'-'.$playerID.'.js"></script></div>';
        $ftitle = '<div class="featuredinfo"><div class="wrapper"><h3><a href="'.get_the_permalink($pID).'"><span>'.$pTitle.'</span></a></h3>';
        $fexcerpt = '<p>'.get_the_excerpt($pID).'</p>';
        $link = '<a class="featured-vid-link" href="'.get_the_permalink($pID).'"><span>View Post</span></a></div></div>';
    }

    

    $args = array(
        'category_name' => $categoryslug,
        'posts_per_page' => 6,
        'exclude' => $pID
    );

    $cat = get_term_by( 'slug', $categoryslug, 'category');

    $heroQuery = new WP_Query($args); 

    if($heroQuery->have_posts()){
        ($herolabel) ? $herotitle = '<h2><span>'.$herolabel.'</span></h2>' : $herotitle = '';
        $herostart = '<section class="hero '.$categoryslug.$f.'">'.$herotitle.'<div class="wrapper">';
        $heroend = '</div></section>';
        $vidholder = '<div class="mainvideo"><div class="mainvideolabel"><div class="wrapper"><h2><i class="i-fire"></i><span>Featured Video</span></h2></div></div><figure class="vidholder"><div class="wrapper">'.$blip.'</div></figure>'.$ftitle.$fexcerpt.$link.'</div>';

        $output .= $herostart.$vidholder;
        $x = 0;

        while($heroQuery->have_posts()){
            
            $heroQuery->the_post();
            $title = get_the_title();
            $link = get_the_permalink();
            $format = get_post_format() ? 'video' : 'standard';

            $thmbalt;
            if($imgalt){
                $thmbalt = $imgalt;
            }else{
                $thmbalt = get_the_excerpt();
            }

            if($noexcerpt){
                $excerpt = '';
            }else{
                $excerpt = '<p>'.get_the_excerpt().'</p>';
            }

            $thumb = '
            <figure class="thumb">
                <div class="wrapper">
                    '.theThumb($args = array( 'pID' => $post->ID, 'size' => 'tiny' )).'
                </div>
            </figure>
            ';

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
            ($x === 0) ? $ad1 = do_shortcode('[mcadunit whichad='.$adslot1.' type=mr position=1]') : $ad1 = '';
            
            $theArticle = '
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
            ($x === 0) ? $ad2 = do_shortcode('[mcadunit whichad='.$adslot2.' type=mr position=2]') : $ad2 = '';
            

            $output .= $ad1.$theArticle.$ad2;

            $x++;
        }
        
        $output .= $heroend;
    }
    wp_reset_postdata();

    return $output;
}

add_shortcode('hero', 'hero_func');