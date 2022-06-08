<?php
function useloop($args){
    extract($args);

    switch ($loopname) {
        case 'instalist':
          
          $x = 0;
          $instalistquery = new WP_Query( $args );
          if($instalistquery->have_posts()){
              while($instalistquery->have_posts()){
                  $instalistquery->the_post();

                  $args = array(
                    'listitem' => 'articlecard',
                    'pID' => get_the_ID(),
                    'counter' => $x,
                    'hasexcerpt' => $hasexcerpt
                  );
                  $articleItem .= getListItem($args);
                  $x++;
              }
          }
          wp_reset_postdata();

          return $articleItem;
          
        break;

        case 'search':

          global $query_string;
          global $wp_query;

          $query_args = explode("&", $query_string);
          $search_query = array();

          foreach($query_args as $key => $string) {
              $query_split = explode("=", $string);
              $search_query[$query_split[0]] = $query_split[1];
          }
          $total_results = $wp_query->found_posts;

          $x = 0;
          $search = new WP_Query($search_query);
          if($search->have_posts()){
              while($search->have_posts()){
                  $search->the_post();

                  $args = array(
                    'listitem' => 'articlecard',
                    'pID' => get_the_ID(),
                    'counter' => $x,
                    'hasexcerpt' => true
                  );
                  $articleItem .= getListItem($args);
                  $x++;
              }
          }else{
              $articleItem = '<article class="grid-item"><div class="wrapper">Uh oh... Nothing here... Try a different search</div></article>';
          }
          wp_reset_postdata();

          return $articleItem;

        break;

        case 'heroloop':

          $x = 0;
          $heroQuery = new WP_Query($args);
          if($heroQuery->have_posts()){
              while($heroQuery->have_posts()){
                  $heroQuery->the_post();
                  
                  if($x === 0){
                      if($featuredvid){ $fvid = getListItem($args = array( 'listitem' => 'herovid', 'featuredvid' => $featuredvid, 'playerid' => $playerid )); }
                      if($adslot1){ $ad1 = do_shortcode('[mcadunit whichad='.$adslot1.' type=mr position=1]'); }
                      if($adslot2){ $ad2 = do_shortcode('[mcadunit whichad='.$adslot2.' type=mr position=2]'); }
                  }

                  $listitem .= getListItem( $args = array( 'listitem' => 'articlecard', 'pID' => get_the_ID(), 'counter' => $x, 'hasexcerpt' => $hasexcerpt ) );

                  $x++;
              }
          }

          return $fvid.$ad1.$listitem.$ad2;

        break;

      }

}