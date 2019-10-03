<?php 
// Si se llama directamente a este archivo, aborta.
defined( 'ABSPATH' ) or die( '¡Sin trampas!' );

function &wfs_rel_nofollow(){
    if(get_option('wfs-options-rel-nofollow') == 1){
       $rel_nofollow = 'rel="me nofollow noopener noreferrer"';
    }else{
      $rel_nofollow = 'rel="me noopener noreferrer"';
    }
    return $rel_nofollow;
}


/*
* Evento share Gtag
*/
function wfs_share_gtag($red_social){
  $shareTitle = str_replace( ' ', '%20', get_the_title());
  if(get_option('wfs-options-ga-gtag') == 'ga'){
    $eventGtag = 'onclick="'."ga('send', 'event', 'social', 'share', '$red_social $shareTitle');".'"';
  }elseif(get_option('wfs-options-ga-gtag') == 'gtag'){
    $eventGtag = 'onclick="'."gtag('event', 'share', { 'event_category': 'social', 'method': '$red_social', 'event_action': 'click', 'event_label': '$shareTitle'});".'"';
  }
  if( get_option( 'wfs-options-analytics' ) == 1 ){ 
    return $eventGtag;
  }else{
    return;
  }
}


function wfs_share_content($content) {
  global $post;

  // Obtengo la URL de la página actual
  $currentURL = esc_url( get_permalink() );

  // Obtengo el título de la página actual
  $currentTitle = str_replace( ' ', '%20', get_the_title());

  // Obtengo el Post Thumbnail 
  $currentThumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'thumbnail' );

  $customLabel = get_option('wfs-share-custom-label');
  $facebook = get_option('wfs-share-facebook');
  $twitterUserName =  get_option('wfs-share-twitter-name');
  $twitter = get_option('wfs-share-twitter');
  $linkedin = get_option('wfs-share-linkedin');
  $buffer =  get_option('wfs-share-buffer');
  $pinterest =  get_option('wfs-share-pinterest');
  $whatsapp =  get_option('wfs-share-whatsapp');
  $before =  get_option('wfs-options-before-post');
/*  $email =  get_option('wfs-share-email');
  $instagram =  get_option('wfs-share-instagram');*/


  $twitterURL = 'https://twitter.com/intent/tweet?text='.$currentTitle.'&amp;url='.$currentURL.'&amp;via='.$twitterUserName;
  $facebookURL = 'https://www.facebook.com/sharer/sharer.php?u='.$currentURL;
  $linkedinURL = 'https://www.linkedin.com/shareArticle?mini=true&url='.$currentURL.'&title='.$currentTitle;
  $bufferURL = 'https://bufferapp.com/add?url='.$currentURL.'&amp;text='.$currentTitle;
  $pinterestURL = 'https://pinterest.com/pin/create/button/?url='.$currentURL.'&amp;media='.$currentThumbnail[0].'&amp;description='.$currentTitle;
  $whatsappURL = 'https://api.whatsapp.com/send?text=Mira%20esto,%20creo%20que%20te%20va%20a%20interesar%0a'.$currentURL. '&amp;media='.$currentThumbnail[0].'&amp;description='.$currentTitle;
  //$emailURL = 'mailto:?subject=' . $currentTitle . '&body=Mira esto, creo que te va a interesar %0a '. $currentURL .'" title="Compartido por Email"';//revisar esta url porque falla

  $wfs_content = '<div class="wfs-share"><!-- WPO friendly share - START-->';
  $wfs_content .= '<p style="font-size:1em;font-weight:bold;margin:8px 0;">'. esc_attr( $customLabel) .'</p>';

    if($facebook == 1){
      $wfs_content .= '<a class="wfs-link-share wfs-share-facebook" href="'. esc_url( $facebookURL ) .'" target="_blank" '. wfs_rel_nofollow() .'onclick="'. wfs_share_gtag("facebook") .'"></a>';
    }
    if($twitter == 1){
      $wfs_content .= '<a class="wfs-link-share wfs-share-twitter" href="'. esc_url( $twitterURL ) .'" target="_blank" '. wfs_rel_nofollow() .' onclick="'. wfs_share_gtag("twitter") .'"></a>';
     }
    if($linkedin == 1){
      $wfs_content .= '<a class="wfs-link-share wfs-share-linkedin" href="'. esc_url( $linkedinURL ) .'" target="_blank" '. wfs_rel_nofollow() .' onclick="'. wfs_share_gtag("linkedin") .'"></a>';
    }
    if($buffer == 1){
      $wfs_content .= '<a class="wfs-link-share wfs-share-buffer" href="'. esc_url( $bufferURL ) .'" target="_blank" '. wfs_rel_nofollow() .' onclick="'. wfs_share_gtag("buffer") .'"></a>';
    }
    if($pinterest == 1){
      $wfs_content .= '<a class="wfs-link-share wfs-share-pinterest" href="'. esc_url( $pinterestURL ) .'" target="_blank" '. wfs_rel_nofollow() .' onclick="'. wfs_share_gtag("pinterest") .'"></a>';
    }
   /* if($email == 1){
      $wfs_content .= '<a class="wfs-link-share wfs-share-email" href="'. esc_url( $emailURL ) .' target="_blank" '. wfs_rel_nofollow() .' onclick="'. wfs_share_gtag("email") .'"></a>';
    }*/
    if($whatsapp == 1){
      $wfs_content .= '<a class="wfs-link-share wfs-share-whatsapp" href="'. esc_url( $whatsappURL ) .'" target="_blank" '. wfs_rel_nofollow() .' onclick="'. wfs_share_gtag("whatsapp") .'"></a>';
    }
   /* if($instagram == 1){
      $wfs_content .= '<a class="wfs-link-share wfs-share-instagram" href="'. esc_url( $instagramURL ) .'" target="_blank" '. wfs_rel_nofollow() .' onclick="'. wfs_share_gtag("instagram") .'"></a>';
    }*/
  $wfs_content .= '</div><!-- WPO friendly share - END-->';

    return $content .=$wfs_content;
};
add_shortcode('wfs_share', 'wfs_share_content');

