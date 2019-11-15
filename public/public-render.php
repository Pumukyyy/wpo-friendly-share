<?php 
// Si se llama directamente a este archivo, aborta.
defined( 'ABSPATH' ) or die( '¡Sin trampas!' );

/*
* Registro la hoja de estilos css publica
*/
if( 0 == get_option( 'wfs-options-css' ) ) { 

  add_action( 'wp_print_styles', 'wfs_public_style' );
  
  function wfs_public_style() {

    wp_register_style( 'wfs-public-style', WFS_URI . 'css/wfs-public-style.css' );
    wp_enqueue_style( 'wfs-public-style' );

  }

}

function &wfs_rel_nofollow() {

    if( 1 == get_option( 'wfs-options-rel-nofollow') ) {

       $rel_nofollow = 'rel="me nofollow noopener noreferrer"';

    } else{

        $rel_nofollow = 'rel="me noopener noreferrer"';

      }

    return $rel_nofollow;
}

/*
* Evento Gtag y Ga
*/
function wfs_gtag( $red_social, $event, $titulo = false ) {
  // $shareTitle = str_replace( ' ', '%20', get_the_title() );
  if( get_option( 'wfs-options-ga-gtag') == 'ga'){

    $event_gtag = 'onclick="'."ga('send', 'event', 'social', '$event', '$red_social $titulo');".'"';

  } elseif( get_option( 'wfs-options-ga-gtag') == 'gtag' ){

    $event_gtag = 'onclick="'."gtag('event', '$event', { 'event_category': 'social', 'method': '$red_social', 'event_label': '$titulo'});".'"';
                                 
  }

  if( 1 == get_option( 'wfs-options-analytics' ) ) { 

    return $event_gtag;

  } else{

      return;

    }
}

