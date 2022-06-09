<?php
function hero_func( $atts = array(), $content="null" ){
    extract(shortcode_atts(array(
        'herolabel' => '',
        'category_name' => 'featured',
        'featuredvid' => '',
        'addclass' => '',
        'adslot1' => '',
        'adslot2' => '',
        'hasexcerpt' => false,
        'playerid' => '',
        'howmany' => 6
    ), $atts));

    $exclude = get_page_by_path( $featuredvid, OBJECT, 'post' )->ID;

    $heroargs = array(
        'loopname' => 'heroloop',
        'listtype' => 'articlecard',
        'category_name' => $category_name,
        'post_type' => 'post',
        'posts_per_page' => $howmany,
        'post_status' => 'publish',
        'adslot1' => $adslot1,
        'adslot2' => $adslot2,
        'featuredvid' => $featuredvid,
        'playerid' => $playerid,
        'exclude' => $exclude
    );

    $herostructure = '
    <section class="hero '.$category_name.' has-featured-vid">
        <div class="row-header">'.$herolabel.'</div>
            <div class="wrapper">
                '.useloop($heroargs).'
            </div>
    </section>
    ';

    return $herostructure;

}

add_shortcode('hero', 'hero_func');