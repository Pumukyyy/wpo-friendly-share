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

  register_setting( 'wfs_config_section', 'wfs_f_url','wfs_sanitize_array_url' );
  register_setting( 'wfs_config_section', 'wfs_f_check','wfs_sanitize_array_f_check' );
  register_setting( 'wfs_config_section', 'wfs-f-custom-label', 'sanitize_text_field' );


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
        	<a target="_blank" rel="noopener noreferrer" href="https://github.com/Pumukyyy">
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