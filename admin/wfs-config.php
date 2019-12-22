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

  register_setting( 'wfs_config_section', 'wfs_s_check', 'wfs_sanitize_array_s_check' );
  register_setting( 'wfs_config_section', 'wfs_s_txt', 'wfs_sanitize_array_text' );
  register_setting( 'wfs_config_section', 'wfs_s_custom', 'wfs_sanitize_array_text' ); 

  register_setting( 'wfs_config_section', 'wfs_f_url','wfs_sanitize_array_url' );
  register_setting( 'wfs_config_section', 'wfs_f_check','wfs_sanitize_array_f_check' );
  register_setting( 'wfs_config_section', 'wfs-f-custom-label', 'sanitize_text_field' );
  register_setting( 'wfs_config_section', 'wfs_f_custom', 'wfs_sanitize_array_text' );


  register_setting( 'wfs_config_section', 'wfs_opt_ga_gtag','sanitize_text_field' );
  register_setting( 'wfs_config_section', 'wfs_opt_check', 'wfs_sanitize_array_opt_check' );

}


function wfs_compare_array_check(){

  $s_check = array( 
    's-check-twitter'   => 0,
    's-check-facebook'  => 0,
    's-check-linkedin'  => 0,
    's-check-buffer'    => 0,
    's-check-pinterest' => 0,
    's-check-whatsapp'  => 0,
    's-check-telegram'  => 0,
    's-before-post'     => 0,
    's-after-post'      => 0,
    'check-custom-s'    => 0,
    's-check-bg-none'   => 0,
  );
 
  $f_check = array( 
    'f-check-twitter'    => 0,
    'f-check-facebook'   => 0,
    'f-check-linkedin'   => 0,
    'f-check-pinterest'  => 0,
    'f-check-telegram'   => 0,
    'f-check-instagram'  => 0,
    'f-check-youtube'    => 0,
    'f-check-myBusiness' => 0,
    'check-custom-f'     => 0,
    'f-check-bg-none'    => 0,
  );

  $opt_check = array(
    'css'                 => 0, 
    'rel-nofollow'        => 0,
    'analytics'           => 0,
    'delete-all'          => 0,
  );

  return array($s_check, $f_check, $opt_check);

}


function wfs_sanitize_array_s_check( $array_check ) {

  list($s_check, $f_check, $opt_check ) = wfs_compare_array_check();

    foreach ( $array_check as $key => $value ) {

        if ( is_array( $value ) && isset( $s_check[ $key ] ) ) {

            $s_check[ $key ] = wfs_sanitize_array_s_check( $value, $s_check[ $key ] );

        } else {

            $s_check[ $key ] = $value;

        }
    }

    return $s_check;

}

function wfs_sanitize_array_f_check( $array_check ) {

  list($s_check, $f_check, $opt_check ) = wfs_compare_array_check();

    foreach ( $array_check as $key => $value ) {

        if ( is_array( $value ) && isset( $f_check[ $key ] ) ) {

            $f_check[ $key ] = wfs_sanitize_array_f_check( $value, $f_check[ $key ] );

        } else {

            $f_check[ $key ] = $value;
        }
    }

    return $f_check;

}

function wfs_sanitize_array_opt_check( $array_check ) {

  list($s_check, $f_check, $opt_check ) = wfs_compare_array_check();

    foreach ( $array_check as $key => $value ) {

        if ( is_array( $value ) && isset( $opt_check [ $key ] ) ) {

            $opt_check [ $key ] = wfs_sanitize_array_opt_check( $value, $opt_check [ $key ] );

        } else {

            $opt_check [ $key ] = $value;

        }
    }

    return $opt_check ;

}


/*********************************************************/

function wfs_sanitize_array_text( $array_text ) {

    if( is_array( $array_text ) ) {

        foreach ( $array_text as $key => &$value ) {

            if ( is_array( $value ) ) {

                $value = wfs_sanitize_array_text($value);

            } else {

                $value = sanitize_text_field( $value );
            }
        }
    }

    return $array_text;
}

