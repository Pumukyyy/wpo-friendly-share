<?php 
// Si se llama directamente a este archivo, aborta.
defined( 'ABSPATH' ) or die( '¡Sin trampas!' );

function socialNetwork(){

  $current_url = get_permalink();

  /********************BORRAR ESTO!!!!!!!!!!!!!!!!!************/
  //$current_url = str_replace( 'http://localhost/tallerespmkgutenberg', 'https://pmkchapaypintura.com', $current_url );
  /********************BORRAR ESTO!!!!!!!!!!!!!!!!!************/

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


  $telegram_txt   = rawurlencode( strip_tags( get_option( 'wfs-share-telegram-txt' ) ) );
  if ( empty( $telegram_txt ) ) {
    $telegram_txt = $default_txt;
  }
  $telegram_txt = '**' . $telegram_txt . '**';

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

  $social_network = array(
    'twitter'     => array(
      'url_share'     => 'https://twitter.com/intent/tweet?',
      'parametros'    => 'text=' . $current_title . '&url=' . $current_url . '&via=' . get_option( 'wfs-share-twitter-name' ),
      'selec_share'   => get_option( 'wfs-share-twitter' ),
      'url_follow'    => get_option( 'wfs-follow-url-twitter' ),
      'selec_follow'  => get_option( 'wfs-follow-checkbox-twitter' ),
      'icono'         => '<svg class="svg-social-icon" aria-hidden="true" role="img" focusable="false" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><path  class="social-icon" d="M40.18,15.65v1.19c0,11.2-8.52,24.08-23.94,24.05A23.12,23.12,0,0,1,3.55,37H5.62a17.63,17.63,0,0,0,10.32-3.55A8.35,8.35,0,0,1,8.13,27.3c.65,0,.88.34,1.53.34a3.7,3.7,0,0,0,2.07-.34,8.4,8.4,0,0,1-6.62-8.46A13.52,13.52,0,0,0,9,20a9.07,9.07,0,0,1-3.56-6.95,7.23,7.23,0,0,1,1.2-4.28,23.82,23.82,0,0,0,17.11,8.82c0-.65-.34-1.19-.34-1.84a8.28,8.28,0,0,1,8.09-8.46h.4A7.55,7.55,0,0,1,38,10.12a23.45,23.45,0,0,0,5.44-2,8.91,8.91,0,0,1-3.6,4.78,25.47,25.47,0,0,0,4.79-1.21,33.28,33.28,0,0,1-4.49,4ZM12,18.23c1.93,1.91,3.4,3.07,5.41,5.06l-5.64.36c2.49,1.05,4.39,1.68,6.94,2.79l-4.23,3.22c2.09.46,5.49.78,6.88.95l1.87.26-1.3,1.36a39.92,39.92,0,0,1-4.8,4.52A17.88,17.88,0,0,0,30,30.2C33.27,26.46,36.09,21,35.53,16c-.28-2.52-.24-4.42-3.45-4.31h-.22a.34.34,0,0,0-.2,0c-2.38.06-3.72,2-3.72,4.42a29.35,29.35,0,0,1,.33,5.13v1l-1-.06A44.58,44.58,0,0,1,12,18.23Z"/></svg>',
    ),
    'facebook'    => array(
      'url_share'     => 'https://www.facebook.com/sharer/sharer.php?',
      'parametros'    => 'u=' . $current_url,
      'selec_share'   => get_option( 'wfs-share-facebook' ),
      'url_follow'    => get_option( 'wfs-follow-url-facebook' ),
      'selec_follow'  => get_option( 'wfs-follow-checkbox-facebook' ),
      'icono'         => '<svg class="svg-social-icon" aria-hidden="true" role="img" focusable="false" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><path class="social-icon" d="M27.21,20.18h5.9V28h-5.9V42H19.13V28h-4V20.27h4V14.09a7.92,7.92,0,0,1,8-7.85h5.95v7.82H28a.71.71,0,0,0-.8.62v5.5Z"/></svg>',
    ),
    'linkedin'    => array(
      'url_share'     => 'https://www.linkedin.com/shareArticle?',
      'parametros'    => 'mini=true&url=' . $current_url . '&title='.$current_title,
      'selec_share'   => get_option( 'wfs-share-linkedin' ),
      'url_follow'    => get_option( 'wfs-follow-url-linkedin' ),
      'selec_follow'  => get_option( 'wfs-follow-checkbox-linkedin' ),
      'icono'         => '<svg class="svg-social-icon" aria-hidden="true" role="img" focusable="false" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><path class="social-icon" d="M14.62,40.89V18.12H7V40.89ZM10.77,15h0c2.5,0,4.29-1.59,4.29-3.85S13.27,7.3,10.77,7.3c-2.7,0-4.26,1.58-4.26,3.82S8.07,15,10.77,15ZM41.68,40.89h0V27.81c0-7-3.61-10.14-8.58-10.14a7.51,7.51,0,0,0-6.76,3.62V18.12H18.67c.24,2.26,0,22.77,0,22.77h7.67V28.28a4.83,4.83,0,0,1,.21-1.82,4.21,4.21,0,0,1,3.85-2.91c2.7,0,3.82,2.23,3.82,5.17V40.89Z"/></svg>',
    ),
    'buffer'      => array(
      'url_share'     => 'https://bufferapp.com/add?',
      'parametros'    => 'url=' . $current_url . '&amp;text=' . $current_title,
      'selec_share'   => get_option( 'wfs-share-buffer' ),
      'url_follow'    => null,
      'selec_follow'  => null,
      'icono'         => '<svg class="svg-social-icon" aria-hidden="true" role="img" focusable="false" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><path class="social-icon" d="M8,15.6l15.25,6.64a1.63,1.63,0,0,0,1.75,0L40.27,15.6a.89.89,0,0,0,.56-1.19.91.91,0,0,0-.56-.56L25,7.53a1.72,1.72,0,0,0-1.75,0L8,13.79C6.9,14.1,6.9,15,8,15.58Zm32.23,7.49h0c.82.62.82,1.44,0,1.76L25,31.48a1.82,1.82,0,0,1-1.78,0L8,24.85c-1.17-.63-1.17-1.45,0-1.76l3.4-1.45L23.26,26.8a1.78,1.78,0,0,0,1.76,0l12.13-5.16,3.06,1.45Zm0,9.18h0l-3.21-1.44L24.93,36a1.78,1.78,0,0,1-1.76,0L11.35,30.83,8,32.27c-1.16.29-1.16,1.45,0,1.76l15.22,6.63a1.78,1.78,0,0,0,1.76,0L40.18,34c1.22-.28,1.22-1.11.09-1.73Z"/></svg>',
    ),
    'pinterest'   => array(
      'url_share'     => 'https://pinterest.com/pin/create/button/?',
      'parametros'    => 'url=' . $current_url . '&media=' . $current_thumbnail_code . '&description='.$current_title,
      'selec_share'   => get_option( 'wfs-share-pinterest' ),
      'url_follow'    => get_option( 'wfs-follow-url-pinterest' ),
      'selec_follow'  => get_option( 'wfs-follow-checkbox-pinterest' ),
      'icono'         => '<svg class="svg-social-icon" aria-hidden="true" role="img" focusable="false" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><path class="social-icon" d="M18,24.09a8.16,8.16,0,0,1-.63-3.26c0-2.66,1.59-5.78,4.88-5.78A3.44,3.44,0,0,1,26,18.74a11.94,11.94,0,0,1-.68,3.43c-.4,1.24-.85,2.46-1.16,3.74a2.39,2.39,0,0,0,1.9,2.89,2.35,2.35,0,0,0,.79.06h.06a4.55,4.55,0,0,0,1.22-.17,6.23,6.23,0,0,0,3.48-3.35A14.13,14.13,0,0,0,33,19c0-4.5-3.45-6.91-8.19-6.91h0c-5.21-.17-9.61,3.57-9.78,8.36a3.39,3.39,0,0,0,0,.45v.06a4.37,4.37,0,0,0,1.21,3.29,1.3,1.3,0,0,1,.46,1.73,4.75,4.75,0,0,1-.57,1.78,1.7,1.7,0,0,1-2.1.82v0c-3.74-1.22-5.13-4.62-5.13-8a12.39,12.39,0,0,1,4-8.87A17.39,17.39,0,0,1,25,7.31c6.12,0,11.82,3.06,13.75,8.62a11.32,11.32,0,0,1,.56,3.49c0,4.82-1.78,10.06-6.43,12.7a11.94,11.94,0,0,1-6.07,1.56,8.2,8.2,0,0,1-4.93-1.59c-.14.45-.25.91-.37,1.39a18.68,18.68,0,0,1-.88,2.75,35.64,35.64,0,0,1-2.09,4.31.81.81,0,0,1-1,.31l-2.29-1a.65.65,0,0,1-.43-.6,16.07,16.07,0,0,1,.49-4.79.07.07,0,0,1,0-.06c.2-.62.37-1.3.54-1.95.29-1.05.57-2.1.82-3.18.43-1.73.88-3.46,1.31-5.19Z"/></svg>',
    ),
    'whatsapp'    => array(
      'url_share'     => 'https://' . $whatsapp_from . '/send?',
      'parametros'    => 'l=es&text=' . $whatsapp_txt . '%0A_' . $current_title . '_%0A' . $current_url,
      'selec_share'   => get_option( 'wfs-share-whatsapp' ),
      'url_follow'    => null,
      'selec_follow'  => null,
      'icono'         => '<svg class="svg-social-icon" aria-hidden="true" role="img" focusable="false" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><path class="social-icon" d="M17.21,37.84,7.29,40.9l3.06-9.46a16.86,16.86,0,0,1-2.07-8A16.34,16.34,0,0,1,41,23.5,16.32,16.32,0,0,1,17.21,37.84ZM26.65,26.7c.56-.68,1.53-2.32,2.6-1.64a23.93,23.93,0,0,0,3.21,1.59l.08,0,.06.06c.71.54.2,1.7-.06,2.35-1.05,3.06-5.36,1.68-7.48.8-3.32-1.59-7.4-6.13-7.68-9.9v-.05A4.4,4.4,0,0,1,19,16.61h0c.94-.68,2.13-1.36,2.81.11.4,1,.88,2,1.33,3s-.51,1.64-1,2.32l0,0,0,0a.18.18,0,0,0-.05.23h0l0,0a6,6,0,0,0,1.7,2.44l0,0c.37.37,2.33,1.87,2.9,1.84ZM24,35.15h.59a11.94,11.94,0,0,0,12-11.85,11.89,11.89,0,0,0-23.78,0,11.9,11.9,0,0,0,2.33,6.92l.31.42L14.26,34l3.48-1.08.37.26a11.62,11.62,0,0,0,5.9,2Z"/></svg>',
    ),
    'telegram'    => array(
      'url_share'     => 'https://' . $telegram_from . '?',
      'parametros'    => urlencode('url=' . $current_url . '&text=' . $telegram_txt),
      'selec_share'   => get_option( 'wfs-share-telegram' ),
      'url_follow'    => get_option( 'wfs-follow-url-telegram' ),
      'selec_follow'  => get_option( 'wfs-follow-checkbox-telegram' ),
      'icono'         => '<svg class="svg-social-icon" aria-hidden="true" role="img" focusable="false" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><path class="social-icon" d="M42.51,9.06l-6,30.44a2.3,2.3,0,0,1-3.26,1.11C28.59,37.06,24,33.58,19.4,30c-.28-.2-.22-.88.12-1.19C22.38,26.29,34.88,15,35.45,14.47s.45-.74.45-.74c0-.76-1.16,0-1.16,0C27.91,18,21.16,22.35,14.36,26.66a2.32,2.32,0,0,1-1.42.2l-8-2.72s-1.39-.48-1.47-1.51S4.92,21,4.92,21L39.84,7.33S42.51,7,42.51,9.06Z"/></svg>',
    ),
    'instagram'   => array(
      'url_share'     => null,
      'parametros'    => null,
      'selec_share'   => null,
      'url_follow'    => get_option( 'wfs-follow-url-instagram' ),
      'selec_follow'  => get_option( 'wfs-follow-checkbox-instagram' ),
      'icono'         => '<svg class="svg-social-icon" aria-hidden="true" role="img" focusable="false" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><path class="social-icon" d="M17.38,7.31H30.84A10,10,0,0,1,40.9,17.15V31.07a10,10,0,0,1-10.06,9.86H17.38A10,10,0,0,1,7.31,31.07V17.15A10,10,0,0,1,17.38,7.31Zm14.14,7.37a2,2,0,1,1-2.07,2,2.07,2.07,0,0,1,2.07-2Zm-7.31,1.76h0a7.4,7.4,0,1,0,7.45,7.4,7.51,7.51,0,0,0-7.45-7.4Zm0,3.49A4.14,4.14,0,1,1,20,24.07a4.25,4.25,0,0,1,4.17-4.14Zm-6.27-8.14h0a5.9,5.9,0,0,0-5.84,5.67v13a5.91,5.91,0,0,0,5.84,5.7H30.3a5.87,5.87,0,0,0,5.81-5.7V17.72a5.86,5.86,0,0,0-5.81-5.67Z"/></svg>',
    ),
    'youtube'     => array(
      'url_share'     => null,
      'parametros'    => null,
      'selec_share'   => null,
      'url_follow'    => get_option( 'wfs-follow-url-youtube' ),
      'selec_follow'  => get_option( 'wfs-follow-checkbox-youtube' ),
      'icono'         => '<svg class="svg-social-icon" aria-hidden="true" role="img" focusable="false" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><path class="social-icon" d="M32,23.61l-.08-.05h0c-4.45-2.58-8.73-4.94-13.1-7.43V31l.12-.08V31c4.59-2.69,9.41-5.19,13.09-7.4ZM20.41,40.93c-8.25-.17-11.06-.31-12.78-.71a5.46,5.46,0,0,1-2.92-1.7,7.41,7.41,0,0,1-1.39-3,20.45,20.45,0,0,1-.6-4.37A119,119,0,0,1,2.72,17c.28-2.61.4-5.73,2.16-7.52A5.47,5.47,0,0,1,7.77,7.91c1.67-.37,8.9-.65,16.35-.65s14.69.28,16.39.65a5.44,5.44,0,0,1,3.34,2.21c1.62,2.81,1.65,6.29,1.82,9,0,1.31,0,8.68,0,10-.26,4.31-.46,5.84-1.05,7.43a5.48,5.48,0,0,1-1.16,2.1,5.79,5.79,0,0,1-3,1.73,190.31,190.31,0,0,1-20,.59ZM7.46,17.66a110.72,110.72,0,0,0,0,13,18.07,18.07,0,0,0,.4,3.2,3.91,3.91,0,0,0,.34.94,1.51,1.51,0,0,0,.62.31,21,21,0,0,0,3.24.34c2.8.14,5.66.2,8.47.26a184.08,184.08,0,0,0,18.94-.57,1.55,1.55,0,0,0,.54-.31v0a1.82,1.82,0,0,0,.17-.43,22.8,22.8,0,0,0,.7-5.72c.09-1.48.06-3.09.06-4.54s0-3.09-.06-4.56c-.08-1.84-.11-4.56-1-6.27a1.32,1.32,0,0,0-.6-.28,36.73,36.73,0,0,0-5.27-.37q-5-.17-9.95-.17t-10,.17A36.73,36.73,0,0,0,8.9,13a1.31,1.31,0,0,0-.71.4c-.42.45-.65,3.43-.73,4.25Z"/></svg>',
    ),
    'myBusiness'  => array(
      'url_share'     => null,
      'parametros'    => null,
      'selec_share'   => null,
      'url_follow'    => get_option( 'wfs-follow-url-myBusiness' ),
      'selec_follow'  => get_option( 'wfs-follow-checkbox-myBusiness' ),
      'icono'         => '<svg class="svg-social-icon" aria-hidden="true" role="img" focusable="false" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><path class="social-icon" d="M33.82,19.76,32.29,7.31h6a2.82,2.82,0,0,1,2.55,2.07l2.69,10.38a4.84,4.84,0,0,1-2.69,4.33V38a3,3,0,0,1-3,3H10.37a3,3,0,0,1-3-3V24.12h0a4.82,4.82,0,0,1-2.72-4.36h0L7.46,9.38A2.76,2.76,0,0,1,10,7.31H16L14.43,19.76,16,7.34H32.29ZM35,30.36,35,30.08H30.13V32h2.95a2.4,2.4,0,0,1-.51,1.08,3,3,0,0,1-2.07.82,3.18,3.18,0,0,1-2.18-.9,3,3,0,0,1,4.17-4.26l.25.23,1.36-1.39-.25-.22a5.11,5.11,0,0,0-3.35-1.39A4.9,4.9,0,0,0,27,27.38a4.74,4.74,0,0,0-1.47,3.46A4.54,4.54,0,0,0,27,34.24a5.14,5.14,0,0,0,3.6,1.48,4.65,4.65,0,0,0,3.29-1.31,4.58,4.58,0,0,0,1.24-3A7.42,7.42,0,0,0,35,30.36Zm4.48-10.43-2.1-9.5-.88.09L38,19.62l0,.17c.12,1,.54,1.75.94,1.7s.56-.71.54-1.56Zm-27.7-9.41-.88-.09L8.73,20c0,.8.2,1.42.54,1.48s.82-.71.93-1.7l0-.2Zm8.68-.09-1.25-.06-1,9.5c0,.91.37,1.64.88,1.67s1-.76,1.05-1.75Zm9.58,9.44-.94-9.5-1.3.06.31,9.36c.06,1,.51,1.78,1,1.75s.91-.73.91-1.67ZM11.54,24.24V36.79H36.71V24.26a4.7,4.7,0,0,1-3.32-4.5,4.64,4.64,0,1,1-9.27,0,4.64,4.64,0,1,1-9.27,0,4.68,4.68,0,0,1-3.31,4.48Z"/></svg>',
    ),
    'correo'      => array(
      'url_share'     => null,
      'parametros'    => null,
      'selec_share'   => null,
      'url_follow'    => null,
      'selec_follow'  => null,
      'icono'         => '<svg class="svg-social-icon" aria-hidden="true" role="img" focusable="false" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><path class="social-icon" d="M22.35,27.2c2.41,1.61,1.22,1.16,3.37,0a6.2,6.2,0,0,0,.88.82L41.12,39.84H6.87c.2-.28,3.46-2.83,3.83-3.15l8.7-7c.91-.71,2-1.79,3-2.44Zm3.71-.2L39.3,17.5c.68-.45,1.25-.9,1.93-1.36V39.22c-.71-.48-1.19-1-1.87-1.53a5.63,5.63,0,0,1-.43-.4l-2.38-2c-.34-.28-.59-.48-.93-.73ZM6.79,39.1c0-2.09.08-3.85.08-5.89V24.05c0-1,.12-1.84.12-2.95l0-4.53c.14-.43.51.06.82.28l3.54,2.5c.62.45,1.16.79,1.79,1.27,2.21,1.67,4.87,3.43,7.11,5.1.29.2.54.37.85.6s.71.34.82.77A28.06,28.06,0,0,0,19,29.24c-3.94,3.2-7.76,6.09-11.7,9.47-.29.25-.17.28-.54.39ZM5.2,8.23H43L24.34,21.61a.1.1,0,0,1-.06,0l-.23.2c-4.79-3.2-9.58-7-14.17-10.18L5.77,8.72c-.26-.2-.4-.23-.57-.49ZM2.14,11.1V37.32a4.18,4.18,0,0,0,3.57,3.57H42.28A4.08,4.08,0,0,0,46.08,37V11.41A4.11,4.11,0,0,0,45,8.6a4.31,4.31,0,0,0-2.61-1.3H5.83a4.1,4.1,0,0,0-3.69,3.8Z"/></svg>',
    ),
    'pmkWebDev'   => array(
      'url_share'     => null,
      'parametros'    => null,
      'selec_share'   => null,
      'url_follow'    => null,
      'selec_follow'  => null,
      'icono'         => '<svg class="svg-social-icon" aria-hidden="true" role="img" focusable="false" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><path class="social-icon" d="M23.05,14.57c8.36-2.18,16-.85,17.15,2.92s-4.74,8.65-13.1,10.83-16,.91-17.09-2.92,4.7-8.62,13-10.83Zm.22.48h0c7.37-2,14.18-.82,15.17,2.72s-4.2,8.05-11.57,10.07-14.17.85-15.16-2.7,4.19-8.08,11.56-10.09Z"/><path class="cls-2" d="M43.54,34.27l4.76,2v.79l-4.76,2v-.9l3.63-1.48-3.63-1.44Zm-25-14.65a1.6,1.6,0,0,1-.71-.17.44.44,0,0,1-.31-.57.5.5,0,0,1,.31-.43c.26-.11.43-.19.62-.25a3.09,3.09,0,0,1,.09-.46.77.77,0,0,1,.62-.56.43.43,0,0,1,.43,0,.73.73,0,0,1,.34.42,4,4,0,0,1,.08.48,2.56,2.56,0,0,0,.63-.05h.59a5.86,5.86,0,0,1,.71,0,2.81,2.81,0,0,0,.68-.06h.57a3,3,0,0,1,.59-.08,1.19,1.19,0,0,0,.43-.06,2.1,2.1,0,0,0,.42-.09c.12,0,.14-.11.2-.11s0-.08-.14-.14a10,10,0,0,0-1.5-.37c-.54-.08-1.05-.2-1.53-.28-1.28-.23-2.58-.37-4-.48s-2.64-.15-4-.17c-.57,0-1.08,0-1.64,0a15.27,15.27,0,0,0-1.62.12,1.54,1.54,0,0,1-.94.37,1.33,1.33,0,0,1-.79-.09.55.55,0,0,1-.25-.25A.91.91,0,0,1,8.33,16a.73.73,0,0,1,.06-.43c.06-.14.09-.28.23-.34A1.32,1.32,0,0,1,9.16,15c.22-.06.42-.06.56-.09a5.49,5.49,0,0,1,1-.06h3.75c1,.06,2,.09,3,.2a24.88,24.88,0,0,1,3,.29,12.9,12.9,0,0,1,1.37.22l1.33.29a11.76,11.76,0,0,1,1.73.56,2.21,2.21,0,0,1,1.41,1.08.69.69,0,0,1-.14.77,2.35,2.35,0,0,1-.73.51,5.54,5.54,0,0,1-1,.34,5.18,5.18,0,0,0-.74.14c-.7.08-1.47.14-2.18.2h-.76c-.29,0-.51,0-.8,0V20c0,.14.06.31.06.51,0,.37.08.71.14,1.08s.09.71.14,1.11.14.87.17,1.3.14.91.2,1.39a2,2,0,0,1,.06.65.91.91,0,0,1-.2.62.63.63,0,0,1-.48.17c-.23,0-.43,0-.51-.08a.91.91,0,0,1-.48-.71,2.1,2.1,0,0,0-.09-.42,1.24,1.24,0,0,0-.06-.49c0-.22,0-.42,0-.65s-.06-.48-.06-.71-.09-.76-.14-1.13a11.08,11.08,0,0,1-.14-1.19V21a1.4,1.4,0,0,1-.06-.51v-.82Zm9.92,3.23c0,.17-.14.42-.17.65a2.26,2.26,0,0,1-.26.62,2.13,2.13,0,0,1-.7.85,1.44,1.44,0,0,1-1,.17,1.7,1.7,0,0,1-.7-.31c-.17-.14-.37-.34-.57-.48,0,.08,0,.2,0,.23a.24.24,0,0,1-.06.19c0,.2,0,.34,0,.49a2,2,0,0,1-.09.45,7,7,0,0,1-.2.91.64.64,0,0,1,0,.22c-.05.12-.05.2-.11.26s-.23.17-.42.17a.74.74,0,0,1-.51,0,.61.61,0,0,1-.57-.43.89.89,0,0,1-.06-.42A1.19,1.19,0,0,0,23,26a3.5,3.5,0,0,0,.08-.65,2.27,2.27,0,0,0,.12-.65c0-.2.08-.43.14-.68a4,4,0,0,0,.08-.65,2.2,2.2,0,0,0,.09-.43,1,1,0,0,1,.06-.42,6.54,6.54,0,0,0-.09-1.65,1.21,1.21,0,0,1,.14-.68,1,1,0,0,1,.6-.37.41.41,0,0,1,.42.06.31.31,0,0,1,.26.31c0,.06,0,.14,0,.26s.11.17.14.17a.18.18,0,0,0,.14.05c.06,0,.11,0,.14.06a.43.43,0,0,1,.2.23.19.19,0,0,1-.06.28.32.32,0,0,0,0,.09c-.06.05-.06.11-.12.14a3.6,3.6,0,0,0,.14,1.27,1.49,1.49,0,0,0,.83,1,.85.85,0,0,0,.56-.29,2.1,2.1,0,0,0,.23-.56,11.36,11.36,0,0,0,.28-1.7c.06-.63.06-1.19.06-1.76a1.27,1.27,0,0,1,0-.57.76.76,0,0,1,.34-.48,1.08,1.08,0,0,1,.51,0,.6.6,0,0,1,.48.29,1.6,1.6,0,0,1,.43,1,2.2,2.2,0,0,0,.05.56,2,2,0,0,0,.09.57c.05.17.08.37.14.57s.08.42.14.59a5.81,5.81,0,0,0,.2.57c.08.2.17.4.23.57.22.48.42,1,.62,1.47a3.66,3.66,0,0,1,.17.71,2.84,2.84,0,0,1,.06.71.46.46,0,0,1-.23.42,1.47,1.47,0,0,1-.57.15.79.79,0,0,1-.76-.49A3.4,3.4,0,0,1,29,25c0-.2-.09-.39-.14-.62a3.75,3.75,0,0,1-.09-.57c-.06-.2-.09-.34-.14-.51a.74.74,0,0,0-.2-.42ZM33.05,22a5.26,5.26,0,0,0,.94-.37,5,5,0,0,0,.82-.66A1.17,1.17,0,0,1,36,20.47a1.35,1.35,0,0,1,.43.53.52.52,0,0,1-.17.51c-.14.15-.29.23-.43.37a5.08,5.08,0,0,1-.48.34c-.23.15-.43.23-.65.37a3.92,3.92,0,0,1-.68.34c-.09.06-.23.09-.31.14a1.61,1.61,0,0,0-.34.15c-.06.05-.06.08,0,.08s.14.06.19.11a1.17,1.17,0,0,0,.43.17c.14.06.28.15.42.2.37.23.74.43,1.08.63s.57.36.91.65a3.51,3.51,0,0,1,.74.85.61.61,0,0,1,.11.42.33.33,0,0,1-.28.34,1.16,1.16,0,0,1-.4-.05c-.14-.09-.28-.14-.37-.2a4.36,4.36,0,0,1-.51-.31c-.2-.12-.34-.2-.54-.34S34.41,25.29,34,25c-.14,0-.22-.14-.36-.23l-.43-.22c0,.14-.06.37-.06.59a.85.85,0,0,1-.22.49.63.63,0,0,1-.4.14c-.17,0-.31,0-.37-.09a.65.65,0,0,1-.28-.57,1.76,1.76,0,0,1-.06-.53v-.46a1.35,1.35,0,0,1-.31-.2,2.26,2.26,0,0,1-.28-.19c-.06,0-.15-.15-.26-.23a.29.29,0,0,1-.14-.28.6.6,0,0,1,.34-.43c.06-.06.14-.08.28-.2s.2-.14.29-.14a2.58,2.58,0,0,1-.09-.51v-.48a4,4,0,0,1-.11-.51c0-.14,0-.34,0-.48a3.11,3.11,0,0,1,0-1.17,1.26,1.26,0,0,1,.2-.42.44.44,0,0,1,.42-.11.81.81,0,0,1,.43.14.56.56,0,0,1,.22.39c0,.15.06.29.06.46v.42A6.52,6.52,0,0,1,33,21.29a3,3,0,0,0,.08.74Zm-28,12.24v.91L1.5,36.62,5.07,38.1V39l-4.76-2v-.79Zm2.56,4.9L6.55,33.48H7.68l.57,3.4L10,33.48h.63l.85,3.34,1.56-3.34h1.22l-2.78,5.69h-.57l-.85-3.54-1.9,3.54ZM17,38.89c-.23.11-.43.14-.71.26s-.45,0-.74,0a2.13,2.13,0,0,1-1.39-.45,2,2,0,0,1-.45-1.39,2,2,0,0,1,2.13-2.12,1.54,1.54,0,0,1,1.16.42,1.75,1.75,0,0,1,.42,1.28v.2a.82.82,0,0,1,0,.22H14.83v.12a.82.82,0,0,0,.28.65,1,1,0,0,0,.71.2,2.26,2.26,0,0,0,.56-.12,3,3,0,0,0,.8-.31Zm-2-2.21h1.27V36.6a.75.75,0,0,0-.14-.49.47.47,0,0,0-.37-.14.62.62,0,0,0-.48.2.79.79,0,0,0-.28.51ZM17.8,39l.85-5.55h1.08l-.28,2.12a1,1,0,0,1,.51-.28.77.77,0,0,1,.48-.11,1.29,1.29,0,0,1,1,.48,2,2,0,0,1,.37,1.22,2.16,2.16,0,0,1-.71,1.7,3.08,3.08,0,0,1-2,.56c-.22,0-.48,0-.65,0A2.78,2.78,0,0,1,17.8,39ZM19,38.3h.14A1.65,1.65,0,0,0,20.3,38a1.19,1.19,0,0,0,.42-.94,1.24,1.24,0,0,0-.2-.68c-.08-.14-.22-.17-.45-.17a.65.65,0,0,0-.4.09,1.26,1.26,0,0,0-.42.34Zm2.84,1H26v.79H21.86Zm4.62-.2.85-5.61c.11,0,.19-.06.34-.06H28c.7,0,1.22.06,1.64.09a5.44,5.44,0,0,1,1,.34,2.27,2.27,0,0,1,1.08,1,2.81,2.81,0,0,1,.42,1.5,3.85,3.85,0,0,1-.17,1,2.23,2.23,0,0,1-.53.85,2.09,2.09,0,0,1-1,.65,4.81,4.81,0,0,1-1.56.2Zm1.38-.94h1a1.82,1.82,0,0,0,1.41-.48,1.65,1.65,0,0,0,.54-1.36,1.83,1.83,0,0,0-.57-1.39,2.14,2.14,0,0,0-1.56-.51h-.28Zm8,.74c-.17.11-.43.14-.65.26s-.48,0-.77,0a1.94,1.94,0,0,1-1.36-.45,1.9,1.9,0,0,1-.51-1.39,2,2,0,0,1,.6-1.56,2.13,2.13,0,0,1,1.53-.56,1.71,1.71,0,0,1,1.22.42,1.75,1.75,0,0,1,.42,1.28.31.31,0,0,1-.05.2v.22H33.7v.12a1.05,1.05,0,0,0,.26.65,1.11,1.11,0,0,0,.71.2,2.47,2.47,0,0,0,.59-.12,3.63,3.63,0,0,0,.83-.31Zm-2-2.21h1.33V36.6a1,1,0,0,0-.14-.49.63.63,0,0,0-.43-.14.5.5,0,0,0-.42.2,1.14,1.14,0,0,0-.34.51Zm3.68,2.41-1-3.83h1.13l.48,2.07,1.05-2.07h1.22l-2.07,3.83Zm2.95.79h-.62l2-6.52h.65Z"/></svg>',
    ),
  );

  if (has_filter('wsf_array_social_network_filter')) {
      $social_network = apply_filters( 'wsf_array_social_network_filter', $social_network );
  }
  return $social_network;
}


