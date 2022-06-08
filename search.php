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

$args = array(
    'loopname' => 'search',
    'search_query' => $search_query
);
$articleItem = useloop($args);

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
                            '.$articleItem.'
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