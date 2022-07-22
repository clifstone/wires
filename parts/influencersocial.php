<?php
extract($args);
$socialopts = array(array('facebooklink','fb', 'facebook'), array('twitterlink', 'tw', 'twitter'), array('instagramlink', 'ig', 'instagram'), array('youtubelink', 'yt', 'youtube'));

// function printSocialBtn($url, $classname, $iconname){
//     echo '<a href="'.get_post_meta($url, true).'" target="_blank" rel="nofollow noopener noreferrer"  class="socialbtn '.$classname.' headerbtn" name="Click here to visit the '.get_bloginfo().' '.$iconname.' page"><i class="i-'.$iconname.'"></i></a>';
// }

echo '
<div class="influencer-social social">
    <div class="wrapper">
        <div class="socialbtns">
        ';
        foreach($socialopts as $socialopt){
            if(get_post_meta($pID, $socialopt[0], true)){
                echo '<a href="'.get_post_meta($pID, $socialopt[0], true).'" target="_blank" rel="nofollow noopener noreferrer"  class="socialbtn '.$socialopt[1].' headerbtn" name="Click here to visit the '.get_bloginfo().' '.$socialopt[2].' page"><i class="i-'.$socialopt[2].'"></i></a>';
            }
            //(get_post_meta($post->ID,$socialopt[0], true)) ? printSocialBtn($socialopt[0], $socialopt[1], $socialopt[2]) : '';
        }
        echo '
        </div>
    </div>
</div>
';
?>