/*
* creo el contenido con los botones share
*/
function wfs_share() {

  global $post;

  $current_url = get_permalink();
  $current_url            = urlencode( $current_url );
  $current_title          = urlencode( get_the_title() );
  $current_thumbnail      = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'thumbnail' );
  $current_thumbnail_code = urlencode($current_thumbnail[0]);
  $default_txt            = rawurlencode( strip_tags( __( 'Look at this, I think it will interest you', 'wpo-friendly-share' ) ) );

  //Compruebo si hay texto y si no muestro texto por defecto
  $whatsapp_txt = urlencode( strip_tags( get_option( 'wfs-share-whatsapp-txt' ) ) );
  if ( empty( $whatsapp_txt ) ) {
    $whatsapp_txt = $default_txt;
  }
  $whatsapp_txt = '*' . $whatsapp_txt . '*';

  // Compruebo si es movil o web para mostrar un enlace diferebte para whatsapp
  $whatsapp_from = 'api.whatsapp.com';
  if ( !wp_is_mobile() ) {
      $whatsapp_from = 'web.whatsapp.com';    
  }

  $telegram_txt   = rawurlencode( strip_tags( get_option( 'wfs-share-telegram-txt' ) ) );
  if ( empty( $telegram_txt ) ) {
    $telegram_txt = $default_txt;
  }
  $telegram_txt = '**' . $telegram_txt . '**';

  // Compruebo si es movil o web para mostrar un enlace diferebte para telegram
  $telegram_from = 't.me/share/url';
  if ( !wp_is_mobile() ) {
      $telegram_from = 'web.telegram.org/#/im?tgaddr=tg://msg_url';    
  }


  //Compruebo si hay texto en el titulo y si no agrego uno por defecto
  $custom_label = get_option( 'wfs-share-custom-label' );
  if ( empty( $custom_label ) ) {

    $custom_label = esc_attr( __( 'Share it with a friend', 'wpo-friendly-share' ) );
   
  }

  // Creo un array con las url de las diferentes redes sociales
  $redes_share = array(
    'facebook'    => array(
      'url'           => 'https://www.facebook.com/sharer/sharer.php?',
      'parametros'    => 'u=' . $current_url,
      'seleccionado'  => get_option( 'wfs-share-facebook' ),
    ),
    'twitter'     => array(
      'url'           => 'https://twitter.com/intent/tweet?',
      'parametros'    => 'text=' . $current_title . '&url=' . $current_url . '&via=' . get_option( 'wfs-share-twitter-name' ),
      'seleccionado'  => get_option( 'wfs-share-twitter' ),
    ),
    'linkedin'    => array(
      'url'           => 'https://www.linkedin.com/shareArticle?',
      'parametros'    => 'mini=true&url=' . $current_url . '&title='.$current_title,
      'seleccionado'  => get_option( 'wfs-share-linkedin' ),
    ),
    'buffer'      => array(
      'url'           => 'https://bufferapp.com/add?',
      'parametros'    => 'url=' . $current_url . '&amp;text=' . $current_title,
      'seleccionado'  => get_option( 'wfs-share-buffer' ),
    ),
    'pinterest'   => array(
      'url'           => 'https://pinterest.com/pin/create/button/?',
      'parametros'    => 'url=' . $current_url . '&media=' . $current_thumbnail_code . '&description='.$current_title,
      'seleccionado'  => get_option( 'wfs-share-pinterest' ),
    ),
    'whatsapp'    => array(
      'url'           => 'https://' . $whatsapp_from . '/send?',
      'parametros'    => 'l=es&text=' . $whatsapp_txt . '%0A_' . $current_title . '_%0A' . $current_url,
      'seleccionado'  => get_option( 'wfs-share-whatsapp' ),
    ),
    'telegram'    => array(
      'url'           => 'https://' . $telegram_from . '?',
      'parametros'    => urlencode('url=' . $current_url . '&text=' . $telegram_txt),
      'seleccionado'  => get_option( 'wfs-share-telegram' ),
    ),
  );
 
  // Creo un filtro para el array de las redes sociales follow con las url y los select
  if (has_filter('wsf_array_share_filter')) {
      $redes_share = apply_filters( 'wsf_array_share_filter', $redes_share );
  }   
  //comienzo el contenido 
  $wfs_content  = '<div class="wfs-share"><!-- WPO friendly share - START-->';
  $wfs_content .= '<p class="titulo">';
  $wfs_content .= esc_attr( $custom_label);       
  $wfs_content .= '</p>';
  $wfs_content .= '<div class="content-button">';

  foreach( $redes_share as $red => $detalles ) {
    foreach($detalles as $clave => $valor){
    }
      $parametro = $redes_share[$red]['parametros'];
      $url = $redes_share[$red]['url'];
      $seleccionado = $redes_share[$red]['seleccionado'];
      $seleccionados[] = $seleccionado;

    if( 1 == $seleccionado ) {

      $wfs_content .= '<a class="wfs-link-share wfs-share-' . $red . '" href="' . esc_url( $url . $parametro) . '" target="_blank" '. wfs_rel_nofollow() .' '. wfs_gtag( $red, 'share', esc_attr( get_the_title() ) ) .'"></a>';

    }
  }

  $wfs_content .= '</div></div><!-- WPO friendly share - END-->';
  //fin del contenido 

  // Creo un filtro con el contenedor y contenido de las redes sociales share
  if ( has_filter( 'wfs_content_share_filter' ) ) {

      $wfs_content = apply_filters( 'wfs_content_share_filter', $wfs_content );

  }
  //compruebo si hay alguna red seleccionada y si no hay no muestro nada  
  if ( 0 < array_sum( $seleccionados ) ) {

  return $wfs_content;

 }

}

function wfs_add_share_before_content( $content ) {

  $share = wfs_share();

  return $content = $share .= $content;

}

function wfs_add_share_before_after_content( $content ) {

  $share = wfs_share();

  return $content = $share .= $content .= $share;

}

function wfs_add_share_after_content( $content ) {

  $share = wfs_share();

  return $content .= $share;

}

/*
* Agrego la funcion antes, despues o ambos segun este marcado 
* compuruebo que almenos uno este seleccionado y lo muestro 
* añado un sort code
*/
add_action( 'template_redirect', 'wfs_add_share_content' );
function wfs_add_share_content() {

  $before = get_option( 'wfs-options-before-post' );
  $after  = get_option( 'wfs-options-after-post' );



    if( 1 == $before && 0 == $after && is_singular( 'post' ) ){

      add_filter( 'the_content', 'wfs_add_share_before_content' );

    }

    if( 1 == $after && 0 == $before && is_singular( 'post' ) ){

      add_filter( 'the_content', 'wfs_add_share_after_content' );

    }

    if( 1 == $after && 1 == $before && is_singular( 'post' ) ){

      add_filter( 'the_content', 'wfs_add_share_before_after_content' );

    }

    add_shortcode( 'wfs_share', 'wfs_share' );

  }

