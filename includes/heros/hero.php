<?php
function hero_func( $atts = array(), $content="null" ){
    extract(shortcode_atts(array(
        'herolabel' => '',
        'categoryslug' => '',
        'featuredvid' => '',
        'addclass' => '',
        'adslot1' => '',
        'adslot2' => '',
        'hasexcerpt' => false,
        'playerid' => '',
        'numOf' => 6
    ), $atts));

    $args = array(
        'loopname' => 'heroloop',
        'category_name' => $categoryslug,
        'post_type' => 'post',
        'posts_per_page' => $numOf,
        'adslot1' => $adslot1,
        'adslot2' => $adslot2,
        'featuredvid' => $featuredvid,
        'playerid' => $playerid,
        'post__not_in' => array(get_page_by_path( $featuredvid, OBJECT, 'post' )->ID)
    );

    $herostructure = '
    <section class="hero '.$categoryslug.' has-featured-vid">
        <div class="row-header">'.$herotitle.'</div>
            <div class="wrapper">
                '.useloop($args).'
            </div>
    </section>
    ';

    return $herostructure;

}

add_shortcode('hero', 'hero_func');