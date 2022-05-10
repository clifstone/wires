<?php

## Ads1 -------------------------------------------------- #
function tie_shortcode_ads1( $atts, $content = null ) {
	$out ='<div class="e3lan-in-post1">'. htmlspecialchars_decode(tie_get_option( 'ads1_shortcode' )) .'</div>';
   return $out;
}
add_shortcode('ads1', 'tie_shortcode_ads1');


## Ads2 -------------------------------------------------- #
function tie_shortcode_ads2( $atts, $content = null ) {
	$out ='<div class="e3lan-in-post2">'. htmlspecialchars_decode(tie_get_option( 'ads2_shortcode' )) .'</div>';
   return $out;
}
add_shortcode('ads2', 'tie_shortcode_ads2');


## Boxes -------------------------------------------------- #
function tie_shortcode_box( $atts, $content = null ) {

	$type = $align = $class = $width = '';
    @extract($atts);

	$type =  ($type)  ? ' '.$type  :'shadow' ;
	$align = ($align) ? ' '.$align : '';
	$class = ($class) ? ' '.$class : '';
	$width = ($width) ? ' style="width:'.$width.'"' : '';

	$out = '<div class="box'.$type.$class.$align.'"'.$width.'><div class="box-inner-block"><i class="tieicon-boxicon"></i>
			' .do_shortcode($content). '
			</div></div>';
    return $out;
}
add_shortcode('box', 'tie_shortcode_box');


## Lightbox -------------------------------------------------- #
function tie_shortcode_lightbox( $atts, $content = null ) {
    @extract($atts);

	$out = '<a rel="prettyPhoto" href="'.$full.'" title="'.$title.'">' .do_shortcode($content). '</a>';
    return $out;
}
add_shortcode('lightbox', 'tie_shortcode_lightbox');


## Toggle -------------------------------------------------- #
function tie_shortcode_Toggle( $atts, $content = null ) {
    @extract($atts);

	$state =  ($state)  ? ' '.$state  :' open' ;
	$title = ($title) ? ' '.$title : '';

	$out = '<div class="clear"></div><div class="toggle '.$state.'"><h3 class="toggle-head-open">'.$title.'<i class="tieicon-up"></i></h3><h3 class="toggle-head-close">'.$title.'<i class="tieicon-down"></i></h3><div class="toggle-content">
			' .do_shortcode($content). '
			</div></div>';
    return $out;
}
add_shortcode('toggle', 'tie_shortcode_Toggle');



## Author_info -------------------------------------------------- #
function tie_shortcode_Author_info( $atts, $content = null ) {
	$title = '';
    @extract($atts);

	$title = ($title) ? ' '.$title : '';

	$out = '<div class="clear"></div><div class="author-info"><img class="author-img" src="'.$image.'" alt="" /><div class="author-info-content"><h3>'. __('About The Author' , 'tie').'</h3>
			' .do_shortcode($content). '
			</div></div>';
    return $out;
}
add_shortcode('author', 'tie_shortcode_Author_info');



## Buttons -------------------------------------------------- #
function tie_shortcode_button( $atts, $content = null ) {
    @extract($atts);
	$align = '';
	$size  = ($size)  ? ' '.$size  :' small' ;
	$color = ($color) ? ' '.$color : ' gray';
	$link  = ($link) ? ' '.$link : '';
	$target = ($target) ? ' target="_blank"' : '';

	$out = '<a href="'.$link.'"'.$target.' class="shortc-button'.$size.$color.$align.'">' .do_shortcode($content). '</a>';
    return $out;
}
add_shortcode('button', 'tie_shortcode_button');


## Flickr -------------------------------------------------- #
function tie_shortcode_flickr( $atts, $content = null ) {
    @extract($atts);

	$number  = ($number)  ? $number  : '5' ;
	$orderby = ($orderby) ? $orderby : 'random';

	$out = '<div class="flickr-wrapper">
	<script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count='. $number .'&amp;display='. $orderby .'&amp;size=s&amp;layout=x&amp;source=user&amp;user='. $id .'"></script>
	</div>';

    return $out;
}
add_shortcode('flickr', 'tie_shortcode_flickr');


