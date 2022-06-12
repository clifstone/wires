<?php
function getListItem($args){
    extract($args);
    //var_dump($args);
    switch ($listitem) {
        case 'articlecard':
            $title = get_the_title($pID);
            $link = get_the_permalink($pID);
            $thumb = theThumb($args = array( 'pID' => $pID, 'size' => 'tiny' ));
            $timestamp = dynamicTime($pID);
            $format = get_post_format($pID) ? 'video' : 'standard';
            ($hasexcerpt === true) ? ($excerpt = '<p>'.get_the_excerpt($pID).'</p>') : ($excerpt = '');
            ($format === 'video') ? ($itemfooter = '<footer><span>Watch Video</span></footer>') : ($itemfooter = '<footer><span>Read Article</span></footer>');
            
            $listelem = '
            <article class="grid-item '.$format.'" style="--order: '.$counter.'">
                <a href="'.$link.'">
                    <div class="wrapper">
                        <div class="thumb-wrapper" data-num="'.$counter.'">
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

        break;

        case 'herovid':
 
            $p = get_page_by_path( $featuredvid, OBJECT, 'post' );
            $pID = $p->ID;
            $pTitle = get_the_title($pID);
            $link = get_the_permalink($pID);
            $vjs = get_post_meta($pID, 'vid_embed_metabox', true);
            $vidmeta = getMetas($vjs);
            $vidcategory = get_post_primary_category($pID, 'category')['primary_category'];
            ($herolabel) ? $herotitle = '<h2><span>'.$herolabel.'</span></h2>' : $herotitle = '';
            if(!$playerid){ $playerid = getPlayerID($vjs); }
            $playerscript = '<script src="https://cdn.jwplayer.com/players/'.getVideoID($vjs).'-'.$playerid.'.js"></script>';
            $listelem = '
            <div class="mainvideo">
                <div class="mainvideolabel">
                    <div class="wrapper">
                        <h2><i class="i-fire"></i><span>Featured Video</span></h2>
                    </div>
                </div>
                <figure class="vidholder">
                    <div class="wrapper">
                        '.$vidmeta.'
                        '.$playerscript.'
                    </div>
                </figure>
                <div class="item-body">
                    <div class="wrapper">
                        <h3>
                            <a href="'.get_the_permalink($pID).'">
                                <span>'.$pTitle.'</span>
                            </a>
                        </h3>
                        <p>'.get_the_excerpt($pID).'</p>
                        <a class="featured-vid-link" href="'.get_the_permalink($pID).'">
                            <span>View Post</span>
                        </a>
                    </div>
                </div>
            </div>';
        break;
      }

    return $listelem;

}