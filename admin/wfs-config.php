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
		__( 'WPO Friendly Share setting', 'wpo-friendly-share' ), //$title, requerido
		'wfs_admin_render',  //$callback, requerido  (funcion que haga echo del contenido)
		'wfs_config_section'//$page requerido
	);
  
  //nevas opciones pero sin terminar, quizas ponga o quite mas 

  register_setting( 'wfs_config_section', 'wfs_s_check', 'wfs_sanitize_array_check' );
  register_setting( 'wfs_config_section', 'wfs_share_txt', 'wfs_sanitize_text_or_array_field' );
  register_setting( 'wfs_config_section', 'wfs_share_custom', 'wfs_sanitize_text_or_array_field' ); 

  register_setting( 'wfs_config_section', 'wfs_follow_url','esc_url_raw' );
  register_setting( 'wfs_config_section', 'wfs_f_check','wfs_sanitize_array_check' );
  register_setting( 'wfs_config_section', 'wfs-follow-custom-label', 'sanitize_text_field' );
  register_setting( 'wfs_config_section', 'wfs_follow_custom', 'wfs_sanitize_text_or_array_field' );


  register_setting( 'wfs_config_section', 'wfs_opt_ga_gtag','sanitize_text_field' );
  register_setting( 'wfs_config_section', 'wfs_opt_check', 'wfs_sanitize_array_check' );


////////


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

/*function wfs_sanitize_array_check($array_check) {

  if( is_array($array_check) ){

    foreach ( $array_check as $key => &$value ) {

      if( isset( $value ) ) {

        $value = 1;

      } else {

          $value = 0;

        }
    }
      
  }

  return $array_check;

}*/


//*****************************************////
//update_option( 'wfs_share_check_defaults', $defaults );

function wfs_defaults_options(){

  $s_check = array( 
      's-check-twitter'   => 0,
      's-check-facebook'  => 0,
      's-check-linkedin'  => 0,
      's-check-buffer'    => 0,
      's-check-pinterest' => 0,
      's-check-whatsapp'  => 0,
      's-check-telegram'  => 0,
      'before-post'       => 0,
      'after-post'        => 1,
      's-check-bg-none'   => 0,
    );

  $f_check = array( 
      'f-check-facebook'   => 0,
      'f-check-twitter'    => 0,
      'f-check-linkedin'   => 0,
      'f-check-instagram'  => 0,
      'f-check-youtube'    => 0,
      'f-check-pinterest'  => 0,
      'f-check-myBusiness' => 0,
      'f-check-telegram'   => 0,
      'f-check-bg-none'    => 0,
    );
return array($s_check, $f_check);

}


function wfs_sanitize_array_check( $array_check ) {
  list($s_check, $f_check ) = wfs_defaults_options();
    $new_args = (array) $s_check;

    foreach ( $array_check as $key => $value ) {
        if ( is_array( $value ) && isset( $new_args[ $key ] ) ) {
            $new_args[ $key ] = wfs_sanitize_array_check( $value, $new_args[ $key ] );
        }
        else {
            $new_args[ $key ] = $value;
        }
    }

    return $new_args;
}




/*********************************************************/

function wfs_sanitize_text_or_array_field($array_or_string) {
    if( is_string($array_or_string) ){
        $array_or_string = sanitize_text_field($array_or_string);
    }elseif( is_array($array_or_string) ){
        foreach ( $array_or_string as $key => &$value ) {
            if ( is_array( $value ) ) {
                $value = wfs_sanitize_text_or_array_field($value);
            }
            else {
                $value = sanitize_text_field( $value );
            }
        }
    }

    return $array_or_string;
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
        	<?php  _e( 'Social buttons optimized in loading speed by', 'wpo-friendly-share' ); ?>
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

  $settings_link = '<a href="' . esc_url( admin_url( 'admin.php?page=wpo-friendly-share') ) . '">' . __( 'Setting', 'wpo-friendly-share' ) . '</a>';
  $links[] =  $settings_link;

  return $links;
}

/*
* Devueleve la clase oculto si no esta seleccionado
*/
function wfs_add_class_oculto( $acction ) {

  if ( 0 == get_option( 'wfs_options_custom_' . $acction ) ) {
    $clase = 'oculto';
  } else {
    $clase = '';
  }
  
  echo $clase;

}


/*
* Cambia el texto del boton de personalizacion
*/
function wfs_switch_text( $action ) {

  if ( 1 == get_option( 'wfs_options_custom_' . $action ) ) {
    $texto  = '<span class="mas oculto" id="mas-'.$action.'">'. __( 'Quiero personalizar mis iconos', 'wpo-friendly-share' ) .'</span>';
    $texto .= '<span class="menos" id="menos-'.$action.'">'. __( 'Quiero los iconos clasicos', 'wpo-friendly-share' ) .'</span>';

  } else {
    $texto  = '<span class="mas" id="mas-'.$action.'">'. __( 'Quiero personalizar mis iconos', 'wpo-friendly-share' ) .'</span>';
    $texto .= '<span class="menos oculto" id="menos-'.$action.'">'. __( 'Quiero los iconos clasicos', 'wpo-friendly-share' ) .'</span>';
  }
  
  echo $texto;

}


/*
* Devuelve el resultado de la personalizacion
*/
function wfs_custom_result( $action ) {

  $social_networks = wfs_social_networks();

  if ( $action == 'share' ) {

    $social_networks_compare = wfs_social_networks_share();

  }elseif ( $action == 'follow' ) {

    $social_networks_compare = wfs_social_networks_follow();

  }

  // Obtengo la personalización para share
  list ( $color_title, $size_title, $bg_color, $color, $width, $height, $b_radius ) = wfs_custom_button( $action );


  $result  = '<style>.label-'. $action .' .social-icon {fill:'.$color.';}</style>';

  $result .= '<label class="label-'. $action .' content-custom-iconos">';
 
  $result .= '<p class="label-'. $action .'-p">'. __( 'These will be your icons', 'wpo-friendly-share' ). '</p>';

  $result .= '<h3 id="result-title-'. $action .'" style="'.$color_title.$size_title.'" class="result-title-'. $action .'" >' . esc_attr( get_option( 'wfs-'. $action .'-custom-label' ) ) .'</h3>';

  $result .= '<div style="width:100%;">';

  $i = 0;
  foreach( $social_networks as $network => $data ) {

    $network_compare =  $social_networks_compare[$i];
    $icon            = $social_networks[$network]['icono'];
    $seleccionado    = $social_networks[$network]['selec_'.$action ];
    $seleccionados[] = $seleccionado;
    $i ++;

    if( 1 == $seleccionado && $network == $network_compare ) {

      $result .= '<span class="result-icon-'. $action .'" style="'.$bg_color.$b_radius.$width.$height.'"><span class="screen-reader-text">'.$network.'</span>'.$icon.'</span >';

    }elseif(  0 == $seleccionado && $network == $network_compare ){

      $result .= '<span class="result-icon-'. $action .'" style="display:none;'.$bg_color.$b_radius.$width.$height.'"><span class="screen-reader-text">'.$network.'</span>'.$icon.'</span >';
      
    }
  }
  $result .= '</div>';
  $result .= '</label>';
  echo $result;
}