## Twitter -------------------------------------------------- #
function tie_shortcode_twitter( $atts, $content = null ) {
    @extract($atts);

	//wp_enqueue_script( 'tie-tweet' );

	$number  = ($number)  ? $number  : '5' ;
	if($avatar == "true") $avatar = "avatar_size:32," ;
	else $avatar = "" ;

	$out = '
		<div id="twitter-shortcode">
			<div class="tweet-shortcode"></div>
		</div>
			<script type="text/javascript">
				jQuery(document).ready(function(){
					jQuery(".tweet-shortcode").tweet({
						username: "'. $id .'",
						'.$avatar .'
						count: '. $number .',
						loading_text: " loading tweets..." ,
					});
				});
			</script>

';

    return $out;
}
add_shortcode('twitter', 'tie_shortcode_twitter');


## Reviews -------------------------------------------------- #
function tie_shortcode_review( $atts, $content = null ) {
	ob_start();
	tie_get_review( 'review-bottom' );
	$output = ob_get_contents();
	ob_end_clean();
	return $output;
}
add_shortcode('review', 'tie_shortcode_review');

## Feeds -------------------------------------------------- #
function tie_shortcode_feeds( $atts, $content = null ) {
    @extract($atts);
	$number  = ($number)  ? $number  : '5' ;
	return tie_get_feeds( $url , $number );
}
add_shortcode('feed', 'tie_shortcode_feeds');


## Google Map -------------------------------------------------- #
function tie_shortcode_googlemap( $atts, $content = null ) {

	$width  = $height = $src = $align = '';
    @extract($atts);
	$width  = ($width)  ? $width  :'620' ;
	$height = ($height) ? $height : '440';

	return tie_google_maps( $src , $width, $height , $align  );
}
add_shortcode('googlemap', 'tie_shortcode_googlemap');



## is_logged_in shortcode -------------------------------------------------- #
function tie_shortcode_is_logged_in( $atts, $content = null ) {
	global $user_ID ;
	if( $user_ID )
		return do_shortcode($content) ;
}
add_shortcode('is_logged_in', 'tie_shortcode_is_logged_in');


## is_guest shortcode -------------------------------------------------- #
function tie_shortcode_is_guest( $atts, $content = null ) {
	global $user_ID ;
	if( !$user_ID  )
		return do_shortcode($content) ;
}
add_shortcode('is_guest', 'tie_shortcode_is_guest');


## AddAudio -------------------------------------------------- #
function tie_shortcode_Tooltip( $atts, $content = null ) {
    @extract($atts);
	if( empty($gravity) ) $gravity = '';
	$out = '<span class="post-tooltip tooltip-'.$gravity.'" title="'.$content.'">'.$text.'</span>';
   return $out;
}
add_shortcode('tooltip', 'tie_shortcode_Tooltip');



## highlight -------------------------------------------------- #
function tie_highlight_shortcode( $atts, $content = null ) {
    return '<span class="highlight">'.$content.'</span>';
}
add_shortcode("highlight", "tie_highlight_shortcode");


## Dropcap  -------------------------------------------------- #
function tie_dropcap_shortcode( $atts, $content = null ) {
    return '<span class="dropcap">'.$content.'</span>';
}
add_shortcode("dropcap", "tie_dropcap_shortcode");



## checklist -------------------------------------------------- #
function tie_checklist_shortcode( $atts, $content = null ) {
    return '<div class="checklist">'.do_shortcode($content).'</div>';
}
add_shortcode("checklist", "tie_checklist_shortcode");


## starlist -------------------------------------------------- #
function tie_starlist_shortcode( $atts, $content = null ) {
    return '<div class="starlist">'.do_shortcode($content).'</div>';
}
add_shortcode("starlist", "tie_starlist_shortcode");


