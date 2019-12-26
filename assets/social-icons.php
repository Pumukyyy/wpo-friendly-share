<?php 
// Si se llama directamente a este archivo, aborta.
defined( 'ABSPATH' ) or die( '¡Sin trampas!' );

function wfs_social_networks(){

  $current_url = get_permalink();

  $current_url            = urlencode( $current_url );
  $current_title          = urlencode( get_the_title() );
  $current_thumbnail      = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'large' );
  $current_thumbnail_code = urlencode($current_thumbnail[0]);

  $wfs_s_txt     = get_option( 'wfs_s_txt');
  $wfs_s_check   = get_option( 'wfs_s_check');  
  $wfs_f_url     = get_option( 'wfs_f_url'); 
  $wfs_f_check   = get_option( 'wfs_f_check'); 

  
  $whatsapp_txt = urlencode( strip_tags( $wfs_s_txt['s-whatsapp-txt'] ) );
  if ( empty( $whatsapp_txt ) ) {
    $whatsapp_txt = '';
  }else{
    $whatsapp_txt = '*' . $whatsapp_txt . '* %0A_';
  }


  $telegram_txt   = rawurlencode( strip_tags( $wfs_s_txt['s-telegram-txt'] ) );
  if ( empty( $telegram_txt ) ) {
    $telegram_txt = '';
  }else{
    $telegram_txt = '&text=**' . $telegram_txt . '**';
  }

  // Compruebo si es movil o web para mostrar un enlace diferebte para whatsapp
  $whatsapp_from = 'api.whatsapp.com';
  if ( !wp_is_mobile() ) {
      $whatsapp_from = 'web.whatsapp.com';    
  }
  // Compruebo si es movil o web para mostrar un enlace diferebte para telegram
  $telegram_from = 't.me/share/url';
  if ( !wp_is_mobile() ) {
      $telegram_from = 'web.telegram.org/#/im?tgaddr=tg://msg_url';    
  }

  $wfs_twittwer_mention = '&via=' . $wfs_s_txt['s-twitter-name'];
  if ( empty( $wfs_s_txt['s-twitter-name'] )) {
    $wfs_twittwer_mention = '';
  }


  $social_networks = array(
    'twitter'     => array(
      'url_share'     => 'https://twitter.com/intent/tweet?',
      'parametros'    => 'text=' . $current_title . '&url=' . $current_url . $wfs_twittwer_mention,
      'selec_share'   => $wfs_s_check['s-check-twitter'],
      'url_follow'    => $wfs_f_url['f-url-twitter'],
      'selec_follow'  => $wfs_f_check['f-check-twitter'],
     ),
    'facebook'    => array(
      'url_share'     => 'https://www.facebook.com/sharer/sharer.php?',
      'parametros'    => 'u=' . $current_url,
      'selec_share'   => $wfs_s_check['s-check-facebook'],
      'url_follow'    => $wfs_f_url['f-url-facebook'],
      'selec_follow'  => $wfs_f_check['f-check-facebook'],
    ),
    'linkedin'    => array(
      'url_share'     => 'https://www.linkedin.com/shareArticle?',
      'parametros'    => 'mini=true&url=' . $current_url . '&title='.$current_title,
      'selec_share'   => $wfs_s_check['s-check-linkedin'],
      'url_follow'    => $wfs_f_url['f-url-linkedin'],
      'selec_follow'  => $wfs_f_check['f-check-linkedin'],
    ),
    'buffer'      => array(
      'url_share'     => 'https://bufferapp.com/add?',
      'parametros'    => 'url=' . $current_url . '&amp;text=' . $current_title,
      'selec_share'   => $wfs_s_check['s-check-buffer'],
      'url_follow'    => null,
      'selec_follow'  => null,
    ),
    'pinterest'   => array(
      'url_share'     => 'https://pinterest.com/pin/create/button/?',
      'parametros'    => 'url=' . $current_url . '&media=' . $current_thumbnail_code . '&description='.$current_title,
      'selec_share'   => $wfs_s_check['s-check-pinterest'],
      'url_follow'    => $wfs_f_url['f-url-pinterest'],
      'selec_follow'  => $wfs_f_check['f-check-pinterest'],
    ),
    'whatsapp'    => array(
      'url_share'     => 'https://' . $whatsapp_from . '/send?',
      'parametros'    => 'l=es&text=' . $whatsapp_txt . '_' . $current_title . '_%0A' . $current_url,
      'selec_share'   => $wfs_s_check['s-check-whatsapp'],
      'url_follow'    => null,
      'selec_follow'  => null,
    ),
    'telegram'    => array(
      'url_share'     => 'https://' . $telegram_from . '?',
      'parametros'    => urlencode('url=' . $current_url . $telegram_txt),
      'selec_share'   => $wfs_s_check['s-check-telegram'],
      'url_follow'    => $wfs_f_url['f-url-telegram'],
      'selec_follow'  => $wfs_f_check['f-check-telegram'],
    ),
    'instagram'   => array(
      'url_share'     => null,
      'parametros'    => null,
      'selec_share'   => null,
      'url_follow'    => $wfs_f_url['f-url-instagram'],
      'selec_follow'  => $wfs_f_check['f-check-instagram'],
    ),
    'youtube'     => array(
      'url_share'     => null,
      'parametros'    => null,
      'selec_share'   => null,
      'url_follow'    => $wfs_f_url['f-url-youtube'],
      'selec_follow'  => $wfs_f_check['f-check-youtube'],
    ),
    'myBusiness'  => array(
      'url_share'     => null,
      'parametros'    => null,
      'selec_share'   => null,
      'url_follow'    => $wfs_f_url['f-url-myBusiness'],
      'selec_follow'  => $wfs_f_check['f-check-myBusiness'],
    ),
    'correo'      => array(
      'url_share'     => null,
      'parametros'    => null,
      'selec_share'   => null,
      'url_follow'    => null,
      'selec_follow'  => null,
    ),
    'pmkWebDev'   => array(
      'url_share'     => null,
      'parametros'    => null,
      'selec_share'   => null,
      'url_follow'    => null,
      'selec_follow'  => null,
    ),
  );

  if (has_filter('wsf_array_social_network_filter')) {
      $social_networks = apply_filters( 'wsf_array_social_network_filter', $social_networks );
  }
  return $social_networks;
}

function wfs_social_networks_share() {  
  $social_networks_share = array( 
    'twitter',
    'facebook',
    'linkedin',
    'buffer',
    'pinterest',
    'whatsapp',
    'telegram',
    '',
    '',
    '',
    '',
    '',
  );

  if (has_filter('wsf_array_social_network_share_filter')) {
      $social_networks_share = apply_filters( 'wsf_array_social_network_share_filter', $social_networks_share );
  }

  return $social_networks_share;
} 

function wfs_social_networks_follow() {  
  $social_networks_follow = array( 
    'twitter',
    'facebook',
    'linkedin',
    '',
    'pinterest',
    '',
    'telegram',
    'instagram',
    'youtube',
    'myBusiness',
    '',
    '',
  );

  if (has_filter('wsf_array_social_network_follow_filter')) {
      $social_networks_follow = apply_filters( 'wsf_array_social_network_follow_filter', $social_networks_follow );
  }

  return $social_networks_follow;
}

