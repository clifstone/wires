<?php
global $query_string;
global $wp_query;
$query_args = explode("&", $query_string);
$search_query = array();

foreach($query_args as $key => $string) {
    $query_split = explode("=", $string);
    $search_query[$query_split[0]] = $query_split[1];
}
$total_results = $wp_query->found_posts;
$search = new WP_Query($search_query);

$search_item;
$x = 0;

if(have_posts()){
    while(have_posts()){
        the_post();
        $pID = get_the_ID();
        $link = get_the_permalink();
        $format = get_post_format() ? 'video' : 'standard';
        $thumb = theThumb($args = array( 'pID' => $pID, 'whichOne' => 'tiny' ));
        $timestamp = dynamicTime();
        $title = get_the_title();
        $excerpt = get_the_excerpt();
        ($format === 'video') ? ($itemfooter = '<footer>Watch Video</footer>') : ($itemfooter = '<footer>Read Article</footer>');

        $search_item .='
        <article class="grid-item '.$artclass.' '.$format.'" style="--order: '.$x.'">
            <a href="'.$link.'">
                <div class="wrapper">
                    <div class="thumb-wrapper" data-num="'.$x.'">
                        <div class="thumb">
                            <div class="wrapper">'.$thumb.'</div>
                        </div>
                        '.$timestamp.'
                    </div>
                    <div class="item-body">
                        <header>
                            <h3><span aria-label="'.$title.'" title="'.$title.'">'.$title.'</span></h3>
                        </header>
                        <p>'.$excerpt.'</p>
                        <footer>'.$itemfooter.'</footer>
                    </div>
                </div>
            </a>
        </article>
        ';
        $x++;
    }
}else{
    $search_item = '<article class="grid-item"><div class="wrapper">Uh oh... Nothing here... Try a different search</div></article>';
}
wp_reset_postdata();

get_header();

echo '<div class="searchpageform">'; get_template_part( 'parts/searchform' ); echo '</div>';

echo '
<div class="main-wrap gridcols">
    <div class="gridcol">
        <main class="site-main" role="main">';

            

            echo 
            '<div class="mclist">
                <div class="wrapper">
                    <header class="row-header">
                        <div class="wrapper">
                            <h1><span>You searched for: <span><strong>'.get_search_query().'</strong></h1>
                        </div>
                    </header>
                    <div class="grid-wrapper">
                        <div class="grid sm-1 md-2 lg-1 lg2-2 lg3-3">
                            '.$search_item.'
                        </div>
                    </div>
                </div>
            </div>
            <nav class="pagination">
                <div class="wrapper">';

                    numberedPagination();

                echo '
                </div>
            </nav>
        </main>
    </div>
    <div class="gridcol">';

        get_sidebar();
        
    echo '
    </div>
</div>
';

get_footer();