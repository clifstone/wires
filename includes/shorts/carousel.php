<?php
function carousel_func( $atts = array(), $content="null" ) {
    extract(shortcode_atts(array(
        'numofmobile' => '6',
        'numofdesktop' => '6',
        'carousel_label' => 'Featured Videos',
        'category_name' => '',
        'tag_name' => '',
        'rowclass' => '',
        'gridclass' => '',
        'hasexcerpt' => 'true',
        'colorscheme' => '',
        'hasads' => '',
        'mw' => null,
        'fwdbck' => '',
        'loadmoreonclick' => '',
        'loadmoreonscroll' => null,
        'listlabel' => '',
        'noviewall' => '',
        'noheader' => '',
        'nofooter' => false,
        'usehtwo' => true,
        'usehthree' => '',
        'usehfour' => '',
        'ovlist' => ''
    ), $atts));

    $mcRand = rand( 0 , 999999 );
    $x = 0;
    
    if($category_name){
        $args = array(
            'loopname' => 'carousel',
            'listtype' => 'carouselitem',
            'category_name' => $category_name,
            'post_type' => 'post',
            'posts_per_page' => $numofdesktop,
            'post_status' => 'publish',
            'exclude' => $exclude
        );
    }else if($author){
        $args = array(
            'loopname' => 'carousel',
            'author' => $author,
            'posts_per_page' => $numof,
            'post_status' => 'publish',
            'hasexcerpt' => $hasexcerpt,
        );
    }

    global $post;
    $label = get_post_meta($post->ID, 'pagecarousel_label', true);

    if($label){
        $carousel_label = $label;
    }

    if($usehtwo && !is_singular('influencersections')){
        $header = '<h2>'.$carousel_label.'</h2>';
    }else if(is_singular('influencersections')){
        $noheader = true;
    }else{
        $header = '<h3>'.$carousel_label.'</h3>';
    }

    if(!$noheader){
        $rowheader = '
        <div class="row-header">
            <div class="wrapper">
                '.$header.'
            </div>
        </div>
        ';
    }

    $carouselstructure = '
    <section class="carousel '.$helperclass.'" '.$datacatname.'>
        '.$rowheader.'
        <div class="carousel__wrapper">
            <div class="splide" aria-label="Featured Videos">
                <div class="splide__track">
                    <div class="splide__list">
                        '.useloop($args).'
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        new Splide( ".splide", {
            perPage: 1,
            mediaQuery: "min",
            type: "loop",
            focus: "center",
            perMove: 1,
            
        } ).mount();
    </script>
    ';
    return $carouselstructure;
}
add_shortcode( 'carousel', 'carousel_func' );
?>