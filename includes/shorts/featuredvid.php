<?php
function featuredvid_func( $atts = array(), $content="null" ) {

    extract(shortcode_atts(array(
        'vidslug' => '',
        'headertxt' => 'Featured Video',
        'link' => '',
        'linktxt' => ''
    ), $atts));

    $mcRand = rand( 0 , 999999 );

    $p = get_page_by_path( $vidslug, OBJECT, 'post' );
    $pID = $p->ID;
    $pTitle = $p->post_title;
    $vid = get_post_meta($pID,'vid_embed_metabox', true);
    $vidcategory = get_post_primary_category($pID, 'category')['primary_category'];

    $html = html_entity_decode($vid);
    $dom = new DOMDocument;
    @$dom->loadHTML($html);

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

    $mod = '
    <div class="featured-vid mod">
        <div class="wrapper">
            <h2><span>'.$headertxt.'</span></h2>
            <div class="vid-holder"><div class="wrapper"></div></div>
            <h3><a class="featured-vid-link" href="'.get_the_permalink($pID).'"><span>'.$pTitle.'</span></a></h3>
            <a class="click-here" href="'.get_home_url().'/'.'category/'.$vidcategory->slug.'"><span>View all in '.$vidcategory->name.'</span></a>
        </div>
    </div>
    ';

    add_action('wp_footer', function() use($vid_sources){
        $playerID = 'FR5xkFND';
        ?>

        <script>
        
            document.onreadystatechange = function () {
                if (document.readyState == "complete") {
                    var featuredVidModule = document.querySelector('.featured-vid'),
                        featuredVid = document.querySelector('.featured-vid>.wrapper>.vid-holder>.wrapper'),
                        jw = document.querySelector('.jwplayer');
        
                function writefeaturedvidmod(){
        
                    <?php if(count($vid_sources) === 1){
                        $vsource = basename($vid_sources[0], '.js');
                        $pscript = explode('-', $vsource);
                    ?>
                        blip = '<script defer src="<?php echo 'https://cdn.jwplayer.com/players/'.$pscript[0].'-'.$playerID.'.js' ?>"><\/script>';
                    <?php }
                    
                    if(count($vid_sources) === 7){
                        $vsource = basename($vid_sources[6], '.js');
                        $pscript = explode('-', $vsource); ?>
                        blip = '<div itemscope itemtype="https://schema.org/VideoObject"><meta itemprop="uploadDate" content="<?php echo $vid_sources[0]; ?>"/><meta itemprop="name" content="<?php echo esc_js($vid_sources[1]); ?>"/><meta itemprop="description" content="<?php echo esc_js($vid_sources[2]); ?>"/><meta itemprop="duration" content="<?php echo $vid_sources[3]; ?>" /><meta itemprop="thumbnailUrl" content="<?php echo $vid_sources[4]; ?>"/><meta itemprop="contentUrl" content="<?php echo $vid_sources[5]; ?>"/><script defer src="<?php echo 'https://cdn.jwplayer.com/players/'.$pscript[0].'-'.$playerID.'.js' ?>"><\/script></div>';
                    <?php }
                    if(count($vid_sources) === 6){
                        $vsource = basename($vid_sources[5], '.js');
                        $pscript = explode('-', $vsource);
                        ?>
                        blip = '<div itemscope itemtype="https://schema.org/VideoObject"><meta itemprop="uploadDate" content="<?php echo $vid_sources[0]; ?>"/><meta itemprop="name" content="<?php echo esc_js($vid_sources[1]); ?>"/><meta itemprop="description" content="<?php echo esc_js($vid_sources[2]); ?>"/><meta itemprop="thumbnailUrl" content="<?php echo $vid_sources[3]; ?>"/><meta itemprop="contentUrl" content="<?php echo $vid_sources[4]; ?>"/><script defer src="<?php echo 'https://cdn.jwplayer.com/players/'.$pscript[0].'-'.$playerID.'.js' ?>"><\/script></div>';
                    <?php } ?>
                    
                    featuredVid.innerHTML="";
                    //document.body.classList.add('destroy-floating');
                    inView(".featured-vid").once("enter", function(){
                        postscribe(featuredVid, blip);
                    });
                };
                writefeaturedvidmod();
                }
            }
        
        </script>
        
        <?php }, 1001);

        return $mod;

}
add_shortcode( 'featuredvid', 'featuredvid_func' );