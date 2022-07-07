<?php
function useloop($args){
    extract($args);

    switch ($loopname) {
        case 'instalist':
          $x = 0;
          $instalistquery = new WP_Query( $args );
          if($instalistquery->have_posts()){
              while($instalistquery->have_posts() && $x <= ($posts_per_page + 1)){
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
          if(have_posts()){
              while(have_posts()){
                  the_post(); 

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
              while($heroQuery->have_posts() && $x <= ($posts_per_page + 1)){
                  $heroQuery->the_post();
                  $theID = get_the_ID();

                  if ( ! in_array( $theID, array($exclude) ) ) {

                    $listitem .= getListItem( $args = array( 'listitem' => $listtype, 'pID' => get_the_ID(), 'counter' => $x, 'hasexcerpt' => $hasexcerpt ) );
                    $x++;
                  }
              }
          }
          wp_reset_query();

          if($featuredvid){ $fvid = getListItem($args = array( 'listitem' => $herovideo, 'featuredvid' => $featuredvid, 'playerid' => $playerid )); }
          if($adslot1){ $ad1 = do_shortcode('[mcadunit whichad='.$adslot1.' type=mr position=1]'); }
          if($adslot2){ $ad2 = do_shortcode('[mcadunit whichad='.$adslot2.' type=mr position=2]'); }

          return $fvid.$ad1.$listitem.$ad2;

        break;

        case 'carousel':
          $x = 0;
          $carouselquery = new WP_Query($args);
          if($carouselquery->have_posts()){
            while($carouselquery->have_posts()){
              $carouselquery->the_post();
              $args = array(
                'listitem' => $listtype,
                'pID' => get_the_ID(),
                'counter' => $x,
              );
              $listitem .= getListItem( $args = array( 'listitem' => $listtype, 'pID' => get_the_ID(), 'counter' => $x ) );
              $x++;
            }
          }
          wp_reset_query();
          return $listitem;
        break;

      }

}