<?php 
// Si se llama directamente a este archivo, aborta.
defined( 'ABSPATH' ) or die( '¡Sin trampas!' );


	/*
	* Añado opciones por defecto
	*/
	wfs_add_default_options();
	//creo lo opcion de la version a old si no existe
	update_option( 'wfs_pluign_version', 'old' );

/*
* Guardo las opciones antiguas en un array
*/
function wfs_change_options_to_array() {

	$wfs_s_check  = array(
		's-check-twitter'   => get_option( 'wfs-share-twitter' ),
		's-check-facebook'  => get_option( 'wfs-share-facebook' ),
		's-check-linkedin'  => get_option( 'wfs-share-linkedin' ),
		's-check-buffer'    => get_option( 'wfs-share-buffer' ),
		's-check-pinterest' => get_option( 'wfs-share-pinterest'  ),
		's-check-whatsapp'  => get_option( 'wfs-share-whatsapp' ),
		's-check-telegram'  => get_option( 'wfs-share-telegram' ),
		's-before-post'     => get_option( 'wfs-options-before-post' ),
		's-after-post'      => get_option( 'wfs-options-after-post' ),
	);
	update_option( 'wfs_s_check', $wfs_s_check );

  $wfs_s_txt = array(
    's-custom-label' => get_option( 'wfs-share-custom-label' ),
    's-twitter-name' => get_option( 'wfs-share-twitter-name' ),
    's-whatsapp-txt' => get_option( 'wfs-share-whatsapp-txt' ),
    's-telegram-txt' => get_option( 'wfs-share-telegram-txt' ),
  );
  update_option( 'wfs_s_txt', $wfs_s_txt );
  
  $wfs_f_url  = array(
	  'f-url-twitter'    => get_option( 'wfs-follow-url-twitter' ),
	  'f-url-facebook'   => get_option( 'wfs-follow-url-facebook' ),
	  'f-url-linkedin'   => get_option( 'wfs-follow-url-linkedin' ),
	  'f-url-pinterest'  => get_option( 'wfs-follow-url-pinterest' ),
	  'f-url-telegram'   => get_option( 'wfs-follow-url-telegram' ),
	  'f-url-instagram'  => get_option( 'wfs-follow-url-instagram' ),
	  'f-url-youtube'    => get_option( 'wfs-follow-url-youtube' ),
	  'f-url-myBusiness' => get_option( 'wfs-follow-url-myBusiness' ),
	);
  update_option( 'wfs_f_url', $wfs_f_url );

  $wfs_f_check = array(
	  'f-check-twitter'    => get_option( 'wfs-follow-checkbox-twitter' ),
	  'f-check-facebook'   => get_option( 'wfs-follow-checkbox-facebook' ),
	  'f-check-linkedin'   => get_option( 'wfs-follow-checkbox-linkedin' ),
	  'f-check-pinterest'  => get_option( 'wfs-follow-checkbox-pinterest' ),
	  'f-check-telegram'   => get_option( 'wfs-follow-checkbox-telegram' ),
	  'f-check-instagram'  => get_option( 'wfs-follow-checkbox-instagram' ),
	  'f-check-youtube'    => get_option( 'wfs-follow-checkbox-youtube' ),
	  'f-check-myBusiness' => get_option( 'wfs-follow-checkbox-myBusiness' ),
	);
  update_option( 'wfs_f_check', $wfs_f_check );

  $wfs_opt_check = array(
	  'css'          => get_option( 'wfs-options-css' ),
	  'rel-nofollow' => get_option( 'wfs-options-rel-nofollow' ),
	  'analytics'    => get_option( 'wfs-options-analytics' ),
	  'delete-all'   => get_option( 'wfs-options-delete-all' ),
	);
  update_option( 'wfs_opt_check', $wfs_opt_check );

  $ga_gtag = get_option( 'wfs-options-ga-gtag' );
  update_option( 'wfs_opt_ga_gtag', $ga_gtag );
	//actualizo a la version actual
  

}

/*
* Compruebo la version del plugin y actualizo la configuracion si procede 
*/

// si la version es old
if( 'old' == get_option( 'wfs_pluign_version', false ) ) {

	//actualizo la configuracion
	wfs_change_options_to_array();
	//actualizo la version
	update_option( 'wfs_pluign_version', WFS_VERSION );
    
}


if( '1.2.0' == get_option( 'wfs_pluign_version', false ) ) {
	wfs_remove_previous_options();
    set_transient( 'wfs_updated', 1 );
}


/*
 * Mostrar un aviso al actualizar el plugin
 * Este aviso solo debería mostrarse a quien haya actualizado este complemento 
 */ 
function wfs_display_upgrade_notice() { 
 // Verifique el transitorio para ver si acabamos de activó el complemento 
 if ( get_transient ('wfs_updated') ) { 
  echo '<div class = "notice notice-success is-dismissible"><p>';
  _e( 'Thank you for using WPO Friendly Share, we will soon have many more features.', 'wpo-friendly-share' );
  echo '</p></div>'; 
  // Eliminar el transitorio para que no sigamos mostrando el mensaje de activación 
  delete_transient ('wfs_updated'); 
 } 
} 
add_action ('admin_notices', 'wfs_display_upgrade_notice');