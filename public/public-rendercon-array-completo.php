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
function wfs_social_network(){
  $current_url            = get_permalink();
  $current_url            = urlencode( $current_url );
  $current_title          = urlencode( get_the_title() );
  $current_thumbnail      = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'large' );
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


  // Creo un array con las url de las diferentes redes sociales
  $social_network = array(
    'facebook'    => array(
      'url_follow'          => null,
      'url_share'           => 'https://www.facebook.com/sharer/sharer.php?',
      'parametros_share'    => 'u=' . $current_url,
      'seleccionado_follow' => null,
      'seleccionado_share'  => get_option( 'wfs-share-facebook' ),
      'icono'         => '<svg class="svg-social-icon" aria-hidden="true" role="img" focusable="false" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><path class="social-icon" d="M27.21,20.18h5.9V28h-5.9V42H19.13V28h-4V20.27h4V14.09a7.92,7.92,0,0,1,8-7.85h5.95v7.82H28a.71.71,0,0,0-.8.62v5.5Z"/></svg>',
    ),
    'twitter'     => array(
      'url_follow'          => null,
      'url_share'           => 'https://twitter.com/intent/tweet?',
      'parametros_share'    => 'text=' . $current_title . '&url=' . $current_url . '&via=' . get_option( 'wfs-share-twitter-name' ),
      'seleccionado_follow' => null,
      'seleccionado_share'  => get_option( 'wfs-share-twitter' ),
      'icono'     => '<svg class="svg-social-icon" aria-hidden="true" role="img" focusable="false" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><path class="social-icon" d="M40.18,15.65v1.19c0,11.2-8.52,24.08-23.94,24.05A23.12,23.12,0,0,1,3.55,37H5.62a17.63,17.63,0,0,0,10.32-3.55A8.35,8.35,0,0,1,8.13,27.3c.65,0,.88.34,1.53.34a3.7,3.7,0,0,0,2.07-.34,8.4,8.4,0,0,1-6.62-8.46A13.52,13.52,0,0,0,9,20a9.07,9.07,0,0,1-3.56-6.95,7.23,7.23,0,0,1,1.2-4.28,23.82,23.82,0,0,0,17.11,8.82c0-.65-.34-1.19-.34-1.84a8.28,8.28,0,0,1,8.09-8.46h.4A7.55,7.55,0,0,1,38,10.12a23.45,23.45,0,0,0,5.44-2,8.91,8.91,0,0,1-3.6,4.78,25.47,25.47,0,0,0,4.79-1.21,33.28,33.28,0,0,1-4.49,4ZM12,18.23c1.93,1.91,3.4,3.07,5.41,5.06l-5.64.36c2.49,1.05,4.39,1.68,6.94,2.79l-4.23,3.22c2.09.46,5.49.78,6.88.95l1.87.26-1.3,1.36a39.92,39.92,0,0,1-4.8,4.52A17.88,17.88,0,0,0,30,30.2C33.27,26.46,36.09,21,35.53,16c-.28-2.52-.24-4.42-3.45-4.31h-.22a.34.34,0,0,0-.2,0c-2.38.06-3.72,2-3.72,4.42a29.35,29.35,0,0,1,.33,5.13v1l-1-.06A44.58,44.58,0,0,1,12,18.23Z"/></svg>',
    ),
    'linkedin'    => array(
      'url_follow'          => null,
      'url_share'           => 'https://www.linkedin.com/shareArticle?',
      'parametros_share'    => 'mini=true&url=' . $current_url . '&title='.$current_title,
      'seleccionado_follow' => null,
      'seleccionado_share'  => get_option( 'wfs-share-linkedin' ),
      'icono'               => '<svg class="svg-social-icon" aria-hidden="true" role="img" focusable="false" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><path class="social-icon" d="M14.62,40.89V18.12H7V40.89ZM10.77,15h0c2.5,0,4.29-1.59,4.29-3.85S13.27,7.3,10.77,7.3c-2.7,0-4.26,1.58-4.26,3.82S8.07,15,10.77,15ZM41.68,40.89h0V27.81c0-7-3.61-10.14-8.58-10.14a7.51,7.51,0,0,0-6.76,3.62V18.12H18.67c.24,2.26,0,22.77,0,22.77h7.67V28.28a4.83,4.83,0,0,1,.21-1.82,4.21,4.21,0,0,1,3.85-2.91c2.7,0,3.82,2.23,3.82,5.17V40.89Z"/></svg>',

    ),
    'buffer'      => array(
      'url_follow'          => null,
      'url_share'           => 'https://bufferapp.com/add?',
      'parametros_share'    => 'url=' . $current_url . '&amp;text=' . $current_title,
      'seleccionado_follow' => null,
      'seleccionado_share'  => get_option( 'wfs-share-buffer' ),
      'icono'               => '<svg class="svg-social-icon" aria-hidden="true" role="img" focusable="false" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><path class="social-icon" d="M8,15.6l15.25,6.64a1.63,1.63,0,0,0,1.75,0L40.27,15.6a.89.89,0,0,0,.56-1.19.91.91,0,0,0-.56-.56L25,7.53a1.72,1.72,0,0,0-1.75,0L8,13.79C6.9,14.1,6.9,15,8,15.58Zm32.23,7.49h0c.82.62.82,1.44,0,1.76L25,31.48a1.82,1.82,0,0,1-1.78,0L8,24.85c-1.17-.63-1.17-1.45,0-1.76l3.4-1.45L23.26,26.8a1.78,1.78,0,0,0,1.76,0l12.13-5.16,3.06,1.45Zm0,9.18h0l-3.21-1.44L24.93,36a1.78,1.78,0,0,1-1.76,0L11.35,30.83,8,32.27c-1.16.29-1.16,1.45,0,1.76l15.22,6.63a1.78,1.78,0,0,0,1.76,0L40.18,34c1.22-.28,1.22-1.11.09-1.73Z"/></svg>',
    ),
    'pinterest'   => array(
      'url_follow'          => null,
      'url_share'           => 'https://pinterest.com/pin/create/button/?',
      'parametros_share'    => 'url=' . $current_url . '&media=' . $current_thumbnail_code . '&description='.$current_title,
      'seleccionado_follow' => null,
      'seleccionado_share'  => get_option( 'wfs-share-pinterest' ),
      'icono'               => '<svg class="svg-social-icon" aria-hidden="true" role="img" focusable="false" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><path class="social-icon" d="M18,24.09a8.16,8.16,0,0,1-.63-3.26c0-2.66,1.59-5.78,4.88-5.78A3.44,3.44,0,0,1,26,18.74a11.94,11.94,0,0,1-.68,3.43c-.4,1.24-.85,2.46-1.16,3.74a2.39,2.39,0,0,0,1.9,2.89,2.35,2.35,0,0,0,.79.06h.06a4.55,4.55,0,0,0,1.22-.17,6.23,6.23,0,0,0,3.48-3.35A14.13,14.13,0,0,0,33,19c0-4.5-3.45-6.91-8.19-6.91h0c-5.21-.17-9.61,3.57-9.78,8.36a3.39,3.39,0,0,0,0,.45v.06a4.37,4.37,0,0,0,1.21,3.29,1.3,1.3,0,0,1,.46,1.73,4.75,4.75,0,0,1-.57,1.78,1.7,1.7,0,0,1-2.1.82v0c-3.74-1.22-5.13-4.62-5.13-8a12.39,12.39,0,0,1,4-8.87A17.39,17.39,0,0,1,25,7.31c6.12,0,11.82,3.06,13.75,8.62a11.32,11.32,0,0,1,.56,3.49c0,4.82-1.78,10.06-6.43,12.7a11.94,11.94,0,0,1-6.07,1.56,8.2,8.2,0,0,1-4.93-1.59c-.14.45-.25.91-.37,1.39a18.68,18.68,0,0,1-.88,2.75,35.64,35.64,0,0,1-2.09,4.31.81.81,0,0,1-1,.31l-2.29-1a.65.65,0,0,1-.43-.6,16.07,16.07,0,0,1,.49-4.79.07.07,0,0,1,0-.06c.2-.62.37-1.3.54-1.95.29-1.05.57-2.1.82-3.18.43-1.73.88-3.46,1.31-5.19Z"/></svg>',
    ),
    'whatsapp'    => array(
      'url_follow'          => null,
      'url_share'           => 'https://' . $whatsapp_from . '/send?',
      'parametros_share'    => 'l=es&text=' . $whatsapp_txt . '%0A_' . $current_title . '_%0A' . $current_url,
      'seleccionado_follow' => null,
      'seleccionado_share'  => get_option( 'wfs-share-whatsapp' ),
      'icono'               => '<svg class="svg-social-icon" aria-hidden="true" role="img" focusable="false" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><path class="social-icon" d="M17.21,37.84,7.29,40.9l3.06-9.46a16.86,16.86,0,0,1-2.07-8A16.34,16.34,0,0,1,41,23.5,16.32,16.32,0,0,1,17.21,37.84ZM26.65,26.7c.56-.68,1.53-2.32,2.6-1.64a23.93,23.93,0,0,0,3.21,1.59l.08,0,.06.06c.71.54.2,1.7-.06,2.35-1.05,3.06-5.36,1.68-7.48.8-3.32-1.59-7.4-6.13-7.68-9.9v-.05A4.4,4.4,0,0,1,19,16.61h0c.94-.68,2.13-1.36,2.81.11.4,1,.88,2,1.33,3s-.51,1.64-1,2.32l0,0,0,0a.18.18,0,0,0-.05.23h0l0,0a6,6,0,0,0,1.7,2.44l0,0c.37.37,2.33,1.87,2.9,1.84ZM24,35.15h.59a11.94,11.94,0,0,0,12-11.85,11.89,11.89,0,0,0-23.78,0,11.9,11.9,0,0,0,2.33,6.92l.31.42L14.26,34l3.48-1.08.37.26a11.62,11.62,0,0,0,5.9,2Z"/></svg>',
    ),
    'telegram'    => array(
      'url_follow'          => null,
      'url_share'           => 'https://' . $telegram_from . '?',
      'parametros_share'    => urlencode('url=' . $current_url . '&text=' . $telegram_txt),
      'seleccionado_follow' => null,
      'seleccionado_share'  => get_option( 'wfs-share-telegram' ),
      'icono'               => '<svg class="svg-social-icon" aria-hidden="true" role="img" focusable="false" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><path class="social-icon" d="M42.51,9.06l-6,30.44a2.3,2.3,0,0,1-3.26,1.11C28.59,37.06,24,33.58,19.4,30c-.28-.2-.22-.88.12-1.19C22.38,26.29,34.88,15,35.45,14.47s.45-.74.45-.74c0-.76-1.16,0-1.16,0C27.91,18,21.16,22.35,14.36,26.66a2.32,2.32,0,0,1-1.42.2l-8-2.72s-1.39-.48-1.47-1.51S4.92,21,4.92,21L39.84,7.33S42.51,7,42.51,9.06Z"/></svg>',
    ),
    'instagram'   => array(
    'url_follow'            => get_option( 'wfs-follow-url-instagram' ),
    'url_share'             => null,
    'seleccionado_follow'   => get_option( 'wfs-follow-checkbox-instagram' ),
    'seleccionado_share'    => null,
    'icono'                 => '<svg class="svg-social-icon" aria-hidden="true" role="img" focusable="false" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><path class="social-icon" d="M17.38,7.31H30.84A10,10,0,0,1,40.9,17.15V31.07a10,10,0,0,1-10.06,9.86H17.38A10,10,0,0,1,7.31,31.07V17.15A10,10,0,0,1,17.38,7.31Zm14.14,7.37a2,2,0,1,1-2.07,2,2.07,2.07,0,0,1,2.07-2Zm-7.31,1.76h0a7.4,7.4,0,1,0,7.45,7.4,7.51,7.51,0,0,0-7.45-7.4Zm0,3.49A4.14,4.14,0,1,1,20,24.07a4.25,4.25,0,0,1,4.17-4.14Zm-6.27-8.14h0a5.9,5.9,0,0,0-5.84,5.67v13a5.91,5.91,0,0,0,5.84,5.7H30.3a5.87,5.87,0,0,0,5.81-5.7V17.72a5.86,5.86,0,0,0-5.81-5.67Z"/></svg>',
    ),
    'youtube'     => array(
      'url_follow'          => get_option( 'wfs-follow-url-youtube' ),
      'url_share'           => null,
      'seleccionado_follow' => get_option( 'wfs-follow-checkbox-youtube' ),
      'seleccionado_share'  => null,
      'icono'               => '<svg class="svg-social-icon" aria-hidden="true" role="img" focusable="false" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><path class="social-icon" d="M32,23.61l-.08-.05h0c-4.45-2.58-8.73-4.94-13.1-7.43V31l.12-.08V31c4.59-2.69,9.41-5.19,13.09-7.4ZM20.41,40.93c-8.25-.17-11.06-.31-12.78-.71a5.46,5.46,0,0,1-2.92-1.7,7.41,7.41,0,0,1-1.39-3,20.45,20.45,0,0,1-.6-4.37A119,119,0,0,1,2.72,17c.28-2.61.4-5.73,2.16-7.52A5.47,5.47,0,0,1,7.77,7.91c1.67-.37,8.9-.65,16.35-.65s14.69.28,16.39.65a5.44,5.44,0,0,1,3.34,2.21c1.62,2.81,1.65,6.29,1.82,9,0,1.31,0,8.68,0,10-.26,4.31-.46,5.84-1.05,7.43a5.48,5.48,0,0,1-1.16,2.1,5.79,5.79,0,0,1-3,1.73,190.31,190.31,0,0,1-20,.59ZM7.46,17.66a110.72,110.72,0,0,0,0,13,18.07,18.07,0,0,0,.4,3.2,3.91,3.91,0,0,0,.34.94,1.51,1.51,0,0,0,.62.31,21,21,0,0,0,3.24.34c2.8.14,5.66.2,8.47.26a184.08,184.08,0,0,0,18.94-.57,1.55,1.55,0,0,0,.54-.31v0a1.82,1.82,0,0,0,.17-.43,22.8,22.8,0,0,0,.7-5.72c.09-1.48.06-3.09.06-4.54s0-3.09-.06-4.56c-.08-1.84-.11-4.56-1-6.27a1.32,1.32,0,0,0-.6-.28,36.73,36.73,0,0,0-5.27-.37q-5-.17-9.95-.17t-10,.17A36.73,36.73,0,0,0,8.9,13a1.31,1.31,0,0,0-.71.4c-.42.45-.65,3.43-.73,4.25Z"/></svg>',
    ),
    'myBusiness'  => array(
      'url_follow'          => get_option( 'wfs-follow-url-myBusiness' ),
      'url_share'           => null,
      'seleccionado_follow' => get_option( 'wfs-follow-checkbox-myBusiness' ),
      'seleccionado_share'  => null,
      'icono'               => '<svg class="svg-social-icon" aria-hidden="true" role="img" focusable="false" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><path class="social-icon" d="M33.82,19.76,32.29,7.31h6a2.82,2.82,0,0,1,2.55,2.07l2.69,10.38a4.84,4.84,0,0,1-2.69,4.33V38a3,3,0,0,1-3,3H10.37a3,3,0,0,1-3-3V24.12h0a4.82,4.82,0,0,1-2.72-4.36h0L7.46,9.38A2.76,2.76,0,0,1,10,7.31H16L14.43,19.76,16,7.34H32.29ZM35,30.36,35,30.08H30.13V32h2.95a2.4,2.4,0,0,1-.51,1.08,3,3,0,0,1-2.07.82,3.18,3.18,0,0,1-2.18-.9,3,3,0,0,1,4.17-4.26l.25.23,1.36-1.39-.25-.22a5.11,5.11,0,0,0-3.35-1.39A4.9,4.9,0,0,0,27,27.38a4.74,4.74,0,0,0-1.47,3.46A4.54,4.54,0,0,0,27,34.24a5.14,5.14,0,0,0,3.6,1.48,4.65,4.65,0,0,0,3.29-1.31,4.58,4.58,0,0,0,1.24-3A7.42,7.42,0,0,0,35,30.36Zm4.48-10.43-2.1-9.5-.88.09L38,19.62l0,.17c.12,1,.54,1.75.94,1.7s.56-.71.54-1.56Zm-27.7-9.41-.88-.09L8.73,20c0,.8.2,1.42.54,1.48s.82-.71.93-1.7l0-.2Zm8.68-.09-1.25-.06-1,9.5c0,.91.37,1.64.88,1.67s1-.76,1.05-1.75Zm9.58,9.44-.94-9.5-1.3.06.31,9.36c.06,1,.51,1.78,1,1.75s.91-.73.91-1.67ZM11.54,24.24V36.79H36.71V24.26a4.7,4.7,0,0,1-3.32-4.5,4.64,4.64,0,1,1-9.27,0,4.64,4.64,0,1,1-9.27,0,4.68,4.68,0,0,1-3.31,4.48Z"/></svg>',
    ),
  );
