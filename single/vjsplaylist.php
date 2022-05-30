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
                                '.theThumb(array( 'pID' => $pID, 'whichOne' => 'tiny' )).'
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
                <div class="vjsplayer articleplaylist">
                    <figure class="featured-thumb thumb">
                        <div class="wrapper">
                            '.theThumb(array( 'pID' => $post->ID, 'whichOne' => 'single' )).'
                        </div>
                    </figure>
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
<?php add_action('wp_footer', function() use($vjs){ ?>

    <script type="module">
        window.addEventListener('load', () =>{
            let vidheaderdiv = document.querySelector('.vjsplayer > .wrapper'),
                plitems = document.querySelectorAll('.playlistitem'),
                firstvid = '<script async src="<?php echo getScrSrc($vjs); ?>"><\/script>';
            const fireVid = (scrsrc) => {
                jwplayer().remove();
                vidheaderdiv.innerHTML = '';
                postscribe(vidheaderdiv, '<script async src="'+scrsrc+'"><\/script>');
            }
            plitems.forEach(plitem => {
                plitem.addEventListener('click', (e) =>{
                    let vidsrc = e.currentTarget.getAttribute('data-scriptsrc');
                    console.log(vidsrc);
                    fireVid(vidsrc);
                });
            });
            postscribe(vidheaderdiv, firstvid);
        });
    </script>

<?php }, 1001); ?>