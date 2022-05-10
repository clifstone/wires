<?php
function instalist_func( $atts = array(), $content="null" ) {

    extract(shortcode_atts(array(
        'numofmobile' => '4',
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
        'ovlist' => ''
    ), $atts));

    $output;
    $mcRand = rand( 0 , 999999 );
    $numof;
    $mcpages;
    $x = 0;
    
    //var_dump($atts);
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

    $viewalllink = '';

    if($category_name){
        $rowheaderslug = '<h2><a href="'.home_url().'/'.'category/'.$category_name.'"><span>'.$slugname.'</span></a></h2>';
    }else{
        $rowheaderslug = '<h2><span>'.$slugname.'</span></h2>';
    }
    

    if($loadmoreonclick){
        $listtype = 'loadmoreonclick';
        $mcloadmore = '<div id="loadmore-'.$mcRand.'" class="load-more-posts lmbtn" data-id="'.$mcRand.'" data-catname="'.$category_name.'" data-tagname="'.$tag_name.'" data-numof="'.$numof.'"><span>Show More posts</span><i><svg viewBox="0 0 24 24" preserveAspectRatio="xMidYMid meet" focusable="false"><g><path d="M12,15.7L5.6,9.4l0.7-0.7l5.6,5.6l5.6-5.6l0.7,0.7L12,15.7z"></path></g></svg></i></div>';
    }
    if($loadmoreonscroll){
        $listtype = 'loadmoreonscroll';
        $mcloadmore = '<div id="loadmore-'.$mcRand.'" class=" load-more-posts" data-id="'.$mcRand.'" data-catname="'.$category_name.'" data-tagname="'.$tag_name.'" data-numof="'.$numof.'"></div>' . $viewalllink;
    }
    if($fwdbck){
        $listtype = 'fwdbck';
        $mcloadmore = '<div id="loadmore-'.$mcRand.'" class="load-more-posts" data-id="'.$mcRand.'" data-catname="'.$category_name.'" data-tagname="'.$tag_name.'" data-numof="'.$numof.'"><div class="wrapper"><span>More Posts</span><div id="bck-'.$mcRand.'" class="btn bck" name="load previous posts"><i class="i-previous2"></i></div><div id="fwd-'.$mcRand.'" class="btn fwd" name="load next posts"><i class="i-next2"></i></div></div></div>';
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
                '.$mcloadmore.'
            </div>
        </footer>
        ';
    }
    
    $mcRowStart = '<div id="mclist-'.$mcRand.'" class=" mclist '.$colorscheme.' '.$rowclass.' '.$listtype.'"><div class="wrapper '.$mw.'">';
    $mcRowEnd = '</div></div>';
    $mcGridStart = '<div class="grid-wrapper"><div id="mcgrid-'.$mcRand.'" class="grid '.$gridclass.' '.$thumbshapesm.' '.$thumbshapemd.' '.$thumbshapelg.'">';
    $mcGridEnd = '</div></div>';
    
    if($category_name){
        $args = array(
            'numberposts' => $numof,
            'post_status' => 'publish',
            'category_name' => $category_name,
        );
        $recent_posts = wp_get_recent_posts($args);
        $totalnum = get_term_by('slug', $category_name, 'category')->count;
    }else if($tag_name){
        $args = array(
            'numberposts' => $numof,
            'post_status' => 'publish',
            'tag' => $tag_name,
        );
        $recent_posts = wp_get_recent_posts($args);
        $totalnum = get_term_by('slug', $tag_name, 'post_tag')->count;
    }else{
        $args = array(
            'numberposts' => $numof,
            'post_status' => 'publish',
        );
        $recent_posts = wp_get_recent_posts($args);
        $totalnum = wp_count_posts()->publish;
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
                <picture>
                    <source media="(min-width: 320px)" srcset="'.$mcThumb_small[0].'">
                    <img src="'.$mcThumb_tiny[0].'" alt="'.$thmbalt[0].'" loading="lazy">
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
        
        $x++;
    }
    
    
    $derff = ob_get_contents();
    ob_end_clean();

    ob_start(); ?>
    <script>
        window.addEventListener("load", function(){

            var mcID = document.getElementById('loadmore-<?php echo $mcRand; ?>'),
                mcCatName = mcID.getAttribute('data-catname'),
                mcTagName = mcID.getAttribute('data-tagname'),
                mcNumOf = mcID.getAttribute('data-numof'),
                mcRand = mcID.getAttribute('data-id');
                
            var page = 1,
                mcTotalNum = <?php echo $totalnum ?>;

            var mcWhich = mcID.parentNode.parentNode.parentNode.parentNode; 

            function fireAllTorpedos(mcCatName, mcNumOf, mcTagName) {

                data = {
                    'action': 'load_posts_by_ajax',
                    'page': page,
                    'category_name': mcCatName,
                    'tag_name': mcTagName,
                    'numof': mcNumOf,
                    'hasexcerpt': <?php echo $hasexcerpt; ?>
                };

                request = new XMLHttpRequest();
                request.open('POST', '<?php echo admin_url("admin-ajax.php"); ?>', true);
                request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');

                var mcList = document.getElementById('mclist-<?php echo $mcRand; ?>');
                var mcElem = document.getElementById('mcgrid-<?php echo $mcRand; ?>');

                request.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        
                        var response = this.responseText;

                        mcList.classList.add('loaded');
                        <?php if($fwdbck){ ?>
                            if(response.length){
                                document.getElementById('mcgrid-<?php echo $mcRand; ?>').innerHTML = '';
                                mcElem.insertAdjacentHTML('beforeend', response);
                                
                            }else{
                                page--;
                            }
                        <?php }else{ ?>
                            mcElem.insertAdjacentHTML('beforeend', response);
                            //page++
                        <?php } ?>
                    };
                }
                request.send('action=' + '' + data.action + '' + '&nonce=' + '' + '<?php echo wp_create_nonce( 'load_posts_by_ajax_' ) ?>' + '' + '&category_name=' + '' + data.category_name + '' + '&tag_name=' + '' + data.tag_name + '' + '&numof=' + '' + data.numof + '' + '&page=' + '' + data.page + '' + '&hasexcerpt=' + '' + <?php echo $hasexcerpt; ?> + '');
            }

            
            <?php if($fwdbck){ ?>
                var mcFwd = document.getElementById('fwd-<?php echo $mcRand; ?>'),
                    mcBck = document.getElementById('bck-<?php echo $mcRand; ?>');
                function checkpage(){
                    var mcpages = <?php echo $mcpages; ?>;
                    if(page === 1){
                        mcBck.classList.add('disabled');
                    }
                    if(page > 1){
                        mcBck.classList.remove('disabled');
                    }
                    if(page === mcpages){
                        mcFwd.classList.add('disabled');
                    }else{
                        mcFwd.classList.remove('disabled');
                    }
                }
                checkpage();
                mcFwd.addEventListener('click', function(){
                    page++;
                    checkpage();
                    fireAllTorpedos(mcCatName, mcNumOf, mcTagName);
                });
                mcBck.addEventListener('click', function(){
                    if(page !== 1){
                        page--;
                        checkpage();
                        fireAllTorpedos(mcCatName, mcNumOf, mcTagName); 
                    }
                });
            <?php }else if($loadmoreonclick || $loadmoreonscroll){ ?>

                var mcloadmore = document.querySelector('#loadmore-<?php echo $mcRand; ?>');
                cheese = page * mcNumOf;
                    if(cheese >= mcTotalNum){ document.getElementById('mclist-<?php echo $mcRand; ?>').classList.add('nomore'); };
                mcloadmore.addEventListener('click', function(){
                    page++;
                    cheese = page * mcNumOf;
                    if(cheese >= mcTotalNum){ document.getElementById('mclist-<?php echo $mcRand; ?>').classList.add('nomore'); };
                    fireAllTorpedos(mcCatName, mcNumOf, mcTagName);
                }, false);
                
            <?php }

                if($loadmoreonscroll){ ?>
                    inView("#loadmore-<?php echo $mcRand; ?>").on('enter', function(){
                        fireAllTorpedos(mcCatName, mcNumOf, mcTagName);
                    });
                <?php }

            ?>
        });
        //console.log(page);
    </script>
    <?php
    $slergh = ob_get_contents();
    ob_end_clean(); ?>
    
    <?php return $mcRowStart.$rowheader.$mcGridStart.$derff.$mcGridEnd.$rowfooter.$slergh.$mcRowEnd;
 
}
add_shortcode( 'instalist', 'instalist_func' );