/*
* creo el contenido con los botones follow compruebo si hay algo seleccionado y creo un sortcode
*/
add_shortcode( 'wfs_follow', 'wfs_follow' );
  
function wfs_follow() {

  $redes_follow = array(
    'facebook'    => array(
      'url'           => get_option( 'wfs-follow-url-facebook' ),
      'seleccionado'  => get_option( 'wfs-follow-checkbox-facebook' ),
    ),
    'twitter'     => array(
      'url'           => get_option( 'wfs-follow-url-twitter' ),
      'seleccionado'  => get_option( 'wfs-follow-checkbox-twitter' ),
    ),
    'linkedin'    => array(
      'url'           => get_option( 'wfs-follow-url-linkedin' ),
      'seleccionado'  => get_option( 'wfs-follow-checkbox-linkedin' ),
    ),
    'pinterest'   => array(
      'url'           => get_option( 'wfs-follow-url-pinterest' ),
      'seleccionado'  => get_option( 'wfs-follow-checkbox-pinterest' ),
    ),
    'instagram'   => array(
      'url'           => get_option( 'wfs-follow-url-instagram' ),
      'seleccionado'  => get_option( 'wfs-follow-checkbox-instagram' ),
    ),
    'youtube'     => array(
      'url'           => get_option( 'wfs-follow-url-youtube' ),
      'seleccionado'  => get_option( 'wfs-follow-checkbox-youtube' ),
    ),
    'myBusiness'  => array(
      'url'           => get_option( 'wfs-follow-url-myBusiness' ),
      'seleccionado'  => get_option( 'wfs-follow-checkbox-myBusiness' ),
    ),
    'telegram'    => array(
      'url'           => get_option( 'wfs-follow-url-telegram' ),
      'seleccionado'  => get_option( 'wfs-follow-checkbox-telegram' ),
    ),
  );

  // Creo un filtro para el array de las redes sociales follow con las url y los select
  if (has_filter('wsf_array_follow_filter')) {
      $redes_follow = apply_filters( 'wsf_array_follow_filter', $redes_follow );
  }  

  $wfs_content  = '<div class="wfs-follow" itemscope itemtype="http://schema.org/Organization"><!-- WPO friendly share - START-->';
  $wfs_content .= '<link itemprop="url" href="'. esc_url( get_home_url() ) .'">';
  $wfs_content .= '<meta itemprop="name" href="'. esc_attr( get_bloginfo() ) .'">';

  /*
  * Custom label
  */
  $wfs_content .= '<p class="titulo">';

  $custom_label = get_option( 'wfs-follow-custom-label' );

  if ( empty( $custom_label ) ) {

    $custom_label = esc_attr( __( 'Follow us on the social networks', 'wpo-friendly-share' ) );

  }

  $wfs_content .= esc_attr( $custom_label);  
  $wfs_content .= '</p>';

  $wfs_content .= '<div class="content-button">';

  foreach( $redes_follow as $red => $detalles ) {
    foreach($detalles as $clave => $valor){
    }
      $url = $redes_follow[$red]['url'];
      $seleccionado = $redes_follow[$red]['seleccionado'];
      $seleccionados[] = $seleccionado;

    if( 1 == $seleccionado ) {

      $wfs_content .= '<a itemprop="sameAs" class="wfs-link-follow wfs-follow-' . $red . '" href="'. esc_url( $url ) .'" target="_blank" '. wfs_rel_nofollow() .' '. wfs_gtag( $red, 'follow', '+1 Follow' ) .'></a>';

    }
  }

  $wfs_content .= '</div></div><!-- WPO friendly share - END-->';

  // Creo un filtro con el contenedor y contenido de las redes sociales follow
  if ( has_filter( 'wfs_content_follow_filter' ) ) {

      $wfs_content = apply_filters( 'wfs_content_follow_filter', $wfs_content );

  }
  //compruebo si hay alguna red seleccionada y si no hay no muestro nada  
  if ( 0 < array_sum( $seleccionados ) ) {

    return $wfs_content;

  }

}