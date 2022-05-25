<?php

$plisturls = getPlaylistURLS($post->ID);
$x = 1;
foreach($plisturls as $plisturl){
    $pID = url_to_postid( basename($plisturl) );
    $vjs = get_post_meta($pID,'vid_embed_metabox', true);
    $plititle = get_the_title($pID);
    
    $pli .='
    <div class="playlistitem" data-scriptsrc="'.getScrSrc($vjs).'" style="--pliorder: '.$x.'">
        '.getMetas($vjs).'
        <div class="wrapper">
            <div class="modcols">
                <div class="modcol">
                    <div class="wrapper">
                        <figure class="thumb">
                            <div class="wrapper">
                                '.getPicture($pID, $tinyPic).'
                            </div>
                        </figure>
                    </div>
                </div>
                <div class="modcol">
                    <div class="wrapper">
                        <h4>'.$plititle.'</h4>
                    </div>
                </div>
                <div class="modcol">
                    <div class="wrapper">
                        <div class="indicators">
                            <span class="indicator watchnow">Watch Now</span>
                            <span class="indicator nowwatching">Now Watching</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    ';
    $x++;
}

echo '
<div class="mcplaylist">
    <div class="wrapper">
        <div class="modcols plistcols">
            <div class="modcol">
                <div class="vjsplayer">
                    <div class="wrapper"></div>
                </div>
            </div>
            <div class="modcol">
                <div class="pli-list">
                    <div class="wrapper">'.$pli.'</div>
                </div>
            </div>
        </div>
    </div>
</div>
'; ?>
<script>
    window.addEventListener('DOMContentLoaded', (e) => {
        let plis = document.querySelectorAll('.playlistitem'),
            firstpli = '<script async src="'+plis[0].getAttribute('data-scriptsrc')+'"><\/script>',
            plcont = document.querySelector('.vjsplayer > .wrapper');

        const reorderplis = () => {
            for(let i = 0; i < plis.length; i++){
                plis[i].style = '--pliorder: ' + (i + 2);
            }
        }

        const fireVid = (e) => {
            let whichVid = '<script async src="'+e.currentTarget.getAttribute('data-scriptsrc')+'"><\/script>';

            reorderplis();
            e.currentTarget.style = '--pliorder: 1';
            jwplayer().remove();
            plcont.innerHTML = '';
            postscribe(plcont, whichVid);
        }

        plis.forEach(pli => {
            pli.addEventListener('click', fireVid);
        });

        inView('.vjsplayer').once("enter", function(){
            postscribe(plcont, firstpli);
        });

    });
</script>