## Facebook -------------------------------------------------- #
function tie_facebook_shortcode( $atts, $content = null ) {
	global $post;
    return '<iframe src="http://www.facebook.com/plugins/like.php?href='. get_permalink($post->ID) .'&amp;layout=box_count&amp;show_faces=false&amp;width=100&amp;action=like&amp;font&amp;colorscheme=light&amp;height=65" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:50px; height:65px;" allowTransparency="true"></iframe>';
}
add_shortcode("facebook", "tie_facebook_shortcode");

## Digg -------------------------------------------------- #
function tie_digg_shortcode( $atts, $content = null ) {
	global $post;
    return "
	<script type='text/javascript'>
(function() {
var s = document.createElement('SCRIPT'), s1 = document.getElementsByTagName('SCRIPT')[0];
s.type = 'text/javascript';
s.async = true;
s.src = 'http://widgets.digg.com/buttons.js';
s1.parentNode.insertBefore(s, s1);
})();
</script><a class='DiggThisButton DiggMedium' href='http://digg.com/submit?url". get_permalink($post->ID) ."=&amp;title=". get_the_title($post->ID) ."'></a>";
}
add_shortcode("digg", "tie_digg_shortcode");


## stumble -------------------------------------------------- #
function tie_stumble_shortcode( $atts, $content = null ) {
	global $post;
    return "<su:badge layout='5' location='". get_permalink($post->ID) ."'></su:badge>
<script type='text/javascript'>
  (function() {
    var li = document.createElement('script'); li.type = 'text/javascript'; li.async = true;
    li.src = 'https://platform.stumbleupon.com/1/widgets.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(li, s);
  })();
</script>";
}
add_shortcode("stumble", "tie_stumble_shortcode");


## pinterest -------------------------------------------------- #
function tie_pinterest_shortcode( $atts, $content = null ) {
	global $post;
    return '<script type="text/javascript" src="//assets.pinterest.com/js/pinit.js"></script>
	<a href="http://pinterest.com/pin/create/button/?url='.get_permalink($post->ID).'&amp;media='.tie_thumb_src( 'slider' ).' class="pin-it-button" count-layout="vertical"><img border="0" src="//assets.pinterest.com/images/PinExt.png" title="Pin It" /></a>';

}
add_shortcode("pinterest", "tie_pinterest_shortcode");



## Google + -------------------------------------------------- #
function tie_google_shortcode( $atts, $content = null ) {
	global $post;
    return "<g:plusone size='tall'></g:plusone>
<script type='text/javascript'>
  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/plusone.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
</script>
";
}
add_shortcode("Google", "tie_google_shortcode");


## feedburner -------------------------------------------------- #
function tie_feedburner_shortcode( $atts, $content = null ) {
    @extract($atts);
    return '<a href="http://feeds.feedburner.com/'.$name.'"><img src="http://feeds.feedburner.com/~fc/'.$name.'?anim=1" height="26" width="88" style="border:0" alt="" /></a>';
}
add_shortcode("feedburner", "tie_feedburner_shortcode");




## Tabs -------------------------------------------------- #
function tie_shortcode_tabs( $atts, $content = null ) {
    @extract($atts);

	if($type== "vertical" ) $type= '-ver';
	else $type= '';

    wp_enqueue_script( 'tie-tabs' );

	$out ='
	<script type="text/javascript">	jQuery(document).ready(function($){	jQuery("ul.tabs-nav").tabs("> .pane"); }); </script>

		<div class="post-tabs'.$type.'">
		'.do_shortcode($content).'
		</div>
	';
   return $out;
}
add_shortcode('tabs', 'tie_shortcode_tabs');


## Tab -------------------------------------------------- #
function tie_shortcode_tab( $atts, $content = null ) {
	$out ='
		<div class="pane">
		'.do_shortcode($content).'
		</div>
	';
   return $out;
}
add_shortcode('tab', 'tie_shortcode_tab');


