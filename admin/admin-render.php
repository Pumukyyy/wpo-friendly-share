<?php 

// Si se llama directamente a este archivo, aborta.
defined( 'ABSPATH' ) or die( '¡Sin trampas!' );

/*
* Registro la hoja de estilos css en el admin solo en nuestro plugin
*/
add_action( 'admin_enqueue_scripts', 'wfs_admin_style' );

function wfs_admin_style($hook) {

  if( $hook != 'settings_page_wpo-friendly-share' ) {

    return;

  }

  wp_register_style( 'wfs-admin-style', WFS_URI . '/css/wfs-admin-style.css' );
  wp_enqueue_style( 'wfs-admin-style' );
  wp_enqueue_script( 'wfs-admin-js', WFS_URI .'js/wfs_admin_js.js');

}

function wfs_admin_render() {
  $wfs_share_custom  = get_option( 'wfs_share_custom');
  $wfs_follow_custom = get_option( 'wfs_follow_custom');
  ?>
    <div class="postbox">
      <h2 class="postbox-h2"><?php  _e( 'Buttons to share on social networks', 'wpo-friendly-share' ); ?></h2>
      <h3 class="postbox-h3"><?php _e( 'Select which social networks to show to share', 'wpo-friendly-share' ) ?></h3>

      <div class="contenido-postbox">
        <div class="content-input">
          <!-- titulo share -->
          <div class="content-label-share">
            <label class="label-share">
              <p class="label-p"><?php  _e( 'Custom share button title', 'wpo-friendly-share' ); ?></p>
              <input type="text" id="titleShare" class="input-share" name="wfs-share-custom-label" oninput="viewCustomShare();" value="<?php echo esc_attr( get_option( 'wfs-share-custom-label' ) ); ?>" />
            </label>
          </div>
          <!-- Twitter -->
          <div class="content-label-share">
            <label class="label-share">
              <p class="label-share-p"><?php  _e( 'Twitter username (without @)', 'wpo-friendly-share' ); ?></p>
              <input class="input-share" type="text" name="wfs-share-twitter-name" value="<?php echo esc_attr( get_option( 'wfs-share-twitter-name' ) ); ?>" />
            </label>
          </div>

          <!-- texto para compartir en whatsapp -->
          <div class="content-label-share">
            <label class="label-share">
              <p class="label-share-p"><?php  _e( 'Tex to share through Whatsapp', 'wpo-friendly-share' ); ?></p>
              <input class="input-share" type="text" name="wfs-share-whatsapp-txt" value="<?php echo esc_attr( get_option( 'wfs-share-whatsapp-txt' ) ); ?>" />
            </label>
          </div>

          <!-- texto para compartir en telegram -->
          <div class="content-label-share">
            <label class="label-share">
              <p class="label-share-p"><?php  _e( 'Tex to share through Telegram', 'wpo-friendly-share' ); ?></p>
              <input class="input-share" type="text" name="wfs-share-telegram-txt" value="<?php echo esc_attr( get_option( 'wfs-share-telegram-txt' ) ); ?>" />
            </label>
          </div>

          <div class="content-iconos">
            <label class="checkbox-share">
              <span class="wfs-icon-social wfs-icon-twitter"></span>
              <input type="checkbox" class="select-share" name="wfs-share-twitter" oninput="viewCustomShare();" value="1" <?php checked( 1, get_option( 'wfs-share-twitter' ), true ); ?> />
              Twitter
            </label>

            <!-- Facebook -->
            <label class="checkbox-share">
              <span class="wfs-icon-social wfs-icon-facebook"></span>
              <input type="checkbox" class="select-share" name="wfs-share-facebook" oninput="viewCustomShare();" value="1" <?php checked( 1, get_option( 'wfs-share-facebook' ), true ); ?> />
              Facebook
            </label>

            <!-- Linkedin -->
            <label class="checkbox-share">
              <span class="wfs-icon-social wfs-icon-linkedin"></span> 
              <input type="checkbox" class="select-share" name="wfs-share-linkedin" oninput="viewCustomShare();" value="1" <?php checked( 1, get_option( 'wfs-share-linkedin' ), true ); ?> />
              Linkedin
            </label>

            <!-- Buffer -->
            <label class="checkbox-share">
              <span class="wfs-icon-social wfs-icon-buffer"></span>
              <input type="checkbox" class="select-share" name="wfs-share-buffer" oninput="viewCustomShare();" value="1" <?php checked( 1, get_option( 'wfs-share-buffer' ), true ); ?> /> 
              Buffer    
            </label>

            <!-- Pinterest -->
            <label class="checkbox-share">
              <span class="wfs-icon-social wfs-icon-pinterest"></span>
              <input type="checkbox" class="select-share" name="wfs-share-pinterest" oninput="viewCustomShare();" value="1" <?php checked( 1, get_option( 'wfs-share-pinterest' ), true ); ?> />
              Pinterest
            </label>

            <!-- Whatsapp -->
            <label class="checkbox-share">
              <span class="wfs-icon-social wfs-icon-whatsapp"></span>
              <input type="checkbox" class="select-share" name="wfs-share-whatsapp" oninput="viewCustomShare();" value="1" <?php checked( 1, get_option( 'wfs-share-whatsapp' ), true ); ?> />
              Whatsapp
            </label>

            <!-- Telegram -->
            <label class="checkbox-share">
              <span class="wfs-icon-social wfs-icon-telegram"></span>
              <input type="checkbox" class="select-share" name="wfs-share-telegram" oninput="viewCustomShare();" value="1" <?php checked( 1, get_option( 'wfs-share-telegram' ), true ); ?> />
              Telegram
            </label>
          </div>

          <!-- Antes del post -->
          <span class="checkbox-ajustes">
            <label>         
                <?php  _e( 'I want it to be show above the post', 'wpo-friendly-share' ); ?>
                <input type="checkbox" name="wfs-options-before-post" value="1" <?php checked( 1, get_option( 'wfs-options-before-post' ), true ); ?> />
            </label>
          </span>
          
          <!-- Despues del post -->
          <span class="checkbox-ajustes">
            <label>
                <?php  _e( 'I want it to be show below the post', 'wpo-friendly-share' ); ?>
                <input type="checkbox" name="wfs-options-after-post" value="1" <?php checked( 1, get_option( 'wfs-options-after-post' ), true ); ?> />
            </label>
          </span>

          <!-- check para personalizacion -->
          <span class="checkbox-ajustes">
            <label class="custom-option" >
                <?php wfs_switch_text( 'share' ) ?>
                <input type="checkbox" style="display:none;" id="optionsCustomShare" name="wfs_options_custom_share" oninput="optionsCustomS();" value="1" <?php checked( 1, get_option( 'wfs_options_custom_share' ), true ); ?> />
            </label>
          </span>
          <div class="content-config-iconos <?php wfs_add_class_oculto('share')?>" id="entryCustomShare">
            <label class="label-share content-custom">
              <p class="label-share-p"><?php  _e( 'Personaliza tus iconos', 'wpo-friendly-share' ) ?></p>
              <div class="config-iconos">

                <!-- color titulo share -->
                <span class="checkbox-custom">
                  <label>
                      <?php  _e( 'Elige un color para el titulo', 'wpo-friendly-share' );?>
                      <input type="color" id="colorTitleShare" name="wfs_share_custom[color-title]" oninput="viewCustomShare();" value="<?php if( empty($wfs_share_custom['color-title']) ){echo '#808080';}else{echo esc_attr( $wfs_share_custom['color-title'] );} ?>"/>
                  </label>
                </span>

                 <!-- tamaño iconos share -->
                 <span class="checkbox-custom">
                  <label>
                      <?php  _e( 'Tamaño del titulo', 'wpo-friendly-share' );?>
                      <input type="range" id="titleSizeShare" name="wfs_share_custom[size-title]" min="20" max="60" oninput="viewCustomShare();" value="<?php echo esc_attr( $wfs_share_custom['size-title']  ); ?>" step="1">
                  </label>
                </span>

                <!-- sin color de fondo share -->
                 <span class="checkbox-custom">
                  <label>
                      <?php  _e( 'No quiero color de fondo', 'wpo-friendly-share' );?>
                      <input type="checkbox" id="sinBgShare" name="wfs-share-background-none" oninput="viewCustomShare();" value="1" <?php checked( 1, get_option( 'wfs-share-background-none' ), true ); ?> />
                  </label>
                </span> <?php  ?>

                <!-- color de fondo share -->
                <span class="checkbox-custom">
                  <label>
                      <?php  _e( 'Elige un color de fondo', 'wpo-friendly-share' );?>
                      <input type="color" id="bgColorShare" name="wfs_share_custom[bg-color]" oninput="viewCustomShare();" value="<?php if( empty($wfs_share_custom['bg-color']) ){echo '#808080';}else{echo esc_attr( $wfs_share_custom['bg-color'] );} ?>"/>
                  </label>
                </span>

                <!-- color iconos share -->
                <span class="checkbox-custom">
                  <label>
                      <?php  _e( 'Elige un color para los iconos', 'wpo-friendly-share' );?>
                      <input type="color" id="colorShare" name="wfs_share_custom[color]" oninput="viewCustomShare();" value="<?php if( empty($wfs_share_custom['color']) ){echo '#f4f4f4';}else{echo esc_attr( $wfs_share_custom['color'] );} ?>"/>
                  </label>
                </span>

                <!-- border radius iconos share -->
                <span class="checkbox-custom">
                  <label>
                      <?php  _e( 'Bordes redondeados', 'wpo-friendly-share' );?>
                      <input type="range" id="bdRadiusShare" name="wfs_share_custom[b-radius]" min="0" max="50" oninput="viewCustomShare();" value="<?php echo esc_attr(  $wfs_share_custom['b-radius'] ); ?>">  
                  </label>
                </span>
                
                 <!-- tamaño iconos share -->
                 <span class="checkbox-custom">
                  <label>
                      <?php  _e( 'Tamaño del icono', 'wpo-friendly-share' );?>
                      <input type="range" id="widthShare" name="wfs_share_custom[width]" min="20" max="60" oninput="viewCustomShare();" value="<?php echo esc_attr( $wfs_share_custom['width'] ); ?>" step="1">
                  </label>
                </span>
              </div>
              <?php wfs_custom_result( 'share' ) ?>
            </label>
          </div>
        </div>
        <div class="aside-postbox">
          <p>-<?php  _e( 'The title will appear just above the buttons' ); ?></p>
          <p>-<?php  _e( 'The twitter username will be used to mention you when sharing', 'wpo-friendly-share' ); ?></p>
          <p>-<?php  _e( 'The text to share on whatsapp will be shown as predefined text when sending the message', 'wpo-friendly-share' ); ?></p>
          <p>-<?php  _e( 'You have to mark the social networks you want to appear', 'wpo-friendly-share' ); ?></p>
          <p>-<?php  _e( '"Mark if you want it to appear before the post, after the post or both if it is not marked none will appear', 'wpo-friendly-share' ); ?></p>
          <p>-<?php  _e( 'If you prefer to add it with shortcode add this code where you want it to appear inside the post', 'wpo-friendly-share' );echo '<b><br /> &#91;wfs_share&#93;</b><br />'; _e( 'Or this one if you prefer to add it from the template', 'wpo-friendly-share' ); echo '<br /><b>' . htmlentities("<?php if ( function_exists('wfs_share') ) {echo wfs_share();}?>", ENT_QUOTES)?></b></p>
        </div>
      </div>
    </div>

  <!-- BOTONES FOLLOW -->
    <div class="postbox">
      <h2 class="postbox-h2"><?php  _e( 'Buttons follow me on social networks', 'wpo-friendly-share' ); ?></h2>
      <h3 class="postbox-h3"><?php _e( 'Type the complete url of your profile or page and select which social networks to display to follow you', 'wpo-friendly-share' ) ?></h3>

      <div class="contenido-postbox">        
        <div class="content-input">

          <!-- Titulo follow-->
          <div class="content-label-follow">
            <label class="label-share follow">
              <p class="label-p"><?php  _e( 'Custom follow button title', 'wpo-friendly-share' ); ?></p>
              <input class="input-share" type="text" id="titleFollow" name="wfs-follow-custom-label" oninput="viewCustomFollow();" value="<?php echo esc_attr( get_option( 'wfs-follow-custom-label' ) ); ?>" />
            </label>
          </div>

          <!-- Twitter -->
          <div class="content-label-follow">
            <div class="label-follow">
              <label class="checkbox-follow">
                <span class="wfs-icon-social wfs-icon-twitter"></span>
                <input type="checkbox" class="select-follow" name="wfs-follow-checkbox-twitter" oninput="viewCustomFollow();" value="1" <?php checked( 1, get_option( 'wfs-follow-checkbox-twitter' ), true ); ?> />
                Twitter
              </label>
              <label class="label-url">
                <p class="label-follow-p"><?php  _e( 'Complete url of your page or Twitter profile', 'wpo-friendly-share' ); ?></p>
                <input type="url" class="input-url" name="wfs-follow-url-twitter" placeholder="https://twitter.com/tu perfil"  value="<?php echo esc_url( get_option( 'wfs-follow-url-twitter' ) ); ?>" />
              </label>
            </div>
          </div>

          <!-- Facebook -->
          <div class="content-label-follow">
            <div class="label-follow">
              <label class="checkbox-follow">
                <span class="wfs-icon-social wfs-icon-facebook"></span>
                <input type="checkbox" class="select-follow" name="wfs-follow-checkbox-facebook" oninput="viewCustomFollow();" value="1" <?php checked( 1, get_option( 'wfs-follow-checkbox-facebook' ), true ); ?> />
                Facebook
              </label>
              <label class="label-url">
                <p class="label-follow-p"><?php  _e( 'Complete url of your fan page or prifile', 'wpo-friendly-share' ); ?></p>
                <input type="url" class="input-url" name="wfs-follow-url-facebook" placeholder="https://facebook.com/tu perfil"  value="<?php echo esc_url( get_option( 'wfs-follow-url-facebook' ) ); ?>" />
            </label>
            </div>
          </div>

          <!-- Linkedin -->
          <div class="content-label-follow">
            <div class="label-follow">
              <label class="checkbox-follow">
                <span class="wfs-icon-social wfs-icon-linkedin"></span>
                <input type="checkbox" class="select-follow" name="wfs-follow-checkbox-linkedin" oninput="viewCustomFollow();" value="1" <?php checked( 1, get_option( 'wfs-follow-checkbox-linkedin' ), true ); ?>  /> 
                Linkedin
              </label>
              <label class="label-url">
                <p class="label-follow-p"><?php  _e( 'Complete url of your Likedin page', 'wpo-friendly-share' ); ?></p>
                <input type="url" class="input-url" name="wfs-follow-url-linkedin" placeholder="https://Linkedin.com/tu perfil"  value="<?php  echo esc_url( get_option( 'wfs-follow-url-linkedin' ) );?>" />
              </label>
            </div>
          </div>

          <!-- Pinterest -->
          <div class="content-label-follow">
            <div class="label-follow">
              <label class="checkbox-follow">
                <span class="wfs-icon-social wfs-icon-pinterest"></span>
                <input type="checkbox" class="select-follow" name="wfs-follow-checkbox-pinterest" oninput="viewCustomFollow();" value="1" <?php checked( 1, get_option( 'wfs-follow-checkbox-pinterest' ), true ); ?> />
                Pinterest
              </label>
              <label class="label-url">
                <p class="label-follow-p"><?php  _e( 'Complete url of your Pinterest page', 'wpo-friendly-share' ); ?></p>
                <input type="url" class="input-url" name="wfs-follow-url-pinterest" placeholder="https://pinterest.com/tu perfil"  value="<?php echo esc_url( get_option( 'wfs-follow-url-pinterest' ) ); ?>" />
              </label>
            </div>
          </div>

          <!-- Telegram -->
          <div class="content-label-follow">
            <div class="label-follow">
              <label class="checkbox-follow">
                <span class="wfs-icon-social wfs-icon-telegram"></span>
                <input type="checkbox" class="select-follow" name="wfs-follow-checkbox-telegram" oninput="viewCustomFollow();" value="1" <?php checked( 1, get_option( 'wfs-follow-checkbox-telegram' ), true ); ?> />
                Telegram
              </label>
              <label class="label-url">
                <p class="label-follow-p"><?php  _e( 'Complete url of your user', 'wpo-friendly-share' ); ?></p>
                <input type="url" class="input-url" name="wfs-follow-url-telegram" placeholder="https://t.me/tuUsuario"  value="<?php echo esc_url( get_option( 'wfs-follow-url-telegram' ) ); ?>" />
              </label>
            </div>
          </div>

          <!-- Instagram -->
          <div class="content-label-follow">
            <div class="label-follow">
              <label class="checkbox-follow">
                <span class="wfs-icon-social wfs-icon-instagram"></span>
                <input type="checkbox" class="select-follow" name="wfs-follow-checkbox-instagram" oninput="viewCustomFollow();" value="1" <?php checked( 1, get_option( 'wfs-follow-checkbox-instagram' ), true ); ?> />
                Instagram
              </label>
              <label class="label-url">
                <p class="label-follow-p"><?php  _e( 'Complete url of your Instagram page', 'wpo-friendly-share' ); ?></p>
                <input type="url" class="input-url" name="wfs-follow-url-instagram" placeholder="https://instagram.com/tu perfil"  value="<?php echo esc_url( get_option( 'wfs-follow-url-instagram' ) ); ?>" />
              </label>
            </div>
          </div>

          <!-- Youtube -->
          <div class="content-label-follow">
            <div class="label-follow">
              <label class="checkbox-follow">
                <span class="wfs-icon-social wfs-icon-youtube"></span>
                <input type="checkbox" class="select-follow" name="wfs-follow-checkbox-youtube" oninput="viewCustomFollow();" value="1" <?php checked( 1, get_option( 'wfs-follow-checkbox-youtube' ), true ); ?> />
                Youtube
              </label>
              <label class="label-url">
                  <p class="label-follow-p"><?php  _e( 'Complete url of your Youtube page', 'wpo-friendly-share' ); ?></p>
              <input type="url" class="input-url" name="wfs-follow-url-youtube" placeholder="https://youtube.com/tu perfil"  value="<?php echo esc_url( get_option( 'wfs-follow-url-youtube' ) ); ?>" />
              </label>
            </div>
          </div>

          <!-- My Business -->
          <div class="content-label-follow">
            <div class="label-follow">
              <label class="checkbox-follow">
                <span class="wfs-icon-social wfs-icon-mybusiness"></span>
                <input type="checkbox" class="select-follow" name="wfs-follow-checkbox-myBusiness" oninput="viewCustomFollow();" value="1" <?php checked( 1, get_option( 'wfs-follow-checkbox-myBusiness' ), true ); ?> />
                My Business
              </label>
              <label class="label-url">
                <p class="label-follow-p"><?php  _e( 'Complete url of your My Business page', 'wpo-friendly-share' ); ?></p>
                <input type="url" class="input-url" name="wfs-follow-url-myBusiness" placeholder="https://g.page/tu perfil"  value="<?php echo esc_url( get_option( 'wfs-follow-url-myBusiness' ) ); ?>" />
              </label>
            </div>
          </div>

          <!-- check para personalizacion -->
          <span class="checkbox-ajustes">
            <label class="custom-option">
                <?php wfs_switch_text( 'follow' ) ?>
                <input type="checkbox" style="display:none;" id="optionsCustomFollow" name="wfs_options_custom_follow" oninput="optionsCustomF();" value="1" <?php checked( 1, get_option( 'wfs_options_custom_follow' ), true ); ?> />
            </label>
          </span>

          <div class="content-config-iconos <?php wfs_add_class_oculto('follow')?>" id="entryCustomFollow">
            <label class="label-follow content-custom">
              <p class="label-share-p"><?php  _e( 'Personaliza tus iconos', 'wpo-friendly-share' ) ?></p>
              <div class="config-iconos">

                 <!-- color titulo follow -->
                <span class="checkbox-custom">
                  <label>
                      <?php  _e( 'Elige un color para el titulo', 'wpo-friendly-share' );?>
                      <input type="color" id="colorTitleFollow" name="wfs_follow_custom[color-title]" oninput="viewCustomFollow();" value="<?php if( empty($wfs_follow_custom['color-title']) ){echo '#808080';}else{echo esc_attr( $wfs_follow_custom['color-title'] );} ?>"/>
                  </label>
                </span>

                 <!-- tamaño iconos follow -->
                 <span class="checkbox-custom">
                  <label>
                      <?php  _e( 'Tamaño del titulo', 'wpo-friendly-share' );?>
                      <input type="range" id="titleSizeFollow" name="wfs_follow_custom[size-title]" min="20" max="60" oninput="viewCustomFollow();" value="<?php echo esc_attr( $wfs_follow_custom['size-title'] ); ?>" step="1">
                  </label>
                </span>

                <!-- sin color de fondo follow -->
                 <span class="checkbox-ajustes">
                  <label>
                      <?php  _e( 'No quiero color de fondo', 'wpo-friendly-share' );?>
                      <input type="checkbox" id="sinBgFollow" name="wfs-follow-background-none" oninput="viewCustomFollow();" value="1" <?php checked( 1, get_option( 'wfs-follow-background-none' ), true ); ?> />
                  </label>
                </span>

                <!-- color de fondo follow -->
                <span class="checkbox-ajustes">
                  <label>
                      <?php  _e( 'Elige un color de fondo', 'wpo-friendly-share' );?>
                      <input type="color" id="bgColorFollow" name="wfs_follow_custom[bg-color]" oninput="viewCustomFollow();" value="<?php if( empty($wfs_follow_custom['bg-color']) ){echo '#808080';}else{echo esc_attr( $wfs_follow_custom['bg-color'] );} ?>"/>
                  </label>
                </span>        

                <!-- color iconos follow -->
                <span class="checkbox-ajustes">
                  <label>
                      <?php  _e( 'Elige un color para los iconos', 'wpo-friendly-share' );?>
                      <input type="color" id="colorFollow"  name="wfs_follow_custom[color]" oninput="viewCustomFollow();" value="<?php if( empty($wfs_follow_custom['color']) ){echo '#f4f4f4';}else{echo esc_attr( $wfs_follow_custom['color'] );} ?>"/>
                  </label>
                </span>

                <!-- border radius iconos follow -->
                <span class="checkbox-ajustes">
                  <label>
                      <?php  _e( 'Bordes redondeados', 'wpo-friendly-share' );?>
                      <input type="range"  id="bdRadiusFollow" name="wfs_follow_custom[b-radius]" min="0" max="50" oninput="viewCustomFollow();" value="<?php echo esc_attr( $wfs_follow_custom['b-radius'] ); ?>" step="1">
                  </label>
                </span> 
                
                 <!-- tamaño iconos follow -->
                 <span class="checkbox-ajustes">
                  <label>
                      <?php  _e( 'Tamaño del icono', 'wpo-friendly-share' );?>
                      <input type="range" id="widthFollow" name="wfs_follow_custom[width]" min="25" max="60" oninput="viewCustomFollow();" value="<?php echo esc_attr( $wfs_follow_custom['width'] ); ?>" step="1">
                  </label>
                </span>
              </div>
              <?php wfs_custom_result( 'follow' )?>
            </label>
          </div>
        </div>
        <div class="aside-postbox">
          <p>-<?php  _e( 'The title will appear just above the buttons', 'wpo-friendly-share' ); ?></p>
          <p>-<?php  _e( 'You have to put the complete url of your social network example https: //www.social-network/your-page-or-profile', 'wpo-friendly-share' ); ?></p>
          <p>-<?php  _e( 'You have to mark the social networks you want to appear if they are not marked will not appear', 'wpo-friendly-share' ); ?></p>
          <p>-<?php  _e( 'How can I add the follow buttons with a shortcode?', 'wpo-friendly-share' ); echo '<br />';  _e( 'Add this short code where you want it to appear:', 'wpo-friendly-share' ); echo '<b><br /> &#91;wfs_follow&#93;</b>';?></p>
          <p>-<?php  _e( 'How do I add the follow buttons in the theme template?', 'wpo-friendly-share' ); echo '<br />'; _e( 'Add this code in the place of the template that you want the buttons to appear:', 'wpo-friendly-share' ); echo '<br /><b>' . htmlentities("<?php if ( function_exists('wfs_follow') ) {echo wfs_follow();}?>", ENT_QUOTES)?></b></p>
        </div>
      </div>
    </div>

    <!-- OPCIONES -->
    <div class="postbox">
      <h2 class="postbox-h2"><?php  _e( 'Advanced settings', 'wpo-friendly-share' ); ?></h2>
      <h3 class="postbox-h3"><?php _e( 'Use this section to further optimize this plugin', 'wpo-friendly-share' ) ?></h3>

      <div class="contenido-postbox">
        <div class="content-input">
          
          <!-- Style -->
          <span class="checkbox-ajustes">
            <label>
                <?php  _e( 'Disable css', 'wpo-friendly-share' );?>
                <input type="checkbox" name="wfs-options-css" value="1" <?php checked( 1, get_option( 'wfs-options-css' ), true );?> />
            </label>
          </span>
          <br />

          <!-- rel="nofollow" -->
          <span class="checkbox-ajustes">
            <label>
                <?php  _e( 'Add rel="nofollow" to all links', 'wpo-friendly-share' ); ?>
                <input type="checkbox" name="wfs-options-rel-nofollow" value="1" <?php checked( 1, get_option( 'wfs-options-rel-nofollow' ), true ); ?> />
            </label>
          </span>
          <br />
            
          <!-- Añadir analytics o gtag -->    
          <div class="content-radio">
            <span class="checkbox-ajustes">
              <label>
                  <h3><?php  _e( 'Add Analytics event', 'wpo-friendly-share' ); ?>
                  <input type="checkbox" name="wfs-options-analytics" value="1" <?php checked( 1, get_option( 'wfs-options-analytics' ), true ); ?> /></h3>
              </label>
            </span>
            <br />
            <?php  _e( 'Select if you use the ga or gtag tags', 'wpo-friendly-share' ); ?>
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
          <p>-<?php  _e( 'If you disable the css make sure to include it in the style sheet of your theme otherwise and complement can break your style', 'wpo-friendly-share' ); ?></p>
          <p>-<?php  _e( 'If activated, all links will have rel = "nofollow"', 'wpo-friendly-share' ); ?></p>
          <p>-<?php  _e( 'Activate the analytics event and select which tags you use on your website ( for this to work you have to have the analytics code inserted )', 'wpo-friendly-share' ); ?></p>          
        </div>
      </div>
    </div>

  <div class="postbox">
    <h2 class="postbox-h2"><?php  _e( 'Setting for plugin deactivation', 'wpo-friendly-share' ); ?></h2>
    <h3 class="postbox-h3"><?php _e( 'Use this section ONLY if you know what you do', 'wpo-friendly-share' ) ?></h3>

    <div class="contenido-postbox">
      <div class="content-input">
        <!-- Antes de desactivacion -->
        <span class="checkbox-ajustes">
          <label>
              <?php  _e( 'I want to remove all WPO Friendly Share setting by deactivating the plugin', 'wpo-friendly-share' ); ?>
              <input type="checkbox" name="wfs-options-delete-all" value="1" <?php checked( 1, get_option( 'wfs-options-delete-all' ), true ); ?> />
          </label>
        </span>
      </div>
      <div class="aside-postbox">
         <p><?php  _e( 'If this option is checked, deactivating the plugin will eliminate all conficuracion', 'wpo-friendly-share' ); ?></p>
      </div>
    </div>
  </div>

 <?php
}