function wfs_sanitize_array_url( $array_url ) {

  if( is_array( $array_url ) ) {

      foreach ( $array_url as $key => &$value ) {

          if ( is_array( $value ) ) {

              $value = wfs_sanitize_array_url($value);

          } else {

              $value = esc_url_raw( $value );
          }
      }
  }

    return $array_url;
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

  $settings_link = '<a href="' . esc_url( admin_url( 'admin.php?page=wpo-friendly-share') ) . '">' . __( 'Settings', 'wpo-friendly-share' ) . '</a>';
  $links[] =  $settings_link;

  return $links;
}

/*
* Devueleve la clase oculto si no esta seleccionado
*/
function wfs_add_class_oculto( $action ) {

  if ( $action == 'share' ) {

    $action = 's';

  }elseif ( $action == 'follow' ) {

    $action = 'f';
  }

  $custom_activated = get_option( 'wfs_'.$action.'_check' ); 

  if ( 0 == $custom_activated['check-custom-' . $action ] ) {

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

  if ( $action == 'share' ) {

    $action = 's';

  }elseif ( $action == 'follow' ) {

    $action = 'f';
  }

  $switch_text = get_option( 'wfs_'.$action.'_check' ); 

  if ( 1 == $switch_text['check-custom-' . $action ]  ) {

    $texto  = '<span class="mas oculto" id="mas-'.$action.'">'. __( 'I want to customize my icons', 'wpo-friendly-share' ) .'</span>';
    $texto .= '<span class="menos" id="menos-'.$action.'">'. __( 'I want the classic icons', 'wpo-friendly-share' ) .'</span>';

  } else {

    $texto  = '<span class="mas" id="mas-'.$action.'">'. __( 'I want to customize my icons', 'wpo-friendly-share' ) .'</span>';
    $texto .= '<span class="menos oculto" id="menos-'.$action.'">'. __( 'I want the classic icons', 'wpo-friendly-share' ) .'</span>';
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
    $custom_label = get_option( 'wfs_s_txt');
    $custom_label = $custom_label['s-custom-label'];

  }elseif ( $action == 'follow' ) {

    $social_networks_compare = wfs_social_networks_follow();
    $custom_label = get_option( 'wfs-f-custom-label' );

  }


  // Obtengo la personalización para share
  list ( $color_title, $size_title, $bg_color, $color, $width, $height, $b_radius ) = wfs_custom_button( $action );

  

  $result  = '<style>.label-'. $action .' .social-icon {fill:'.$color.';}</style>';

  $result .= '<label class="label-'. $action .' content-custom-iconos">';
 
  $result .= '<p class="label-'. $action .'-p">'. __( 'These will be your icons', 'wpo-friendly-share' ). '</p>';

  $result .= '<h3 id="result-title-'. $action .'" style="'.$color_title.$size_title.'" class="result-title-'. $action .'" >' . esc_attr( $custom_label ) .'</h3>';

  $result .= '<div style="width:100%;">';

  $i = 0;
  foreach( $social_networks as $network => $data ) {

    $network_compare = $social_networks_compare[$i];
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




function wfs_updated_complete( $upgrader_object, $options ) {
 // The path to our plugin's main file
 $our_plugin = plugin_basename( __FILE__ );
 // If an update has taken place and the updated type is plugins and the plugins element exists
 if( $options['action'] == 'update' && $options['type'] == 'plugin' && isset( $options['plugins'] ) ) {
  // Iterate through the plugins being updated and check if ours is there
  foreach( $options['plugins'] as $plugin ) {
   if( $plugin == $our_plugin ) {
    // Set a transient to record that our plugin has just been updated
    set_transient( 'wfs_updated', 1 );
   }
  }
 }
}
add_action( 'upgrader_process_complete', 'wfs_updated_complete', 10, 2 );