function wfs_add_share_content(){

  if(get_option('wfs-options-after-post') == 0 && is_singular('post')){
    add_filter( 'the_content', 'wfs_share_content');
  }
}
add_action('template_redirect', 'wfs_add_share_content');




/*
* Evento follow Gtag
*/
function wfs_follow_gtag($red_social){
  if(get_option('wfs-options-ga-gtag') == 'ga'){
    $eventGtag = 'onclick="'."ga('send', 'event', 'social', 'follow', '$red_social ');".'"';
  }elseif(get_option('wfs-options-ga-gtag') == 'gtag'){
    $eventGtag = 'onclick="'."gtag('event', 'follow', { 'event_category': 'social', 'event_action': 'click', 'event_label': '$red_social'});".'"';
  }
  if( get_option( 'wfs-options-analytics' ) == 1 ){ 
    return $eventGtag;
  }else{
    return;
  }
}


function wfs_follow_content($content) {

    $customLabel = get_option('wfs-follow-custom-label');
    $twitterURL = get_option('wfs-follow-url-twitter');
    $facebookURL = get_option('wfs-follow-url-facebook');
    $linkedinURL = get_option('wfs-follow-url-linkedin');
    $pinterestURL = get_option('wfs-follow-url-pinterest');
    $instagramURL = get_option('wfs-follow-url-instagram');
    $youtubeURL = get_option('wfs-follow-url-youtube');
    $myBusinessURL = get_option('wfs-follow-url-myBusiness');

    $twitterchekcbox = get_option('wfs-follow-checkbox-twitter');
    $facebookchekcbox = get_option('wfs-follow-checkbox-facebook');
    $linkedinchekcbox = get_option('wfs-follow-checkbox-linkedin');
    $pinterestchekcbox = get_option('wfs-follow-checkbox-pinterest');
    $instagramchekcbox = get_option('wfs-follow-checkbox-instagram');
    $youtubechekcbox = get_option('wfs-follow-checkbox-youtube');
    $miBusinesschekcbox = get_option('wfs-follow-checkbox-myBusiness'); 

    $wfs_content = '<div class="wfs-follow" itemscope itemtype="http://schema.org/Organization"><!-- WPO friendly share - START-->';
    $wfs_content .= '<p>'.$customLabel.'</p>';
    $wfs_content .= '<link itemprop="url" href="'.get_home_url().'">';
    $wfs_content .= '<meta itemprop="name" href="'.get_bloginfo().'">';

        if($facebookchekcbox == 1){
      $wfs_content .= '<a itemprop="sameAs" class="wfs-link-follow wfs-follow-facebook" href="'.$facebookURL.'" target="_blank" '. wfs_rel_nofollow() .' '. wfs_follow_gtag("facebook") .'></a>';
        }
        if($twitterchekcbox == 1){
      $wfs_content .= '<a itemprop="sameAs" class="wfs-link-follow wfs-follow-twitter" href="'. $twitterURL .'" target="_blank" '. wfs_rel_nofollow() .' '. wfs_follow_gtag("twitter") .'></a>';
        }
        if($linkedinchekcbox == 1){
      $wfs_content .= '<a itemprop="sameAs" class="wfs-link-follow wfs-follow-linkedin" href="'.$linkedinURL.'" target="_blank" '. wfs_rel_nofollow() .' '. wfs_follow_gtag("linkedin") .'></a>';
        }
        if($pinterestchekcbox == 1){
      $wfs_content .= '<a itemprop="sameAs" class="wfs-link-follow wfs-follow-pinterest" href="'.$pinterestURL.'" target="_blank" '. wfs_rel_nofollow() .' '. wfs_follow_gtag("pinterest") .'></a>';
        }
        if($instagramchekcbox == 1){
      $wfs_content .= '<a itemprop="sameAs" class="wfs-link-follow wfs-follow-instagram" href="'.$instagramURL.'" target="_blank" '. wfs_rel_nofollow() .''. wfs_follow_gtag("instagram") .'></a>';
        }
        if($youtubechekcbox == 1){
      $wfs_content .= '<a itemprop="sameAs" class="wfs-link-follow wfs-follow-youtube" href="'.$youtubeURL.'" target="_blank" '. wfs_rel_nofollow() .' '. wfs_follow_gtag("youtube") .'></a>';
        }
        if($miBusinesschekcbox == 1){
      $wfs_content .= '<a itemprop="sameAs" class="wfs-link-follow wfs-follow-mybusiness" href="'.$myBusinessURL.'" target="_blank" '. wfs_rel_nofollow() .' '. wfs_follow_gtag("MyBusiness") .'></a>';
        }

    $wfs_content .= '</div><!-- WPO friendly share - END-->';
    return $wfs_content;
};
add_shortcode('wfs_follow', 'wfs_follow_content');