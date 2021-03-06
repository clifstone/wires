<?php
function getListItem($args){
    extract($args);
    switch ($listitem) {
        case 'articlecard':
            $title = get_the_title($pID);
            $link = get_the_permalink($pID);
            $thumb = theThumb($args = array( 'pID' => $pID, 'size' => 'tiny' ));
            $timestamp = dynamicTime($pID);
            $format = get_post_format($pID) ? 'video' : 'standard';
            ($hasexcerpt === true || $hasexcerpt === '1') ? ($excerpt = '<p>'.get_the_excerpt($pID).'</p>') : ($excerpt = '');
            ($format === 'video') ? ($itemfooter = '<footer><span>Watch Video</span></footer>') : ($itemfooter = '<footer><span>Read Article</span></footer>');
            
            $listelem = '
            <article class="grid-item '.$format.'">
                <div class="wrapper">
                    <a href="'.$link.'">
                        <div class="thumb-wrapper" data-num="'.$counter.'">
                            <figure class="thumb">
                                <div class="wrapper">
                                    '.$thumb.'
                                </div>
                            </figure>
                            '.$timestamp.'
                        </div>
                    </a>
                    <div class="item-body">
                        <header>
                            <h3>
                                <a href="'.$link.'">
                                    <span aria-label="'.$title.'" title="'.$title.'">'.$title.'</span>
                                </a>
                            </h3>
                        </header>
                        '.$excerpt.'
                        '.$itemfooter.'
                    </div>
                </div>
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

        case 'herovid-amp':
 
            $p = get_page_by_path( $featuredvid, OBJECT, 'post' );
            $pID = $p->ID;
            $pTitle = get_the_title($pID);
            $link = get_the_permalink($pID);
            $vjs = get_post_meta($pID, 'vid_embed_metabox', true);
            $vidmeta = getMetas($vjs);
            $vidcategory = get_post_primary_category($pID, 'category')['primary_category'];
            ($herolabel) ? $herotitle = '<h2><span>'.$herolabel.'</span></h2>' : $herotitle = '';
            if(!$playerid){ $playerid = getPlayerID($vjs); }
            $playerscript = '<amp-jwplayer data-player-id="'.$playerid.'" data-media-id="'.getVideoID($vjs).'" layout="responsive" width="16" height="9"></amp-jwplayer>';
            $listelem = '
            <div class="mainvideo">
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
            add_action('wp_footer', function(){
                echo '
                    <script async src="https://cdn.ampproject.org/v0.js"></script>
                    <script async custom-element="amp-jwplayer" src="https://cdn.ampproject.org/v0/amp-jwplayer-0.1.js"></script>
                ';
            }, 1001);
        break;

        case 'carouselitem':
            $title = get_the_title($pID);
            $link = get_the_permalink($pID);
            $thumb = theThumb($args = array( 'pID' => $pID, 'size' => 'small' ));
            $timestamp = dynamicTime($pID);
            $format = get_post_format($pID) ? 'video' : 'standard';
            ($hasexcerpt === true || $hasexcerpt === '1') ? ($excerpt = '<p>'.get_the_excerpt($pID).'</p>') : ($excerpt = '');
            ($format === 'video') ? ($itemfooter = '<footer><span>Watch Video</span></footer>') : ($itemfooter = '<footer><span>Read Article</span></footer>');
            
            $listelem = '
            <article class="grid-item splide__slide '.$format.'">
                <div class="wrapper">
                    <a href="'.$link.'">
                        <div class="thumb-wrapper" data-num="'.$counter.'">
                            <figure class="thumb">
                                <div class="wrapper">
                                    '.$thumb.'
                                </div>
                            </figure>
                            '.$timestamp.'
                        </div>
                    </a>
                    <div class="item-body">
                        <header>
                            <h3>
                                <a href="'.$link.'">
                                    <span aria-label="'.$title.'" title="'.$title.'">'.$title.'</span>
                                </a>
                            </h3>
                        </header>
                        '.$excerpt.'
                        '.$itemfooter.'
                    </div>
                </div>
            </article>
            ';
        break;
      }

    return $listelem;

}