<?php 

// Si se llama directamente a este archivo, aborta.
defined( 'ABSPATH' ) or die( '¡Sin trampas!' );

/*
* Registro la hoja de estilos css en el admin solo en nuestro plugin
*/
add_action( 'admin_enqueue_scripts', 'wfs_admin_style' );

function wfs_admin_style($hook) {

  if($hook != 'settings_page_wpo-friendly-share' ) {

    return;

  }

  wp_register_style( 'wfs-admin-style', WFS_URI . '/css/wfs-admin-style.css' );
  wp_enqueue_style( 'wfs-admin-style' );

}

function wfs_admin_render() {
  ?>
    <div class="postbox">
      <h2 class="postbox-h2"><?php  _e( 'Botones para compartir en las redes sociales', 'wpo-friendly-share' ); ?></h2>
      <h3 class="postbox-h3"><?php _e( 'Selecciona  que redes mostrar para compartir', 'wpo-friendly-share' ) ?></h3>

      <div class="contenido-postbox">
        <div class="content-input">
          <!-- titulo share -->
          <div class="content-label-share">
            <label class="label-share">
              <p class="label-p"><?php  _e( 'Titulo de botones share personalizado', 'wpo-friendly-share' ); ?></p>
              <input type="text" class="input-share" name="wfs-share-custom-label" value="<?php echo esc_attr( get_option( 'wfs-share-custom-label' ) ); ?>" />
            </label>
          </div>

          <!-- Twitter -->
          <div class="content-label-share">
            <label class="label-share">
              <p class="label-share-p"><?php  _e( 'Nombre de usuario de Twitter (sin @)', 'wpo-friendly-share' ); ?></p>
              <input class="input-share" type="text" name="wfs-share-twitter-name" value="<?php echo esc_attr( get_option( 'wfs-share-twitter-name' ) ); ?>" />
            </label>
          </div>

          <!-- texto para compartir en whatsapp -->
          <div class="content-label-share">
            <label class="label-share">
              <p class="label-share-p"><?php  _e( 'Texto para compartir a traves de whatsapp', 'wpo-friendly-share' ); ?></p>
              <input class="input-share" type="text" name="wfs-share-whatsapp-txt" value="<?php echo esc_attr( get_option( 'wfs-share-whatsapp-txt' ) ); ?>" />
            </label>
          </div>

          <label class="checkbox-share">
            <span class="wfs-icon-social wfs-icon-twitter"></span>
            <input type="checkbox" name="wfs-share-twitter" value="1" <?php checked( 1, get_option( 'wfs-share-twitter' ), true ); ?> />
            Twitter
          </label>

          <!-- Facebook -->
          <label class="checkbox-share">
            <span class="wfs-icon-social wfs-icon-facebook"></span>
            <input type="checkbox" name="wfs-share-facebook" value="1" <?php checked( 1, get_option( 'wfs-share-facebook' ), true ); ?> />
            Facebook
          </label>

          <!-- Linkedin -->
          <label class="checkbox-share">
            <span class="wfs-icon-social wfs-icon-linkedin"></span> 
            <input type="checkbox" name="wfs-share-linkedin" value="1" <?php checked( 1, get_option( 'wfs-share-linkedin' ), true ); ?> />
            Linkedin
          </label>

          <!-- Buffer -->
          <label class="checkbox-share">
            <span class="wfs-icon-social wfs-icon-buffer"></span>
            <input type="checkbox" name="wfs-share-buffer" value="1" <?php checked( 1, get_option( 'wfs-share-buffer' ), true ); ?> /> 
            Buffer    
          </label>

          <!-- Pinterest -->
          <label class="checkbox-share">
            <span class="wfs-icon-social wfs-icon-pinterest"></span>
            <input type="checkbox" name="wfs-share-pinterest" value="1" <?php checked( 1, get_option( 'wfs-share-pinterest' ), true ); ?> />
            Pinterest
          </label>

          <!-- Whatsapp -->
          <label class="checkbox-share">
            <span class="wfs-icon-social wfs-icon-whatsapp"></span>
            <input type="checkbox" name="wfs-share-whatsapp" value="1" <?php checked( 1, get_option( 'wfs-share-whatsapp' ), true ); ?> />
            Whatsapp
          </label>

          <!-- Antes del post -->
          <span class="checkbox-ajustes">
            <label>
                <?php  _e( 'Quiero que aparezca al principio de cada post', 'wpo-friendly-share' ); ?>
                <input type="checkbox" name="wfs-options-before-post" value="1" <?php checked( 1, get_option( 'wfs-options-before-post' ), true ); ?> />
            </label>
          </span>
          <br />
          
          <!-- Despues del post -->
          <span class="checkbox-ajustes">
            <label>
                <?php  _e( 'Quiero que aparezca al final de cada post', 'wpo-friendly-share' ); ?>
                <input type="checkbox" name="wfs-options-after-post" value="1" <?php checked( 1, get_option( 'wfs-options-after-post' ), true ); ?> />
            </label>
          </span>
          <br />        
        </div>
        <div class="aside-postbox">
          <p>-<?php  _e( 'El titulo aparecera justo encima de los botones', 'wpo-friendly-share' ); ?></p>
          <p>-<?php  _e( 'El nombre de usuario de twitter se usara para indicar quien comparte en la url', 'wpo-friendly-share' ); ?></p>
          <p>-<?php  _e( 'El texto para compartir en whatsapp se mostrará como texto predifinido al enviar el mensaje', 'wpo-friendly-share' ); ?></p>
          <p>-<?php  _e( 'Hay que marcar las redes que quieres que aparezcan', 'wpo-friendly-share' ); ?></p>
          <p>-<?php  _e( 'Marca si quieres que aparezca antes del post, despues del post o ambos si no se marca ninguno no apareceran', 'wpo-friendly-share' ); ?></p>
          <p>-<?php  _e( 'Si prefieres añadirlo con shortcode añade este codigo donde queras que aparezca dentro del post', 'wpo-friendly-share' );echo '<b><br /> &#91;wfs_share&#93;</b><br />'; _e( 'O este otro si lo prefieres añadir desde la plantilla', 'wpo-friendly-share' ); echo '<br /><b>' . htmlentities("<?php if ( function_exists('wfs_share') ) {echo wfs_share();}?>", ENT_QUOTES)?></b></p>
        </div>
      </div>
    </div>

  <!-- BOTONES FOLLOW -->
    <div class="postbox">
      <h2 class="postbox-h2"><?php  _e( 'Botones buscanos en las redes sociales', 'wpo-friendly-share' ); ?></h2>
      <h3 class="postbox-h3"><?php _e( 'Escribe la url completa de tu perfil o pagina y selecciona  que redes mostrar para que te sigan', 'wpo-friendly-share' ) ?></h3>

      <div class="contenido-postbox">        
        <div class="content-input">
          <!-- Titulo follow-->
          <div class="content-label-follow">
            <label class="label-share follow">
              <p class="label-p"><?php  _e( 'Titulo de botones follow personalizado', 'wpo-friendly-share' ); ?></p>
              <input class="input-share" type="text" name="wfs-follow-custom-label" value="<?php echo esc_attr( get_option( 'wfs-follow-custom-label' ) ); ?>" />
            </label>
          </div>

          <!-- Facebook -->
          <div class="content-label-follow">
            <div class="border">
              <label class="checkbox-follow">
                <span class="wfs-icon-social wfs-icon-facebook"></span>
                <input type="checkbox" name="wfs-follow-checkbox-facebook" value="1" <?php checked( 1, get_option( 'wfs-follow-checkbox-facebook' ), true ); ?> />
                Facebook
              </label>
              <label class="label-url">
                <p class="border-p"><?php  _e( 'Url completa de tu fan page o perfil', 'wpo-friendly-share' ); ?></p>
                <input type="url" class="input-url" name="wfs-follow-url-facebook" placeholder="https://facebook.com/tu perfil"  value="<?php echo esc_url( get_option( 'wfs-follow-url-facebook' ) ); ?>" />
            </label>
            </div>
          </div>

          <!-- Twitter -->
          <div class="content-label-follow">
            <div class="border">
              <label class="checkbox-follow">
                <span class="wfs-icon-social wfs-icon-twitter"></span>
                <input type="checkbox" name="wfs-follow-checkbox-twitter" value="1" <?php checked( 1, get_option( 'wfs-follow-checkbox-twitter' ), true ); ?> />
                Twitter
              </label>
              <label class="label-url">
                <p class="border-p"><?php  _e( 'Url completa de tu pagina o perfil de twitter', 'wpo-friendly-share' ); ?></p>
                <input type="url" class="input-url" name="wfs-follow-url-twitter" placeholder="https://twitter.com/tu perfil"  value="<?php echo esc_url( get_option( 'wfs-follow-url-twitter' ) ); ?>" />
              </label>
            </div>
          </div>

          <!-- Linkedin -->
          <div class="content-label-follow">
            <div class="border">
              <label class="checkbox-follow">
                <span class="wfs-icon-social wfs-icon-linkedin"></span>
                <input type="checkbox" name="wfs-follow-checkbox-linkedin" value="1" <?php checked( 1, get_option( 'wfs-follow-checkbox-linkedin' ), true ); ?>  /> 
                Linkedin
              </label>
              <label class="label-url">
                <p class="border-p"><?php  _e( 'Url completa de tu pagina de Linkedin', 'wpo-friendly-share' ); ?></p>
                <input type="url" class="input-url" name="wfs-follow-url-linkedin" placeholder="https://Linkedin.com/tu perfil"  value="<?php  echo esc_url( get_option( 'wfs-follow-url-linkedin' ) );?>" />
              </label>
            </div>
          </div>

          <!-- Pinterest -->
          <div class="content-label-follow">
            <div class="border">
              <label class="checkbox-follow">
                <span class="wfs-icon-social wfs-icon-pinterest"></span>
                <input type="checkbox" name="wfs-follow-checkbox-pinterest" value="1" <?php checked( 1, get_option( 'wfs-follow-checkbox-pinterest' ), true ); ?> />
                Pinterest
              </label>
              <label class="label-url">
                <p class="border-p"><?php  _e( 'Url completa de tu pagina de Pinterest', 'wpo-friendly-share' ); ?></p>
                <input type="url" class="input-url" name="wfs-follow-url-pinterest" placeholder="https://pinterest.com/tu perfil"  value="<?php echo esc_url( get_option( 'wfs-follow-url-pinterest' ) ); ?>" />
              </label>
            </div>
          </div>

          <!-- Instagram -->
          <div class="content-label-follow">
            <div class="border">
              <label class="checkbox-follow">
                <span class="wfs-icon-social wfs-icon-instagram"></span>
                <input type="checkbox" name="wfs-follow-checkbox-instagram" value="1" <?php checked( 1, get_option( 'wfs-follow-checkbox-instagram' ), true ); ?> />
                Instagram
              </label>
              <label class="label-url">
                <p class="border-p"><?php  _e( 'Url completa de tu pagina de Instagram', 'wpo-friendly-share' ); ?></p>
                <input type="url" class="input-url" name="wfs-follow-url-instagram" placeholder="https://instagram.com/tu perfil"  value="<?php echo esc_url( get_option( 'wfs-follow-url-instagram' ) ); ?>" />
              </label>
            </div>
          </div>

          <!-- Youtube -->
          <div class="content-label-follow">
            <div class="border">
              <label class="checkbox-follow">
                <span class="wfs-icon-social wfs-icon-youtube"></span>
                <input type="checkbox" name="wfs-follow-checkbox-youtube" value="1" <?php checked( 1, get_option( 'wfs-follow-checkbox-youtube' ), true ); ?> />
                Youtube
              </label>
              <label class="label-url">
                  <p class="border-p"><?php  _e( 'Url completa de tu pagina de Youtube', 'wpo-friendly-share' ); ?></p>
              <input type="url" class="input-url" name="wfs-follow-url-youtube" placeholder="https://youtube.com/tu perfil"  value="<?php echo esc_url( get_option( 'wfs-follow-url-youtube' ) ); ?>" />
              </label>
            </div>
          </div>

          <!-- My Business -->
          <div class="content-label-follow">
            <div class="border">
              <label class="checkbox-follow">
                <span class="wfs-icon-social wfs-icon-mybusiness"></span>
                <input type="checkbox" name="wfs-follow-checkbox-myBusiness" value="1" <?php checked( 1, get_option( 'wfs-follow-checkbox-myBusiness' ), true ); ?> />
                My Business
              </label>

              <label class="label-url">
                <p class="border-p"><?php  _e( 'Url completa de tu pagina de My Business', 'wpo-friendly-share' ); ?></p>
                <input type="url" class="input-url" name="wfs-follow-url-myBusiness" placeholder="https://g.page/tu perfil"  value="<?php echo esc_url( get_option( 'wfs-follow-url-myBusiness' ) ); ?>" />
              </label>
            </div>
          </div>
        </div>
        <div class="aside-postbox">
          <p>-<?php  _e( 'El titulo aparecera justo encima de los botones', 'wpo-friendly-share' ); ?></p>
          <p>-<?php  _e( 'Tienes que poner la url completa de tu red social ejemplo https://www.red-social/tu-pagina-o-tu-perfil', 'wpo-friendly-share' ); ?></p>
          <p>-<?php  _e( 'Hay que marcar las redes que quieres que aparezcan si no estan marcadas no apareceran', 'wpo-friendly-share' ); ?></p>
          <p>-<?php  _e( '¿Como puedo añadir los botones follow con un shortcode?', 'wpo-friendly-share' ); echo '<br />';  _e( ' Añade este short code donde quieras que aparezca:', 'wpo-friendly-share' ); echo '<b><br /> &#91;wfs_follow&#93;</b>';?></p>
          <p>-<?php  _e( '¿Como añado los botones follow en la plantilla del tema?', 'wpo-friendly-share' ); echo '<br />'; _e( 'Añade este codigo en el lugar de la plantilla que quieres que aparectan los botones:', 'wpo-friendly-share' ); echo '<br /><b>' . htmlentities("<?php if ( function_exists('wfs_follow') ) {echo wfs_follow();}?>", ENT_QUOTES)?></b></p>
        </div>
      </div>
    </div>

    <!-- OPCIONES -->
    <div class="postbox">
      <h2 class="postbox-h2"><?php  _e( 'Ajustes avanzados', 'wpo-friendly-share' ); ?></h2>
      <h3 class="postbox-h3"><?php _e( 'Usa esta sección para optimizar mas este plugin', 'wpo-friendly-share' ) ?></h3>

      <div class="contenido-postbox">
        <div class="content-input">
          
          <!-- Style -->
          <span class="checkbox-ajustes">
            <label>
                <?php  _e( 'Desactivar css', 'wpo-friendly-share' );?>
                <input type="checkbox" name="wfs-options-css" value="1" <?php checked( 1, get_option( 'wfs-options-css' ), true );?> />
            </label>
          </span>
          <br />

          <!-- rel="nofollow" -->
          <span class="checkbox-ajustes">
            <label>
                <?php  _e( 'Añadir rel="nofollow" a todos los enlaces', 'wpo-friendly-share' ); ?>
                <input type="checkbox" name="wfs-options-rel-nofollow" value="1" <?php checked( 1, get_option( 'wfs-options-rel-nofollow' ), true ); ?> />
            </label>
          </span>
          <br />
            
          <!-- Añadir analytics o gtag -->    
          <div class="content-radio">
            <span class="checkbox-ajustes">
              <label>
                  <h3><?php  _e( 'Añadir evento Analytics', 'wpo-friendly-share' ); ?>
                  <input type="checkbox" name="wfs-options-analytics" value="1" <?php checked( 1, get_option( 'wfs-options-analytics' ), true ); ?> /></h3>
              </label>
            </span>
            <br />
            <?php  _e( 'Selecciona si usas las etiqueta ga o gtag', 'wpo-friendly-share' ); ?>
            <span class="checkbox-ajustes">
              <label>
                &nbsp;&nbsp;&nbsp;
                  <input type="radio" name="wfs-options-ga-gtag" value="gtag" <?php checked( 'gtag', get_option( 'wfs-options-ga-gtag' ), true ); ?> >
                  gtag
              </label>
            </span>
            <span class="checkbox-ajustes">
              <label>
                &nbsp;&nbsp;&nbsp;
                  <input type="radio" name="wfs-options-ga-gtag" value="ga" <?php checked( 'ga', get_option( 'wfs-options-ga-gtag' ), true ); ?> >
                  ga
              </label>
            </span>
          </div>
        </div>
        <div class="aside-postbox">
          <p>-<?php  _e( 'Si desactivas el el css asegurate de incluirlo en la hoja de estilos de tu tema de lo contrario e complemento puede romper su estilo ', 'wpo-friendly-share' ); ?></p>
          <p>-<?php  _e( 'Si esta activada, todo los enlaces tendran rel="nofollow"', 'wpo-friendly-share' ); ?></p>
          <p>-<?php  _e( 'Activa el evento analytics y selecciona que etiquetas usas en tu web ( para que esto funcione tienes que tener insertado el codigo de analytics )', 'wpo-friendly-share' ); ?></p>          
        </div>
      </div>
    </div>

  <div class="postbox">
    <h2 class="postbox-h2"><?php  _e( 'Ajustes para la desactivacion del plugin', 'wpo-friendly-share' ); ?></h2>
    <h3 class="postbox-h3"><?php _e( 'Usa esta sección SOLO si sabes lo que haces', 'wpo-friendly-share' ) ?></h3>

    <div class="contenido-postbox">
      <div class="content-input">
        <!-- Antes de desactivacion -->
        <span class="checkbox-ajustes">
          <label>
              <?php  _e( 'Quiero eliminar toda la configuarion de WPO Friendly Share al desactivar el plugin', 'wpo-friendly-share' ); ?>
              <input type="checkbox" name="wfs-options-delete-all" value="1" <?php checked( 1, get_option( 'wfs-options-delete-all' ), true ); ?> />
          </label>
        </span>
      </div>
      <div class="aside-postbox">
         <p><?php  _e( 'Si esta marcada esta opcion, al desactivar el plugin se eliminara toda la conficuracion', 'wpo-friendly-share' ); ?></p>
      </div>
    </div>
  </div>
 <?php
}