## Tab Head -------------------------------------------------- #
function tie_shortcode_tabs_head( $atts, $content = null ) {
	$out ='<ul class="tabs-nav">'.do_shortcode($content).'</ul>';
   return $out;
}
add_shortcode('tabs_head', 'tie_shortcode_tabs_head');


## Tab_title -------------------------------------------------- #
function tie_shortcode_tab_title( $atts, $content = null ) {
	$out ='<li>'.do_shortcode($content).'</li>';
   return $out;
}
add_shortcode('tab_title', 'tie_shortcode_tab_title');

## Columns  -------------------------------------------------- #
function tie_one_third( $atts, $content = null ) {
   return '<div class="one_third">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_third', 'tie_one_third');

function tie_one_third_last( $atts, $content = null ) {
   return '<div class="one_third last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('one_third_last', 'tie_one_third_last');

function tie_two_third( $atts, $content = null ) {
   return '<div class="two_third">' . do_shortcode($content) . '</div>';
}
add_shortcode('two_third', 'tie_two_third');

function tie_two_third_last( $atts, $content = null ) {
   return '<div class="two_third last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('two_third_last', 'tie_two_third_last');

function tie_one_half( $atts, $content = null ) {
   return '<div class="one_half">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_half', 'tie_one_half');

function tie_one_half_last( $atts, $content = null ) {
   return '<div class="one_half last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('one_half_last', 'tie_one_half_last');

function tie_one_fourth( $atts, $content = null ) {
   return '<div class="one_fourth">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_fourth', 'tie_one_fourth');

function tie_one_fourth_last( $atts, $content = null ) {
   return '<div class="one_fourth last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('one_fourth_last', 'tie_one_fourth_last');

function tie_three_fourth( $atts, $content = null ) {
   return '<div class="three_fourth">' . do_shortcode($content) . '</div>';
}
add_shortcode('three_fourth', 'tie_three_fourth');

function tie_three_fourth_last( $atts, $content = null ) {
   return '<div class="three_fourth last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('three_fourth_last', 'tie_three_fourth_last');

function tie_one_fifth( $atts, $content = null ) {
   return '<div class="one_fifth">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_fifth', 'tie_one_fifth');

function tie_one_fifth_last( $atts, $content = null ) {
   return '<div class="one_fifth last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('one_fifth_last', 'tie_one_fifth_last');

function tie_two_fifth( $atts, $content = null ) {
   return '<div class="two_fifth">' . do_shortcode($content) . '</div>';
}
add_shortcode('two_fifth', 'tie_two_fifth');

function tie_two_fifth_last( $atts, $content = null ) {
   return '<div class="two_fifth last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('two_fifth_last', 'tie_two_fifth_last');

function tie_three_fifth( $atts, $content = null ) {
   return '<div class="three_fifth">' . do_shortcode($content) . '</div>';
}
add_shortcode('three_fifth', 'tie_three_fifth');

function tie_three_fifth_last( $atts, $content = null ) {
   return '<div class="three_fifth last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('three_fifth_last', 'tie_three_fifth_last');

function tie_four_fifth( $atts, $content = null ) {
   return '<div class="four_fifth">' . do_shortcode($content) . '</div>';
}
add_shortcode('four_fifth', 'tie_four_fifth');

function tie_four_fifth_last( $atts, $content = null ) {
   return '<div class="four_fifth last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('four_fifth_last', 'tie_four_fifth_last');

function tie_one_sixth( $atts, $content = null ) {
   return '<div class="one_sixth">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_sixth', 'tie_one_sixth');

function tie_one_sixth_last( $atts, $content = null ) {
   return '<div class="one_sixth last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('one_sixth_last', 'tie_one_sixth_last');

function tie_five_sixth( $atts, $content = null ) {
   return '<div class="five_sixth">' . do_shortcode($content) . '</div>';
}
add_shortcode('five_sixth', 'tie_five_sixth');

function tie_five_sixth_last( $atts, $content = null ) {
   return '<div class="five_sixth last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('five_sixth_last', 'tie_five_sixth_last');
?>
