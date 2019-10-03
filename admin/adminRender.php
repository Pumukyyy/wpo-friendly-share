<?php 
// Si se llama directamente a este archivo, aborta.
defined( 'ABSPATH' ) or die( '¡Sin trampas!' );

function wfs_admin_render(){ ?>

       <div class="postbox">
        <h2><?php  _e( 'Botones para compartir en las redes sociales ', 'wpo-friendly-share' ); ?></h2>
        <h3><?php _e( 'Selecciona  que redes mostrar para compartir', 'wpo-friendly-share' ) ?></h3>
        <div class="content_input">
            <!-- titulo share -->
            <div class="content_label">
                <label class="label_share">
                    <p class="label_p"><?php  _e( 'Titulo de botones share personalizado', 'wpo-friendly-share' ); ?></p>
                    <input type="text" name="wfs-share-custom-label" value="<?php echo esc_attr(get_option('wfs-share-custom-label')); ?>" />
                </label>
            </div>

            <!-- Twitter -->
            <div class="content_label">
                <label class="label_share">
                    <p><?php  _e( 'Nombre de usuario de Twitter (sin @)', 'wpo-friendly-share' ); ?></p>
                    <input type="text" name="botones-compartir-pmk-twitter-name" value="<?php echo esc_attr(get_option('botones-compartir-pmk-twitter-name')); ?>" />
                </label>
            </div>
            <label class="checkbox_share">
                <span class="wfs-icon-social wfs-icon-twitter"></span>
                <input type="checkbox" name="wfs-share-twitter" value="1" <?php checked(1, get_option('wfs-share-twitter'), true); ?> />
                Twitter
            </label>

            <!-- Facebook -->
            <label class="checkbox_share">
                <span class="wfs-icon-social wfs-icon-facebook"></span>
                <input type="checkbox" name="wfs-share-facebook" value="1" <?php checked(1, get_option('wfs-share-facebook'), true); ?> />
                Facebook
            </label>

            <!-- Linkedin -->
            <label class="checkbox_share">
                <span class="wfs-icon-social wfs-icon-linkedin"></span> 
                <input type="checkbox" name="wfs-share-linkedin" value="1" <?php checked(1, get_option('wfs-share-linkedin'), true); ?> />
                Linkedin
            </label>
     
            <!-- Buffer -->
            <label class="checkbox_share">
                <span class="wfs-icon-social wfs-icon-buffer"></span>
                <input type="checkbox" name="wfs-share-buffer" value="1" <?php checked(1, get_option('wfs-share-buffer'), true); ?> /> 
                Buffer    
            </label>

            <!-- Pinterest -->
            <label class="checkbox_share">
                <span class="wfs-icon-social wfs-icon-pinterest"></span>
                <input type="checkbox" name="wfs-share-pinterest" value="1" <?php checked(1, get_option('wfs-share-pinterest'), true); ?> />
                Pinterest
            </label>

            <!-- Email -->
            <!-- <label class="checkbox_share">
                <span class="wfs-icon-social wfs-icon-email"></span>
                <input type="checkbox" name="wfs-share-email" value="1" //checked(1, get_option('wfs-share-email'), true);  />
                Email
            </label> -->

            <!-- Whatsapp -->
            <label class="checkbox_share">
                <span class="wfs-icon-social wfs-icon-whatsapp"></span>
                <input type="checkbox" name="wfs-share-whatsapp" value="1" <?php checked(1, get_option('wfs-share-whatsapp'), true); ?> />
                Whatsapp
            </label>

            <!-- Instagram -->
            <!-- <label class="checkbox_share">
                <span class="wfs-icon-social wfs-icon-instagram"></span>
                <input type="checkbox" name="wfs-share-instagram" value="1"  //checked(1, get_option('wfs-share-instagram'), true);  />
                Whatsapp
            </label> -->            
        </div>
    </div>

<!-- botones follow -->

    <div class="postbox">
        <h2><?php  _e( 'Botones buscanos en las redes sociales', 'wpo-friendly-share' ); ?></h2>
        <h3><?php _e( 'Escribe la url completa de tu perfil o pagina y selecciona  que redes mostrar para que te sigan', 'wpo-friendly-share' ) ?></h3>
        
        <div class="content_input">
            <!-- Titulo follow-->
            <div class="content_label">
                <label class="label_share follow">
                    <p class="label_p"><?php  _e( 'Titulo de botones follow personalizado', 'wpo-friendly-share' ); ?></p>
                    <input type="text" name="wfs-follow-custom-label" value="<?php echo esc_attr(get_option('wfs-follow-custom-label')); ?>" />
                </label>
            </div>

            <!-- Facebook -->
            <div class="content_label">
                <div class="border">
                    <label class="label_checkbox_follow">
                        <span class="wfs-icon-social wfs-icon-facebook"></span>
                        <input type="checkbox" name="wfs-follow-checkbox-facebook" value="1" <?php checked(1, get_option('wfs-follow-checkbox-facebook'), true); ?> />
                        Facebook
                    </label>
                    <label class="label_url">
                        <p><?php  _e( 'url completa de tu fan page o perfil', 'wpo-friendly-share' ); ?></p>
                        <input type="url" name="wfs-follow-url-facebook" placeholder="https://facebook.com/tu perfil"  value="<?php echo esc_url(get_option('wfs-follow-url-facebook')); ?>" />
                    </label>
                </div>
            </div>

            <!-- Twitter -->
            <div class="content_label">
                <div class="border">
                    <label class="label_checkbox_follow">
                        <span class="wfs-icon-social wfs-icon-twitter"></span>
                        <input type="checkbox" name="wfs-follow-checkbox-twitter" value="1" <?php checked(1, get_option('wfs-follow-checkbox-twitter'), true); ?> />
                        Twitter
                    </label>
                    <label class="label_url">
                        <p><?php  _e( 'url completa de tu pagina o perfil de twitter', 'wpo-friendly-share' ); ?></p>
                        <input type="url" name="wfs-follow-url-twitter" placeholder="https://twitter.com/tu perfil"  value="<?php echo esc_url(get_option('wfs-follow-url-twitter')); ?>" />
                    </label>
                </div>
            </div>

            <!-- Linkedin -->
            <div class="content_label">
                <div class="border">
                    <label class="label_checkbox_follow">
                        <span class="wfs-icon-social wfs-icon-linkedin"></span>
                        <input type="checkbox" name="wfs-follow-checkbox-linkedin" value="1" <?php checked(1, get_option('wfs-follow-checkbox-linkedin'), true); ?>  /> 
                        Linkedin
                    </label>
                    <label class="label_url">
                        <p><?php  _e( 'url completa de tu pagina de Linkedin', 'wpo-friendly-share' ); ?></p>
                        <input type="url" name="wfs-follow-url-linkedin" placeholder="https://Linkedin.com/tu perfil"  value="<?php  echo esc_url(get_option('wfs-follow-url-linkedin'));?>" />
                    </label>
                </div>
            </div>

            <!-- Pinterest -->
            <div class="content_label">
                <div class="border">
                    <label class="label_checkbox_follow">
                        <span class="wfs-icon-social wfs-icon-pinterest"></span>
                        <input type="checkbox" name="wfs-follow-checkbox-pinterest" value="1" <?php checked(1, get_option('wfs-follow-checkbox-pinterest'), true); ?> />
                        Pinterest
                    </label>
                    <label class="label_url">
                        <p><?php  _e( 'url completa de tu pagina de Pinterest', 'wpo-friendly-share' ); ?></p>
                        <input type="url" name="wfs-follow-url-pinterest" placeholder="https://pinterest.com/tu perfil"  value="<?php echo esc_url(get_option('wfs-follow-url-pinterest')); ?>" />
                    </label>
                </div>
            </div>

            <!-- Instagram -->
            <div class="content_label">
                <div class="border">
                    <label class="label_checkbox_follow">
                        <span class="wfs-icon-social wfs-icon-instagram"></span>
                        <input type="checkbox" name="wfs-follow-checkbox-instagram" value="1" <?php checked(1, get_option('wfs-follow-checkbox-instagram'), true); ?> />
                        Instagram
                    </label>
                    <label class="label_url">
                        <p><?php  _e( 'url completa de tu pagina de Instagram', 'wpo-friendly-share' ); ?></p>
                        <input type="url" name="wfs-follow-url-instagram" placeholder="https://instagram.com/tu perfil"  value="<?php echo esc_url(get_option('wfs-follow-url-instagram')); ?>" />
                    </label>
                </div>
            </div>

            <!-- Youtube -->
            <div class="content_label">
                <div class="border">
                    <label class="label_checkbox_follow">
                        <span class="wfs-icon-social wfs-icon-youtube"></span>
                        <input type="checkbox" name="wfs-follow-checkbox-youtube" value="1" <?php checked(1, get_option('wfs-follow-checkbox-youtube'), true); ?> />
                        Youtube
                    </label>
                    <label class="label_url">
                        <p><?php  _e( 'url completa de tu pagina de Youtube', 'wpo-friendly-share' ); ?></p>
                    <input type="url" name="wfs-follow-url-youtube" placeholder="https://youtube.com/tu perfil"  value="<?php echo esc_url(get_option('wfs-follow-url-youtube')); ?>" />
                    </label>
                </div>
            </div>

            <!-- My Business -->
            <div class="content_label">
                <div class="border">
                    <label class="label_checkbox_follow">
                        <span class="wfs-icon-social wfs-icon-mybusiness"></span>
                        <input type="checkbox" name="wfs-follow-checkbox-myBusiness" value="1" <?php checked(1, get_option('wfs-follow-checkbox-myBusiness'), true); ?> />
                        My Business
                    </label>

                    <label class="label_url">
                        <p><?php  _e( 'url completa de tu pagina de My Business', 'wpo-friendly-share' ); ?></p>
                        <input type="url" name="wfs-follow-url-myBusiness" placeholder="https://youtube.com/tu perfil"  value="<?php echo esc_url(get_option('wfs-follow-url-myBusiness')); ?>" />
                    </label>
                </div>
            </div>
        </div>
    </div>

<!-- opciones -->

   <div class="postbox">
        <h2><?php  _e( 'Ajustes avanzados', 'wpo-friendly-share' ); ?></h2>
        <h3><?php _e( 'Usa esta sección para optimizar mas este plugin', 'wpo-friendly-share' ) ?></h3>


        <div class="content_input">
            <!-- Despues del post -->
            <span class="checkbox_ajustes">
                <label>
                    <?php  _e( 'NO quiero que aparezca al final de cada post', 'wpo-friendly-share' ); ?>
                    <input type="checkbox" name="wfs-options-after-post" value="1" <?php checked(1, get_option('wfs-options-after-post'), true); ?> />
                </label>
            </span>
            <br />
            
            <!-- Style -->
            <span class="checkbox_ajustes">
                <label>
                    <?php  _e( 'Desactivar css', 'wpo-friendly-share' );?>
                    <input type="checkbox" name="wfs-options-css" value="1" <?php checked(1, get_option('wfs-options-css'), true);?> />
                </label>
            </span>
            <br />

            <!-- rel="nofollow" -->
            <span class="checkbox_ajustes">
                <label>
                    <?php  _e( 'Añadir rel="nofollow" a todos los enlaces', 'wpo-friendly-share' ); ?>
                    <input type="checkbox" name="wfs-options-rel-nofollow" value="1" <?php checked(1, get_option('wfs-options-rel-nofollow'), true); ?> />
                </label>
            </span>
            <br />
            
            <!-- Añadir analytics o gtag -->    
            <div class="content-radio">
                <span class="checkbox_ajustes">
                    <label>
                        <h3><?php  _e( 'Añadir evento Analytics', 'wpo-friendly-share' ); ?>
                        <input type="checkbox" name="wfs-options-analytics" value="1" <?php checked(1, get_option('wfs-options-analytics'), true); ?> /></h3>
                    </label>
                </span>
                <br />
                <?php  _e( 'Selecciona si usas las etiqueta ga o gtag  ', 'wpo-friendly-share' ); ?>
                <span class="checkbox_ajustes">
                    <label>
                        <input type="radio" name="wfs-options-ga-gtag" value="gtag" <?php checked('gtag', get_option('wfs-options-ga-gtag'), true); ?> >
                        gtag
                    </label>
                </span>
                <span class="checkbox_ajustes">
                    <label>
                        <input type="radio" name="wfs-options-ga-gtag" value="ga" <?php checked('ga', get_option('wfs-options-ga-gtag'), true); ?> >
                        ga
                    </label>
                </span>
            </div>
<?php echo  get_option('wfs-options-ga-gtag'); ?>
        </div>
   </div>
   <?php
}