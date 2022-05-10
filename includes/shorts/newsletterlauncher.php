<?php

    function newsletter_launcher_func( $atts = array(), $content="null" ){

        global $post;
        $mcRand = rand( 0 , 999999 );
  
        extract(shortcode_atts(array(
            'imageURL' => 'https://www.getzone.com/gzstaging/wp-content/uploads/2022/01/join.png',
            'headline' => '',
            'clickhere' => false
        ), $atts));

        if($headline){
            $mcHeadline = "<h3><span>'.$headline.'</span></h3>";
        }else{
            $mcHeadline = "";
        }

        if($clickhere){
            $clickHere = "<div class='click-here'>Click Here</div>";
        }else{
            $clickHere = "";
        }

        $output = '
        <div id="nwsltr'.$mcRand.'" class="newsletter-launcher mod">
            <div class="wrapper">
                <figure class="thumb-holder"><div class="wrapper"><img class="lozad" data-src="'.$imageURL.'" width="100%" height="auto" alt="Man shooting at target range - Join Our Newsletter Mailing List" /></div></figure>
                '.$mcHeadline.'
                '.$clickHere.'
            </div>
        </div>
        <script>
            window.addEventListener("load", function() {
                var newslauncher = document.getElementById("nwsltr'.$mcRand.'"),
                    newspop = document.getElementById("nwsltrpopup");

                function launchnews(){
                    newspop.classList.add("active");
                }

                newslauncher.addEventListener("click", launchnews);
            });
        </script>
        ';

        return $output;
    };
    add_shortcode('newsletter_launcher', 'newsletter_launcher_func');