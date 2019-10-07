<?php 
// Si se llama directamente a este archivo, aborta.
defined( 'ABSPATH' ) or die( '¡Sin trampas!' );

/*
* Registro la hoja de estilos css publica
*/
if( 0 == get_option( 'wfs-options-css' ) ) { 

  add_action( 'wp_print_styles', 'wfs_public_style' );
  
  function wfs_public_style() {

    wp_register_style( 'wfs-public-style', WFS_URI . '/css/wfs-public-style.css' );
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
* Evento share Gtag
*/
function wfs_share_gtag( $red_social ) {
  $shareTitle = str_replace( ' ', '%20', get_the_title() );
  if( get_option( 'wfs-options-ga-gtag') == 'ga'){

    $event_gtag = 'onclick="'."ga('send', 'event', 'social', 'share', '$red_social $shareTitle');".'"';

  } elseif( get_option( 'wfs-options-ga-gtag') == 'gtag' ){

    $event_gtag = 'onclick="'."gtag('event', 'share', { 'event_category': 'social', 'method': '$red_social', 'event_action': 'click', 'event_label': '$shareTitle'});".'"';

  }

  if( get_option( 'wfs-options-analytics' ) == 1 ){ 

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

  $custom_label = get_option( 'wfs-share-custom-label' );
  $facebook     = get_option( 'wfs-share-facebook' );
  $twitter_name = get_option( 'wfs-share-twitter-name' );
  $twitter      = get_option( 'wfs-share-twitter' );
  $linkedin     = get_option( 'wfs-share-linkedin' );
  $buffer       = get_option( 'wfs-share-buffer' );
  $pinterest    = get_option( 'wfs-share-pinterest' );
  $whatsapp     = get_option( 'wfs-share-whatsapp' );

  $current_url       = esc_url( get_permalink() );
  $current_title     = str_replace( ' ', '%20', get_the_title() );
  $current_thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'thumbnail' );


  $twitter_url   = 'https://twitter.com/intent/tweet?text='.$current_title.'&amp;url='.$current_url.'&amp;via='.$twitter_name;

  $facebook_url  = 'https://www.facebook.com/sharer/sharer.php?u='.$current_url;

  $linkedin_url  = 'https://www.linkedin.com/shareArticle?mini=true&url='.$current_url.'&title='.$current_title;

  $buffer_url    = 'https://bufferapp.com/add?url='.$current_url.'&amp;text='.$current_title;

  $pinterest_url = 'https://pinterest.com/pin/create/button/?url='.$current_url.'&amp;media='.$current_thumbnail[0].'&amp;description='.$current_title;

  $whatsapp_url  = 'https://api.whatsapp.com/send?text=Mira%20esto,%20creo%20que%20te%20va%20a%20interesar%0a'.$current_url. '&amp;media='.$current_thumbnail[0].'&amp;description='.$current_title;


  $wfs_content  = '<div class="wfs-share"><!-- WPO friendly share - START-->';
  $wfs_content .= '<p class="titulo">';

  if ( !empty( $custom_label ) ) {

   $wfs_content .= esc_attr( $custom_label);

  } else {

          $wfs_content .= __( 'Compartelo con un amigo', 'wpo-friendly-share' );

         }

  $wfs_content .= '</p>';
  $wfs_content .= '<div class="content-button">';

  if( 1 == $facebook ) {

    $wfs_content .= '<a class="wfs-link-share wfs-share-facebook" href="'. esc_url( $facebook_url ) .'" target="_blank" '. wfs_rel_nofollow() .'onclick="'. wfs_share_gtag( 'facebook' ) .'"></a>';

  }

  if( 1 == $twitter) {

    $wfs_content .= '<a class="wfs-link-share wfs-share-twitter" href="'. esc_url( $twitter_url ) .'" target="_blank" '. wfs_rel_nofollow() .' onclick="'. wfs_share_gtag( 'twitter' ) .'"></a>';

   }

  if( 1 == $linkedin ) {

    $wfs_content .= '<a class="wfs-link-share wfs-share-linkedin" href="'. esc_url( $linkedin_url ) .'" target="_blank" '. wfs_rel_nofollow() .' onclick="'. wfs_share_gtag( 'linkedin' ) .'"></a>';

  }

  if( 1 == $buffer) {

    $wfs_content .= '<a class="wfs-link-share wfs-share-buffer" href="'. esc_url( $buffer_url ) .'" target="_blank" '. wfs_rel_nofollow() .' onclick="'. wfs_share_gtag( 'buffer' ) .'"></a>';

  }

  if( 1 == $pinterest ) {

    $wfs_content .= '<a class="wfs-link-share wfs-share-pinterest" href="'. esc_url( $pinterest_url ) .'" target="_blank" '. wfs_rel_nofollow() .' onclick="'. wfs_share_gtag( 'pinterest' ) .'"></a>';

  }

  if( 1 == $whatsapp ) {

    $wfs_content .= '<a class="wfs-link-share wfs-share-whatsapp" href="'. esc_url( $whatsapp_url ) .'" target="_blank" '. wfs_rel_nofollow() .' onclick="'. wfs_share_gtag( 'whatsapp' ) .'"></a>';

  }

  $wfs_content .= '</div></div><!-- WPO friendly share - END-->';

  return $wfs_content;

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

  $seleccionados = array(
                    get_option( 'wfs-share-facebook' ),
                    get_option( 'wfs-share-twitter' ),
                    get_option( 'wfs-share-linkedin' ),
                    get_option( 'wfs-share-buffer' ),
                    get_option( 'wfs-share-pinterest' ),
                    get_option( 'wfs-share-whatsapp' ),
                  );
  
  if ( 0 < array_sum( $seleccionados ) ) {

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

}


/*
* Evento follow Gtag
*/
function wfs_follow_gtag( $red_social ) {

  if( get_option( 'wfs-options-ga-gtag' ) == 'ga' ) {

    $event_gtag = 'onclick="'."ga('send', 'event', 'social', 'follow', '$red_social ');".'"';

  } elseif( get_option( 'wfs-options-ga-gtag' ) == 'gtag' ) {

      $event_gtag = 'onclick="'."gtag('event', 'follow', { 'event_category': 'social', 'event_action': 'click', 'event_label': '$red_social'});".'"';

    }

  if( 1 == get_option( 'wfs-options-analytics' ) ) { 

    return $event_gtag;

  } else {

      return;

    }
}

/*
* creo el contenido con los botones follow compruebo si hay algo selecciona y creo un sortcode
*/
$seleccionados = array(
                  get_option( 'wfs-follow-checkbox-twitter' ),
                  get_option( 'wfs-follow-checkbox-facebook' ),
                  get_option( 'wfs-follow-checkbox-linkedin' ),
                  get_option( 'wfs-follow-checkbox-pinterest' ),
                  get_option( 'wfs-follow-checkbox-instagram' ),
                  get_option( 'wfs-follow-checkbox-youtube' ),
                  get_option( 'wfs-follow-checkbox-myBusiness' ),
                );
if ( 0 < array_sum( $seleccionados ) ) {

  add_shortcode( 'wfs_follow', 'wfs_follow' );

}
  
function wfs_follow( $content ) {

  $custom_label   = get_option( 'wfs-follow-custom-label' );
  $twitter_url    = get_option( 'wfs-follow-url-twitter' );
  $facebook_url   = get_option( 'wfs-follow-url-facebook' );
  $linkedin_url   = get_option( 'wfs-follow-url-linkedin' );
  $pinterest_url  = get_option( 'wfs-follow-url-pinterest' );
  $instagram_url  = get_option( 'wfs-follow-url-instagram' );
  $youtube_url    = get_option( 'wfs-follow-url-youtube' );
  $myBusiness_url = get_option( 'wfs-follow-url-myBusiness' );

  $twitter_checkbox     = get_option( 'wfs-follow-checkbox-twitter' );
  $facebook_checkbox    = get_option( 'wfs-follow-checkbox-facebook' );
  $linkedin_checkbox    = get_option( 'wfs-follow-checkbox-linkedin' );
  $pinterest_checkbox   = get_option( 'wfs-follow-checkbox-pinterest' );
  $instagram_checkbox   = get_option( 'wfs-follow-checkbox-instagram' );
  $youtube_checkbox     = get_option( 'wfs-follow-checkbox-youtube' );
  $miBusiness_checkbox  = get_option( 'wfs-follow-checkbox-myBusiness' ); 


  $wfs_content  = '<div class="wfs-follow" itemscope itemtype="http://schema.org/Organization"><!-- WPO friendly share - START-->';
  $wfs_content .= '<link itemprop="url" href="'. esc_url( get_home_url() ) .'">';
  $wfs_content .= '<meta itemprop="name" href="'. esc_attr( get_bloginfo() ) .'">';

  $wfs_content .= '<p class="titulo">';

  if ( !empty( $custom_label ) ) {

   $wfs_content .= esc_attr( $custom_label);

  } else {

          $wfs_content .= __( 'Siguenos en las redes', 'wpo-friendly-share' );

         }

  $wfs_content .= '</p>';
  $wfs_content .= '<div class="content-button">';

  if( 1 == $facebook_checkbox ) {

    $wfs_content .= '<a itemprop="sameAs" class="wfs-link-follow wfs-follow-facebook" href="'. $facebook_url .'" target="_blank" '. wfs_rel_nofollow() .' '. wfs_follow_gtag( 'facebook' ) .'></a>';

  }

  if( 1 == $twitter_checkbox ) {

    $wfs_content .= '<a itemprop="sameAs" class="wfs-link-follow wfs-follow-twitter" href="'. $twitter_url .'" target="_blank" '. wfs_rel_nofollow() .' '. wfs_follow_gtag( 'twitter' ) .'></a>';
  }

  if( 1 == $linkedin_checkbox ) {

    $wfs_content .= '<a itemprop="sameAs" class="wfs-link-follow wfs-follow-linkedin" href="'. $linkedin_url .'" target="_blank" '. wfs_rel_nofollow() .' '. wfs_follow_gtag( 'linkedin' ) .'></a>';

  }

  if( 1 == $pinterest_checkbox ) {

    $wfs_content .= '<a itemprop="sameAs" class="wfs-link-follow wfs-follow-pinterest" href="'. $pinterest_url .'" target="_blank" '. wfs_rel_nofollow() .' '. wfs_follow_gtag( 'pinterest' ) .'></a>';

  }

  if( 1 == $instagram_checkbox ) {

    $wfs_content .= '<a itemprop="sameAs" class="wfs-link-follow wfs-follow-instagram" href="'. $instagram_url .'" target="_blank" '. wfs_rel_nofollow() .''. wfs_follow_gtag( 'instagram' ) .'></a>';

  }

  if( 1 == $youtube_checkbox ) {

    $wfs_content .= '<a itemprop="sameAs" class="wfs-link-follow wfs-follow-youtube" href="'. $youtube_url .'" target="_blank" '. wfs_rel_nofollow() .' '. wfs_follow_gtag( 'youtube' ) .'></a>';

  }

  if( 1 == $miBusiness_checkbox ) {
    
    $wfs_content .= '<a itemprop="sameAs" class="wfs-link-follow wfs-follow-mybusiness" href="'. $myBusiness_url .'" target="_blank" '. wfs_rel_nofollow() .' '. wfs_follow_gtag( 'MyBusiness' ) .'></a>';
  }

  $wfs_content .= '</div></div><!-- WPO friendly share - END-->';

    return $wfs_content;
}


