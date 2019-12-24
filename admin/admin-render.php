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

  wp_register_style( 'wfs-admin-style', WFS_URI . '/css/wfs-admin-style.css', '', WFS_VERSION );
  wp_enqueue_style( 'wfs-admin-style' );

}

function wfs_admin_render() {
  $wfs_s_txt = get_option( 'wfs_s_txt');
  ?>
    <div class="postbox">
      <h2 class="postbox-h2"><?php  _e( 'Buttons to share on social networks', 'wpo-friendly-share' ); ?></h2>
      <h3 class="postbox-h3"><?php _e( 'Select which social networks to show to share', 'wpo-friendly-share' ) ?></h3>

      <div class="contenido-postbox">
        <div class="content-input">
          <!-- titulo share -->
          <div class="content-label-share">
            <label class="label-share">
              <p class="label-p"><?php  _e( 'Custom title of the share button', 'wpo-friendly-share' ); ?></p>
              <input type="text" id="titleShare" class="input-share" name="wfs_s_txt[s-custom-label]"   value="<?php echo esc_attr( $wfs_s_txt['s-custom-label'] ); ?>" />
            </label>
          </div>
          <!-- Twitter -->
          <div class="content-label-share">
            <label class="label-share">
              <p class="label-share-p"><?php  _e( 'Twitter username (without @)', 'wpo-friendly-share' ); ?></p>
              <input class="input-share" type="text" name="wfs_s_txt[s-twitter-name]" value="<?php echo esc_attr( $wfs_s_txt['s-twitter-name'] ); ?>" />
            </label>
          </div>

          <!-- texto para compartir en whatsapp -->
          <div class="content-label-share">
            <label class="label-share">
              <p class="label-share-p"><?php  _e( 'Default text to share via WhatsApp', 'wpo-friendly-share' ); ?></p>
              <input class="input-share" type="text" name="wfs_s_txt[s-whatsapp-txt]" value="<?php echo esc_attr( $wfs_s_txt['s-whatsapp-txt'] ); ?>" />
            </label>
          </div>

          <!-- texto para compartir en telegram -->
          <div class="content-label-share">
            <label class="label-share">
              <p class="label-share-p"><?php  _e( 'Default text to share via Telegram', 'wpo-friendly-share' ); ?></p>
              <input class="input-share" type="text" name="wfs_s_txt[s-telegram-txt]" value="<?php echo esc_attr( $wfs_s_txt['s-telegram-txt'] ); ?>" />
            </label>
          </div>

          <?php $wfs_s_check = get_option( 'wfs_s_check'); ?>
          <!-- twitter -->
          <div class="content-iconos">
            <label class="checkbox-share">
              <span class="wfs-icon-social wfs-icon-twitter"></span>
              <input type="checkbox" class="select-share" name="wfs_s_check[s-check-twitter]" value="1" <?php checked( 1, $wfs_s_check['s-check-twitter'], true ); ?> />
              Twitter
            </label>

            <!-- Facebook -->
            <label class="checkbox-share">
              <span class="wfs-icon-social wfs-icon-facebook"></span>
              <input type="checkbox" class="select-share" name="wfs_s_check[s-check-facebook]" value="1" <?php checked( 1, $wfs_s_check['s-check-facebook'], true ); ?> />
              Facebook
            </label>

            <!-- Linkedin -->
            <label class="checkbox-share">
              <span class="wfs-icon-social wfs-icon-linkedin"></span> 
              <input type="checkbox" class="select-share" name="wfs_s_check[s-check-linkedin]" value="1" <?php checked( 1, $wfs_s_check['s-check-linkedin'], true ); ?> />
              Linkedin
            </label>

            <!-- Buffer -->
            <label class="checkbox-share">
              <span class="wfs-icon-social wfs-icon-buffer"></span>
              <input type="checkbox" class="select-share" name="wfs_s_check[s-check-buffer]" value="1" <?php checked( 1, $wfs_s_check['s-check-buffer'], true ); ?> /> 
              Buffer    
            </label>

            <!-- Pinterest -->
            <label class="checkbox-share">
              <span class="wfs-icon-social wfs-icon-pinterest"></span>
              <input type="checkbox" class="select-share" name="wfs_s_check[s-check-pinterest]" value="1" <?php checked( 1, $wfs_s_check['s-check-pinterest'], true ); ?> />
              Pinterest
            </label>

            <!-- Whatsapp -->
            <label class="checkbox-share">
              <span class="wfs-icon-social wfs-icon-whatsapp"></span>
              <input type="checkbox" class="select-share" name="wfs_s_check[s-check-whatsapp]" value="1" <?php checked( 1, $wfs_s_check['s-check-whatsapp'], true ); ?> />
              Whatsapp
            </label>

            <!-- Telegram -->
            <label class="checkbox-share">
              <span class="wfs-icon-social wfs-icon-telegram"></span>
              <input type="checkbox" class="select-share" name="wfs_s_check[s-check-telegram]" value="1" <?php checked( 1, $wfs_s_check['s-check-telegram'], true ); ?> />
              Telegram
            </label>
          </div>

          <!-- Antes del post -->
          <span class="checkbox-ajustes">
            <label>         
                <?php  _e( 'I want it to be show above the post', 'wpo-friendly-share' ); ?>
                <input type="checkbox" name="wfs_s_check[s-before-post]" value="1" <?php checked( 1, $wfs_s_check['s-before-post'], true ); ?> />
            </label>
          </span>
          
          <!-- Despues del post -->
          <span class="checkbox-ajustes">
            <label>
                <?php  _e( 'I want it to be show below the post', 'wpo-friendly-share' ); ?>
                <input type="checkbox" name="wfs_s_check[s-after-post]" value="1" <?php checked( 1, $wfs_s_check['s-after-post'], true ); ?> />
            </label>
          </span>
        </div>
        <div class="aside-postbox">
          <p>-<?php  _e( 'The title will be displayed just above the buttons, leave it empty if you don\'t want it to be displayed' ); ?></p>
          <p>-<?php  _e( 'The twitter username will be used to mention you when sharing. If you don\'t want it to be displayed, leave it empty', 'wpo-friendly-share' ); ?></p>
          <p>-<?php  _e( 'The text to share on whatsapp or Telegram will be shown as predefined text when sending the message, If you don\'t want it to be displayed leave it empty', 'wpo-friendly-share' ); ?></p>
          <p>-<?php  _e( 'You must mark the social networks you want to show', 'wpo-friendly-share' ); ?></p>
          <p>-<?php  _e( 'select if you want it to appear before publication, after publication or both, if it is not checked, it will not be displayed', 'wpo-friendly-share' ); ?></p>
          <p>-<?php  _e( 'If you prefer to insert it with shortcode, add this code within the post where you want it to be displayed', 'wpo-friendly-share' );echo '<b><br /> &#91;wfs_share&#93;</b><br />'; _e( 'Or this one if you prefer to add it from the template', 'wpo-friendly-share' ); echo '<br /><b>' . htmlentities("<?php if ( function_exists('wfs_share') ) {echo wfs_share();}?>", ENT_QUOTES)?></b></p>
        </div>
      </div>
    </div>

  <!-- BOTONES FOLLOW -->
    <div class="postbox">
      <h2 class="postbox-h2"><?php  _e( 'Buttons to follow you on social networks', 'wpo-friendly-share' ); ?></h2>
      <h3 class="postbox-h3"><?php _e( 'Type the complete url of your profile or page and select which social networks to display to follow you', 'wpo-friendly-share' ) ?></h3>

      <div class="contenido-postbox">        
        <div class="content-input">
          <!-- Titulo follow-->
          <div class="content-label-follow">
            <label class="label-share follow">
              <p class="label-p"><?php  _e( 'Custom follow button title', 'wpo-friendly-share' ); ?></p>
              <input class="input-share" type="text" id="titleFollow" name="wfs-f-custom-label" value="<?php echo esc_attr( get_option( 'wfs-f-custom-label' ) ); ?>" />
            </label>
          </div>

          <?php 
            $wfs_f_check = get_option( 'wfs_f_check'); 
            $wfs_f_url   = get_option( 'wfs_f_url'); 
          ?>
          <!-- Twitter -->
          <div class="content-label-follow">
            <div class="label-follow">
              <label class="checkbox-follow">
                <span class="wfs-icon-social wfs-icon-twitter"></span>
                <input type="checkbox" class="select-follow" name="wfs_f_check[f-check-twitter]" value="1" <?php checked( 1, $wfs_f_check['f-check-twitter'], true ); ?> />
                Twitter
              </label>
              <label class="label-url">
                <p class="label-follow-p"><?php  _e( 'Complete url of your page or Twitter profile', 'wpo-friendly-share' ); ?></p>
                <input type="url" class="input-url" name="wfs_f_url[f-url-twitter]" placeholder="https://twitter.com/tu perfil"  value="<?php echo esc_url( $wfs_f_url['f-url-twitter'] ); ?>" />
              </label>
            </div>
          </div>

          <!-- Facebook -->
          <div class="content-label-follow">
            <div class="label-follow">
              <label class="checkbox-follow">
                <span class="wfs-icon-social wfs-icon-facebook"></span>
                <input type="checkbox" class="select-follow" name="wfs_f_check[f-check-facebook]" value="1" <?php checked( 1, $wfs_f_check['f-check-facebook'], true ); ?> />
                Facebook
              </label>
              <label class="label-url">
                <p class="label-follow-p"><?php  _e( 'Complete url of your fan page or prifile', 'wpo-friendly-share' ); ?></p>
                <input type="url" class="input-url" name="wfs_f_url[f-url-facebook]" placeholder="https://facebook.com/tu perfil"  value="<?php echo esc_url( $wfs_f_url['f-url-facebook'] ); ?>" />
            </label>
            </div>
          </div>

          <!-- Linkedin -->
          <div class="content-label-follow">
            <div class="label-follow">
              <label class="checkbox-follow">
                <span class="wfs-icon-social wfs-icon-linkedin"></span>
                <input type="checkbox" class="select-follow" name="wfs_f_check[f-check-linkedin]" value="1" <?php checked( 1, $wfs_f_check['f-check-linkedin'], true ); ?>  /> 
                Linkedin
              </label>
              <label class="label-url">
                <p class="label-follow-p"><?php  _e( 'Complete url of your Likedin page', 'wpo-friendly-share' ); ?></p>
                <input type="url" class="input-url" name="wfs_f_url[f-url-linkedin]" placeholder="https://Linkedin.com/tu perfil"  value="<?php  echo esc_url( $wfs_f_url['f-url-linkedin'] );?>" />
              </label>
            </div>
          </div>

          <!-- Pinterest -->
          <div class="content-label-follow">
            <div class="label-follow">
              <label class="checkbox-follow">
                <span class="wfs-icon-social wfs-icon-pinterest"></span>
                <input type="checkbox" class="select-follow" name="wfs_f_check[f-check-pinterest]" value="1" <?php checked( 1, $wfs_f_check['f-check-pinterest'], true ); ?> />
                Pinterest
              </label>
              <label class="label-url">
                <p class="label-follow-p"><?php  _e( 'Complete url of your Pinterest page', 'wpo-friendly-share' ); ?></p>
                <input type="url" class="input-url" name="wfs_f_url[f-url-pinterest]" placeholder="https://pinterest.com/tu perfil"  value="<?php echo esc_url( $wfs_f_url['f-url-pinterest'] ); ?>" />
              </label>
            </div>
          </div>

          <!-- Telegram -->
          <div class="content-label-follow">
            <div class="label-follow">
              <label class="checkbox-follow">
                <span class="wfs-icon-social wfs-icon-telegram"></span>
                <input type="checkbox" class="select-follow" name="wfs_f_check[f-check-telegram]" value="1" <?php checked( 1, $wfs_f_check['f-check-telegram'], true ); ?> />
                Telegram
              </label>
              <label class="label-url">
                <p class="label-follow-p"><?php  _e( 'Complete url of your user', 'wpo-friendly-share' ); ?></p>
                <input type="url" class="input-url" name="wfs_f_url[f-url-telegram]" placeholder="https://t.me/tuUsuario"  value="<?php echo esc_url( $wfs_f_url['f-url-telegram'] ); ?>" />
              </label>
            </div>
          </div>

          <!-- Instagram -->
          <div class="content-label-follow">
            <div class="label-follow">
              <label class="checkbox-follow">
                <span class="wfs-icon-social wfs-icon-instagram"></span>
                <input type="checkbox" class="select-follow" name="wfs_f_check[f-check-instagram]" value="1" <?php checked( 1, $wfs_f_check['f-check-instagram'], true ); ?> />
                Instagram
              </label>
              <label class="label-url">
                <p class="label-follow-p"><?php  _e( 'Complete url of your Instagram page', 'wpo-friendly-share' ); ?></p>
                <input type="url" class="input-url" name="wfs_f_url[f-url-instagram]" placeholder="https://instagram.com/tu perfil"  value="<?php echo esc_url( $wfs_f_url['f-url-instagram'] ); ?>" />
              </label>
            </div>
          </div>

          <!-- Youtube -->
          <div class="content-label-follow">
            <div class="label-follow">
              <label class="checkbox-follow">
                <span class="wfs-icon-social wfs-icon-youtube"></span>
                <input type="checkbox" class="select-follow" name="wfs_f_check[f-check-youtube]" value="1" <?php checked( 1, $wfs_f_check['f-check-youtube'], true ); ?> />
                Youtube
              </label>
              <label class="label-url">
                  <p class="label-follow-p"><?php  _e( 'Complete url of your Youtube page', 'wpo-friendly-share' ); ?></p>
              <input type="url" class="input-url" name="wfs_f_url[f-url-youtube]" placeholder="https://youtube.com/tu perfil"  value="<?php echo esc_url( $wfs_f_url['f-url-youtube'] ); ?>" />
              </label>
            </div>
          </div>

          <!-- My Business -->
          <div class="content-label-follow">
            <div class="label-follow">
              <label class="checkbox-follow">
                <span class="wfs-icon-social wfs-icon-mybusiness"></span>
                <input type="checkbox" class="select-follow" name="wfs_f_check[f-check-myBusiness]" value="1" <?php checked( 1, $wfs_f_check['f-check-myBusiness'], true ); ?> />
                My Business
              </label>
              <label class="label-url">
                <p class="label-follow-p"><?php  _e( 'Complete url of your My Business page', 'wpo-friendly-share' ); ?></p>
                <input type="url" class="input-url" name="wfs_f_url[f-url-myBusiness]" placeholder="https://g.page/tu perfil"  value="<?php echo esc_url( $wfs_f_url['f-url-myBusiness'] ); ?>" />
              </label>
            </div>
          </div>
        </div>
        <div class="aside-postbox">
          <p>-<?php  _e( 'The title will be displayed just above the buttons, leave it empty if you don\'t want it to be displayed' ); ?></p>
          <p>-<?php  _e( 'You have to put the complete url of your social network example https: //www.social-network/your-page-or-profile', 'wpo-friendly-share' ); ?></p>
          <p>-<?php  _e( 'You must mark the social networks you want to show', 'wpo-friendly-share' ); ?></p>
          <p>-<?php  _e( 'How can I add the follow buttons with a shortcode?', 'wpo-friendly-share' ); echo '<br />';  _e( 'Add this short code where you want to show it:', 'wpo-friendly-share' ); echo '<b><br /> &#91;wfs_follow&#93;</b>';?></p>
          <p>-<?php  _e( 'How do I add the follow buttons in the theme template?', 'wpo-friendly-share' ); echo '<br />'; _e( 'Add this code in the place of the template that you want the buttons to display:', 'wpo-friendly-share' ); echo '<br /><b>' . htmlentities("<?php if ( function_exists('wfs_follow') ) {echo wfs_follow();}?>", ENT_QUOTES)?></b></p>
        </div>
      </div>
    </div>

    <!-- OPCIONES -->
    <?php $wfs_opt_check = get_option( 'wfs_opt_check' ); ?>
    <div class="postbox">
      <h2 class="postbox-h2"><?php  _e( 'Advanced settings', 'wpo-friendly-share' ); ?></h2>
      <h3 class="postbox-h3"><?php _e( 'Use this section to further optimize this plugin', 'wpo-friendly-share' ) ?></h3>

      <div class="contenido-postbox">
        <div class="content-input">
          
          <!-- Style -->
          <span class="checkbox-ajustes">
            <label>
                <?php  _e( 'Disable css', 'wpo-friendly-share' );?>
                <input type="checkbox" name="wfs_opt_check[css]" value="1" <?php checked( 1, $wfs_opt_check['css'], true );?> />
            </label>
          </span>
          <br />

          <!-- rel="nofollow" -->
          <span class="checkbox-ajustes">
            <label>
                <?php  _e( 'Add rel="nofollow" to all links', 'wpo-friendly-share' ); ?>
                <input type="checkbox" name="wfs_opt_check[rel-nofollow]" value="1" <?php checked( 1, $wfs_opt_check['rel-nofollow'], true ); ?> />
            </label>
          </span>
          <br />
            
          <!-- Añadir analytics o gtag -->    
          <div class="content-radio">
            <span class="checkbox-ajustes">
              <label>
                  <h3><?php  _e( 'Add Analytics event', 'wpo-friendly-share' ); ?>
                  <input type="checkbox" name="wfs_opt_check[analytics]" value="1" <?php checked( 1, $wfs_opt_check['analytics'], true ); ?> /></h3>
              </label>
            </span>
            <br />
            <?php  _e( 'Select if you use the ga or gtag tags', 'wpo-friendly-share' ); ?>
            <span class="checkbox-ajustes">
              <label>
                &nbsp;&nbsp;&nbsp;
                  <input type="radio" name="wfs_opt_ga_gtag" value="gtag" <?php checked( 'gtag', get_option( 'wfs_opt_ga_gtag' ), true ); ?> >
                  gtag
              </label>
            </span>
            <span class="checkbox-ajustes">
              <label>
                &nbsp;&nbsp;&nbsp;
                  <input type="radio" name="wfs_opt_ga_gtag" value="ga" <?php checked( 'ga', get_option( 'wfs_opt_ga_gtag' ), true ); ?> >
                  ga
              </label>
            </span>
          </div>
        </div>
        <div class="aside-postbox">
          <p>-<?php  _e( 'If you disable CSS, be sure to include it in the style sheet of your theme otherwise and the plugin may break your style', 'wpo-friendly-share' ); ?></p>
          <p>-<?php  _e( 'If activated, all links will have rel = "nofollow"', 'wpo-friendly-share' ); ?></p>
          <p>-<?php  _e( 'Activate the analytics event and select which tags you use on your website ( for this to work you have to have the analytics code inserted )', 'wpo-friendly-share' ); ?></p>          
        </div>
      </div>
    </div>

  <div class="postbox">
    <h2 class="postbox-h2"><?php  _e( 'Setting for plugin deactivation', 'wpo-friendly-share' ); ?></h2>
    <h3 class="postbox-h3"><?php _e( 'Use this section ONLY if you know what are you doing.', 'wpo-friendly-share' ) ?></h3>

    <div class="contenido-postbox">
      <div class="content-input">
        <!-- Antes de desactivacion -->
        <span class="checkbox-ajustes">
          <label>
              <?php  _e( 'I want to remove all WPO Friendly Share setting by deactivating the plugin', 'wpo-friendly-share' ); ?>
              <input type="checkbox" name="wfs_opt_check[delete-all]" value="1" <?php checked( 1, $wfs_opt_check['delete-all'], true ); ?> />
          </label>
        </span>
      </div>
      <div class="aside-postbox">
         <p><?php  _e( 'If this option is checked, deactivating the plug-in will remove all settings.', 'wpo-friendly-share' ); ?></p>
      </div>
    </div>
  </div>

 <?php
}