function customButton($acction) {        
$customButton = get_option('wfs_'.$acction.'_custom');
// Obtengo la personalización para share
$color_title = 'color:'.$customButton['color-title'].';';

$size_title  = 'font-size:'.$customButton['size-title'].'px;';

$bg_color    = 'background-color:'.$customButton['bg-color'].';';

if( 1 == get_option( 'wfs-'.$acction.'-background-none' ) ) {
 $bg_color = 'background-color:transparent;';
}

$color       = esc_attr( $customButton['color']);

$width       = 'width:'.esc_attr( $customButton['width'] ).'px;';

$height      = 'height:'.esc_attr( $customButton['width'] ).'px;';

$b_radius    = 'border-radius:'.esc_attr( $customButton['b-radius'] ).'%;';

$custom_button = array(
  $color_title,
  $size_title,
  $bg_color,
  $color,
  $width,
  $height,
  $b_radius,
);

  return $custom_button;
}

function social_network_share() {  
  $social_network_share = array( 
    'twitter',
    'facebook',
    'linkedin',
    'buffer',
    'pinterest'
    ,'whatsapp',
    'telegram',
    '',
    '',
    '',
    '',
    '',
  );

  if (has_filter('wsf_array_social_network_share_filter')) {
      $social_network_share = apply_filters( 'wsf_array_social_network_share_filter', $social_network_share );
  }

  return $social_network_share;
} 

function social_network_follow() {  
  $social_network_follow = array( 
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
      $social_network_follow = apply_filters( 'wsf_array_social_network_follow_filter', $social_network_follow );
  }

  return $social_network_follow;
}