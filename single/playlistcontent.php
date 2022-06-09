<?php
$plciurls = getPlaylistURLS($post->ID);
$x = 1;

foreach($plciurls as $plciurl){
    $pID = url_to_postid( basename($plciurl) );
    $plcititle = get_the_title($pID);
    $plciexcerpt = get_the_excerpt($pID);
    $plcilink = get_the_permalink($pID);
    $articleItem .= getListItem( $args = array( 'listitem' => 'articlecard', 'pID' => $pID, 'counter' => $x, 'hasexcerpt' => true ) );;
}

echo '
<div class="plcicontent">
    <div class="wrapper">
        <div class="plciheader">
            <h2><span>Playlist Videos</span></h2>
        </div>
        <div class="grid-wrapper">
            <div class="grid sm-1 md-2 md-2 lg2-5">
                '.$articleItem.'
            </div>
        </div>
    </div>
</div>
';