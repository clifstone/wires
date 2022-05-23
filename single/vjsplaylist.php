<?php

$plisturls = explode(",", get_post_meta($post->ID,'vid_playlist_urls', true) );
$x = 1;
foreach($plisturls as $plisturl){
    $pID = url_to_postid( basename($plisturl) );
    $vjs = get_post_meta($pID,'vid_embed_metabox', true);
    $plithumb = wp_get_attachment_image_src( get_post_thumbnail_id($pID), 'small' )[0];
    $imgalt = get_post_meta( $pID, '_wp_attachment_image_alt', true);
    ($imgalt) ? ($thmbalt = $imgalt) : ($thmbalt = get_the_excerpt($pID));
    $plititle = get_the_title($pID);
    
    $pli .='
    <div class="playlistitem" data-scriptsrc="'.getScrSrc($vjs).'" style="--pliorder: '.$x.'">
        '.getMetas($vjs).'
        <div class="wrapper">
            <div class="gridcols">
                <div class="gridcol">
                    <div class="wrapper">
                        <div class="thumb">
                            <div class="wrapper">
                                <img src="'.$plithumb.'" alt="'.$thmbalt.'">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="gridcol">
                    <div class="wrapper">
                        <h4>'.$plititle.'</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    ';
    $x++;
}

$theplist = '
<div class="mcplaylist">
    <div class="wrapper">
        <div class="gridcols plistcols">
            <div class="gridcol">
                <div class="vjsplayer">
                    <div class="wrapper"></div>
                </div>
            </div>
            <div class="gridcol">
                <div class="pli-list">
                    <div class="wrapper">'.$pli.'</div>
                </div>
            </div>
        </div>
    </div>
</div>
';

echo $theplist; ?>
<script>
    window.addEventListener('DOMContentLoaded', (e) => {
        let plis = document.querySelectorAll('.playlistitem');

        const reorderplis = () => {
            for(let i = 0; i < plis.length; i++){
                plis[i].style = '--pliorder: ' + (i + 2);
            }
        }

        const fireVid = (e) => {
            console.log(e.currentTarget.getAttribute('data-scriptsrc'));
            reorderplis();
            e.currentTarget.style = '--pliorder: 1';
        }

        plis.forEach(pli => {
            pli.addEventListener('click', fireVid, true);
        });
    });
</script>