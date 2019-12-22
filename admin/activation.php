<?php 
// Si se llama directamente a este archivo, aborta.
defined( 'ABSPATH' ) or die( '¡Sin trampas!' );

/*
* Añado la configuracion por defecto 
*/
function wfs_add_default_options(){

  update_option( 'wfs_pluign_version', WFS_VERSION );
  
  $s_txt = array(
    's-custom-label' => __( 'Share it with a friend', 'wpo-friendly-share' ),
    's-twitter-name' => '',
    's-whatsapp-txt' => __( 'Look at this, I think it will interest you', 'wpo-friendly-share' ),
    's-telegram-txt' => __( 'Look at this, I think it will interest you', 'wpo-friendly-share' ),
  );
  list($s_check, $f_check, $opt_check ) = wfs_compare_array_check();

  $s_after_post = array( 's-after-post' => 1 );
  $s_check = array_replace( $s_check, $s_after_post );

  $f_after_post = array( 'f-check-bg-none' => 1 );
  $f_check = array_replace( $f_check, $f_after_post );

  
  update_option( 'wfs_s_txt', $s_txt );
  update_option( 'wfs_s_check', $s_check );

  $s_custom = array(
    'color-title' => '#808080',
    'size-title'  => '16',
    'bg-color'    => '#808080',
    'color'       => '#f4f4f4',
    'b-radius'    => '50',
    'width'       => '27',
  );

  update_option( 'wfs_s_custom', $s_custom );

  update_option( 'wfs-f-custom-label', __( 'Follow me on the social networks', 'wpo-friendly-share' ) );
  update_option( 'wfs_f_check', $f_check );

  $f_custom = array( 
    'color-title' => '#646464',
    'size-title'  => '24',
    'bg-color'    => '#c0c0c0',
    'color'       => '#646464',
    'b-radius'    => '7',
    'width'       => '37', 
  );

  update_option( 'wfs_f_custom', $f_custom );
  
  update_option( 'wfs_opt_check', $opt_check );

  set_transient( 'wfs_activated', 1 );
  

}


/*
 * Mostrar un aviso a cualquiera que haya instalado el complemento por primera vez 
 * Este aviso no debería mostrarse a nadie que haya actualizado este complemento 
 */ 
// function wfs_display_install_notice () { 
//  // Verifique el transitorio para ver si acabamos de activó el complemento 
//  if ( get_transient ('wfs_activated') ) { 
//   echo '<div class = "notice notice-success">'. __ ('Gracias por instalar este favuloso complemento!!!', 'wpo-friendly-share'). '</div>'; 
//   // Eliminar el transitorio para que no sigamos mostrando el mensaje de activación 
//   //delete_transient ('wfs_activated'); 
//  } 
// } 
// add_action ('admin_notices', 'wfs_display_install_notice');

