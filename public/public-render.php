<?php 
// Si se llama directamente a este archivo, aborta.
defined( 'ABSPATH' ) or die( '¡Sin trampas!' );

/*
* Registro la hoja de estilos css publica
*/
$wfs_opt_check = get_option( 'wfs_opt_check' );

if( 0 == $wfs_opt_check['css'] ) {

  add_action( 'wp_print_styles', 'wfs_public_style' );
  
  function wfs_public_style() {

      wp_register_style( 'wfs-public-style', WFS_URI . 'css/wfs-public-style.css' );
      wp_enqueue_style( 'wfs-public-style' );

  }

}

function &wfs_rel_nofollow() {

    global $wfs_opt_check; 

    if( 1 == $wfs_opt_check['rel-nofollow'] ) {

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

  global $wfs_opt_check; 

  if( get_option( 'wfs_opt_ga_gtag') == 'ga'){

    $event_gtag = 'onclick="'."ga('send', 'event', 'social', '$event', '$red_social $titulo');".'"';

  } elseif( get_option( 'wfs_opt_ga_gtag') == 'gtag' ){

    $event_gtag = 'onclick="'."gtag('event', '$event', { 'event_category': 'social', 'method': '$red_social', 'event_label': '$titulo'});".'"';
                                 
  }

  if( 1 == $wfs_opt_check['analytics'] ) { 

    return $event_gtag;

  } else{

      return;

    }
}

/*
* creo el contenido con los botones share
*/
function wfs_share() {

  $wfs_s_txt = get_option( 'wfs_s_txt');
  //Compruebo si hay texto en el titulo y si no agrego uno por defecto
  $custom_label = $wfs_s_txt['s-custom-label'];

  $wfs_s_check = get_option( 'wfs_s_check');
  if ( 1 == $wfs_s_check['check-custom-s'] ) {
    //comienzo el contenido 
    list ( $color_title, $size_title, $bg_color, $color, $width, $height, $b_radius ) = wfs_custom_button( 'share' );
    $wfs_content   = '<style>.wfs-share .social-icon {fill:'.$color.';}.wfs-link-share{'.$bg_color.$b_radius.$width.$height.'background-image:none;padding: 2.8pt;}</style>';
    $wfs_content  .= '<div class="wfs-share"><!-- WPO friendly share - START-->';
    $wfs_content  .= '<h3 class="titulo" style="'.$color_title.$size_title.'">';
  }else{

    $wfs_content   = '<div class="wfs-share"><!-- WPO friendly share - START-->';
    $wfs_content  .= '<h3 class="titulo">';

  }
  
  $wfs_content  .= esc_attr( $custom_label);       
  $wfs_content  .= '</h3>';
  $wfs_content  .= '<div class="content-button">';

  $social_networks = wfs_social_networks();
  $wfs_s_custom  = get_option( 'wfs_s_custom');
  foreach( $social_networks as $network => $data ) {

      $parametro       = $social_networks[ $network ][ 'parametros' ];
      $url             = esc_url ($social_networks[ $network ]['url_share' ] );
      if ( 1 == $wfs_s_check['check-custom-s'] ) {
        $icono           = $social_networks[ $network] [ 'icono' ];
      }
      $seleccionado    = $social_networks[ $network ][ 'selec_share' ];
      $seleccionados[] = $seleccionado;      

    if( 1 == $seleccionado ) {

      $wfs_content .= '<a class="wfs-link-share wfs-share-' . $network . '" href="' . esc_attr( $url . $parametro) . '" target="_blank" '. wfs_rel_nofollow() .' '. wfs_gtag( $network, 'share', esc_attr( get_the_title() ) ) .'"><span class="screen-reader-text">'.$network.'</span>' . $icono . '</a>';

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

  $wfs_s_check = get_option( 'wfs_s_check');
  $before = $wfs_s_check['s-before-post'];
  $after  = $wfs_s_check['s-after-post'];



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

  $wfs_f_check = get_option( 'wfs_f_check'); 
  if ( 1 == $wfs_f_check['check-custom-f'] ) {

    list ( $color_title, $size_title, $bg_color, $color, $width, $height, $b_radius ) = wfs_custom_button( 'follow' );
    $wfs_content  = '<style>.wfs-follow .social-icon {fill:'.$color.';}.wfs-link-follow{'.$bg_color.$b_radius.$width.$height.'background-image:none;}</style>';
  }else{
    $wfs_content  = '';
  }
  $wfs_content .= '<div class="wfs-follow" itemscope itemtype="http://schema.org/Organization"><!-- WPO friendly share - START-->';
  $wfs_content .= '<link itemprop="url" href="'. esc_url( get_home_url() ) .'">';
  $wfs_content .= '<meta itemprop="name" href="'. esc_attr( get_bloginfo() ) .'">';

  /*
  * Custom label
  */
  if ( 1 == $wfs_f_check['check-custom-f'] ) { 
    $wfs_content .= '<h3 class="titulo" style="'.$color_title.$size_title.'">';
  }else{
    $wfs_content .= '<h3 class="titulo">';
  }

  $custom_label = get_option( 'wfs-f-custom-label' );

  $wfs_content .= esc_attr( $custom_label);  
  $wfs_content .= '</h3>';

  $wfs_content .= '<div class="content-button">';

  $social_networks = wfs_social_networks();
  $icono = '';

  foreach( $social_networks as $network => $data ) {

    $url = $social_networks[ $network ][ 'url_follow' ];
    
    if ( 1 == $wfs_f_check['check-custom-f'] ) { 
     $icono = $social_networks[ $network ][ 'icono' ];
    }
     
    $seleccionado    = $social_networks[ $network ][ 'selec_follow' ];
    $seleccionados[] = $seleccionado;

    if( 1 == $seleccionado ) {

      $wfs_content .= '<a itemprop="sameAs" class="wfs-link-follow wfs-follow-' . $network . '" href="'. esc_url( $url ) .'" target="_blank" '. wfs_rel_nofollow() .' '. wfs_gtag( $network, 'follow', '+1 Follow' ) .'><span class="screen-reader-text">'.$network.'</span>' . $icono . '</a>';

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