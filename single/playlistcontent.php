<?php
$plciurls = getPlaylistURLS($post->ID);
$x = 1;

foreach($plciurls as $plciurl){
    $pID = url_to_postid( basename($plciurl) );
    $plcititle = get_the_title($pID);
    $plciexcerpt = get_the_excerpt($pID);
    $plcilink = get_the_permalink($pID);
    $plcicontentitem .= '
    <div class="playlistcontentitem">
        <div class="wrapper">
            <div class="modcols">
                <div class="modcol">
                    <figure class="thumb">
                        <div class="wrapper">
                            '.getPicture($pID, $smallPic).'
                        </div>
                    </figure>
                </div>
                <div class="modcol">
                    <h3>'.$plcititle.'</h3>
                    <p>'.$plciexcerpt.'</p>
                    <a href="'.$plcilink.'"><span>View full post</span></a>
                </div>
            </div>
        </div>
    </div>
    ';
}

echo '
<div class="plcicontent">
    <div class="wrapper">
        <div class="plciheader">
            <h2><span>Playlist Videos</span></h2>
        </div>
        '.$plcicontentitem.'
    </div>
</div>
';