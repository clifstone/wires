<?php

    function mcadunit_func( $atts = array(), $content="null" ){

        global $post;
  
        extract(shortcode_atts(array(
            'whichad' => '',
            'type' => '',
            'position' => '',
            'adclass' => ''
        ), $atts));

        $output = '';

        $adquery = new WP_Query(
			array(
				'post_type' => 'ad_store',
				'name' => $whichad,
				'posts_per_page' => 1,
			)
		);

		if ( $adquery->have_posts() ) {
            while ( $adquery->have_posts() ) {
                $adquery->the_post();

                $the_tag = get_post_meta(get_the_ID(), 'ad_tag_metabox', true);

                $dom = new DOMDocument;
                @$dom->loadHTML($the_tag);
                $scrsrc = $dom->getElementsByTagName('script');
                $adconts = $dom->getElementsByTagName('div');
                $ad_sources = [];

                foreach ($adconts as $adcont){
                    $adcontent = $adcont->getAttribute('id');
                    array_push($ad_sources, $adcontent);
                }

                foreach ($scrsrc as $srcs){
                    array_push($ad_sources, $srcs);
                }

                $dLay = $ad_sources[0];
                $fScr = $ad_sources[1]->nodeValue;
                $nScr = $ad_sources[2]->nodeValue;
                $mcRand = rand( 0 , 999999 );

                add_action( 'wp_footer', function() use ($dLay, $fScr, $nScr, $mcRand) {
                    echo '
                        <script type="module">
                            window.addEventListener("load",function(){
                                function ps'.$mcRand.'(){
                                    '.$fScr.$nScr.'
                                }
                                inView("#'.$dLay.'").once("enter", function(){
                                    postscribe(document.body, ps'.$mcRand.');
                                });
                            });
                        </script>
                    ';
                }, 101);

                $plaidstart = '<div class="plaidslot mw '.$type.' pos_'.$position.' '.$adclass.'"><div class="wrapper">';
                $plaidlayer = '<div id="'.$dLay.'"></div>';
                $plaidend = '</div></div>';

                $output .= $plaidstart.$plaidlayer.$plaidend;
            }
            wp_reset_postdata();
        }
        return $output;
    };
    add_shortcode('mcadunit', 'mcadunit_func'); 