return $social_network;
}
print_r(wfs_social_network());

/*
* Creo un filtro para el array de las redes sociales follow con las url y los select
*/
if (has_filter('wsf_array_social-network_filter')) {
    $social_network = apply_filters( 'wsf_array_social-network_filter', $social_network );
} 

/*
* creo el contenido con los botones share
*/
function wfs_share() {

 //comienzo el contenido 
  $wfs_content  = '<div class="wfs-share"><!-- WPO friendly share - START-->';
  $wfs_content .= '<p class="titulo">';
  $wfs_content .= esc_attr( $custom_label);       
  $wfs_content .= '</p>';
  $wfs_content .= '<div class="content-button">';

  foreach( $social_network as $red => $detalles ) {
    foreach($detalles as $clave => $valor){
    }
      $parametro = $social_network[$red]['parametros_share'];
      $url = $social_network[$red]['url_share'];
      $seleccionado = $social_network[$red]['seleccionado_share'];
      $seleccionados[] = $seleccionado;

    if( 1 == $seleccionado ) {

      $wfs_content .= '<a class="wfs-link-share wfs-share-' . $red . '" href="' . esc_url( $url . $parametro) . '" target="_blank" '. wfs_rel_nofollow() .' '. wfs_gtag( $red, 'share', esc_attr( get_the_title() ) ) .'"><span class="screen-reader-text">'.$red.'</span>'.$social_network[$red].'</a>';

    }
  }

  $wfs_content .= '</div></div><!-- WPO friendly share - END-->';
  //fin del contenido 
  print_r($social_network );

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

  global $social_network;
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

  foreach( $social_network as $red => $detalles ) {
    foreach($detalles as $clave => $valor){
    }
      $url = $social_network[$red]['url'];
      $seleccionado = $social_network[$red]['seleccionado'];
      $seleccionados[] = $seleccionado;

    if( 1 == $seleccionado ) {

      $wfs_content .= '<a itemprop="sameAs" class="wfs-link-follow wfs-follow-' . $red . '" href="'. esc_url( $url ) .'" target="_blank" '. wfs_rel_nofollow() .' '. wfs_gtag( $red, 'follow', '+1 Follow' ) .'><span class="screen-reader-text">'.$red.'</span>'.$social_network[$red].'</a>';

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