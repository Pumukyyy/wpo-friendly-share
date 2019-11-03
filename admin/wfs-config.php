<?php 
// Si se llama directamente a este archivo, aborta.
defined( 'ABSPATH' ) or die( '¡Sin trampas!' );

/*
* Añado un menu en la pestaña de opciones
*/
add_action( 'admin_menu', 'wfs_add_admin_menu' );
function wfs_add_admin_menu() { 

	//add_submenu_page( $parent_slug,             $page_title,          $menu_title,       $capability,       $menu_slug,       $function); 
	add_submenu_page( 'options-general.php', 'WPO Friendly Share', 'WPO Friendly Share', 'manage_options', 'wpo-friendly-share', 'wfs_options_page' );

}


/*
* Creo la pagina de opciones del plugin
*/
add_action( 'admin_init', 'wfs_settings_init' );
function wfs_settings_init() {

	add_settings_section(
		'wfs_config_section', //$id, requerido
		__( 'Configuracion de WPO Friendly Share', 'wpo-friendly-share' ), //$title, requerido
		'wfs_admin_render',  //$callback, requerido  (funcion que haga echo del contenido)
		'wfs_config_section'//$page requerido
	);


	register_setting( 'wfs_config_section', 'wfs-share-custom-label', 'sanitize_text_field' );
  register_setting( 'wfs_config_section', 'wfs-share-facebook', 'wfs_sanitize_checkbox' );
  register_setting( 'wfs_config_section', 'wfs-share-twitter-name', 'sanitize_text_field' );
  register_setting( 'wfs_config_section', 'wfs-share-twitter', 'wfs_sanitize_checkbox' );
  register_setting( 'wfs_config_section', 'wfs-share-linkedin', 'wfs_sanitize_checkbox' );
  register_setting( 'wfs_config_section', 'wfs-share-buffer', 'wfs_sanitize_checkbox' );
  register_setting( 'wfs_config_section', 'wfs-share-pinterest', 'wfs_sanitize_checkbox' );
  register_setting( 'wfs_config_section', 'wfs-share-whatsapp', 'wfs_sanitize_checkbox' );
  register_setting( 'wfs_config_section', 'wfs-share-whatsapp-txt', 'sanitize_text_field' );
  register_setting( 'wfs_config_section', 'wfs-share-email', 'wfs_sanitize_checkbox' );
  register_setting( 'wfs_config_section', 'wfs-share-instagram', 'wfs_sanitize_checkbox' );
  register_setting( 'wfs_config_section', 'wfs-share-telegram-txt', 'sanitize_text_field' );
  register_setting( 'wfs_config_section', 'wfs-share-telegram', 'wfs_sanitize_checkbox' );



  register_setting( 'wfs_config_section', 'wfs-follow-custom-label', 'sanitize_text_field' );
  register_setting( 'wfs_config_section', 'wfs-follow-checkbox-facebook', 'wfs_sanitize_checkbox' );
  register_setting( 'wfs_config_section', 'wfs-follow-url-facebook', 'esc_url_raw' );
  register_setting( 'wfs_config_section', 'wfs-follow-checkbox-twitter', 'wfs_sanitize_checkbox' );
  register_setting( 'wfs_config_section', 'wfs-follow-url-twitter', 'esc_url_raw' );
  register_setting( 'wfs_config_section', 'wfs-follow-checkbox-linkedin', 'wfs_sanitize_checkbox' );
  register_setting( 'wfs_config_section', 'wfs-follow-url-linkedin', 'esc_url_raw' );
  register_setting( 'wfs_config_section', 'wfs-follow-checkbox-instagram', 'wfs_sanitize_checkbox' );
  register_setting( 'wfs_config_section', 'wfs-follow-url-instagram', 'esc_url_raw' );
  register_setting( 'wfs_config_section', 'wfs-follow-checkbox-youtube', 'wfs_sanitize_checkbox' );
  register_setting( 'wfs_config_section', 'wfs-follow-url-youtube', 'esc_url_raw' );
  register_setting( 'wfs_config_section', 'wfs-follow-checkbox-pinterest', 'wfs_sanitize_checkbox' );
  register_setting( 'wfs_config_section', 'wfs-follow-url-pinterest', 'esc_url_raw' );
  register_setting( 'wfs_config_section', 'wfs-follow-checkbox-myBusiness', 'wfs_sanitize_checkbox' );
  register_setting( 'wfs_config_section', 'wfs-follow-url-myBusiness', 'esc_url_raw' );
  register_setting( 'wfs_config_section', 'wfs-follow-checkbox-telegram', 'wfs_sanitize_checkbox' );
  register_setting( 'wfs_config_section', 'wfs-follow-url-telegram', 'esc_url_raw' );

  register_setting( 'wfs_config_section', 'wfs-options-before-post', 'wfs_sanitize_checkbox' );
  register_setting( 'wfs_config_section', 'wfs-options-after-post', 'wfs_sanitize_checkbox' );
  register_setting( 'wfs_config_section', 'wfs-options-css', 'wfs_sanitize_checkbox' );
  register_setting( 'wfs_config_section', 'wfs-options-rel-nofollow', 'wfs_sanitize_checkbox' );
  register_setting( 'wfs_config_section', 'wfs-options-analytics','wfs_sanitize_checkbox' );
  register_setting( 'wfs_config_section', 'wfs-options-ga-gtag','sanitize_text_field' );
  register_setting( 'wfs_config_section', 'wfs-options-delete-all','wfs_sanitize_checkbox' );
}


/*
* Saneo checkbox  
*/
function wfs_sanitize_checkbox( $value ) {

  // Si hay algún valor, el checbox fue seleccionado
  if( ! empty( $value ) ) {

    return 1;

  } else {
      return 0;
    }
}


/*
* Formulario para guardar las opciones
*/
function wfs_options_page() {
   if ( !current_user_can( 'manage_options' ) ) {
        return;
    }
  ?>
    <div class="wrap">
        <h1 style="position:relative;padding-right:88px;display:inline-block;">
        	<?php  _e( 'Botones sociales optimizados en velocidad de carga por', 'wpo-friendly-share' ); ?>
        	<a target="_blank" rel="noopener noreferrer" href="https://pmkchapaypintura.com/">
            	<span class= "wfs-icon-pmk"></span> 
            </a>
        </h1>

        <form method="post" action="options.php">
        	<?php
		        settings_fields( 'wfs_config_section' );
      			do_settings_sections( 'wfs_config_section' );
      			submit_button();
        	?>
     	</form>
    </div>
  <?php

}

/*
* Link a la configuracion del plugin
*/
add_filter( 'plugin_action_links_'.WFS_BASE, 'wfs_add_settings_link' );

function wfs_add_settings_link( $links ) {

  $settings_link = '<a href="' . esc_url( admin_url( 'admin.php?page=wpo-friendly-share') ) . '">' . __( 'Ajustes', 'wpo-friendly-share' ) . '</a>';
  $links[] =  $settings_link;

  return $links;
}