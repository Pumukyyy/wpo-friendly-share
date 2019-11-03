=== WPO friendly Share ===
Contributors: pumukyyy
Tags: translation ready, botones para compartir, share, follow, share button, follow button, seguir en las redes sociales, social buttons, Facebook, Linkedin, Instagram, Google My Business, Twitter, Pinterest, Youtube, Telegram, Whatsapp, Buffer
Requires at least: 4.0
Tested up to: 5.2.3
Stable tag: 1.0.4
Requires PHP: 5.2.4 or later
License: GNU General Public License v2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Simples botones para compartir o ser seguidos en las redes, lijero amigable para WPO y SEO

== Description ==
# WPO Friendly Share 
- La opcion mas simple y mas ligera de tener unos bonitos botones de las principales redes sociales

- Actualmente estan disponibles Facebook, Linkedin, Instagram, Google My Business, Twitter, Pinterest, Youtube, Telegram, Whatsapp y Buffer pero seguimos trabajando para incorporar nuesvas redes, si tiene alguna sujerencia escribenos en el foro de soporte 

- Botones que generan el enlace para compartir o ser seguidos en las principales redes sociales sin usar javascript muy ligero y realmente veloz

- Sin complicaciones no necesita apenas configuracion, para mostrar botones follow solo selecciona con que redes compartir y listo!

- Para que enlace a tus redes tienes que poner la url de tus perfiles en la configuracion del complemento 

- Usa datos estructurados schema.org buenos para el seo

- Translation ready, totalmente traducible a tu idioma preferido

- Si te gusta el plugin dejanos una reseña para ayudarnos a seguir creciendo


== Installation ==

**1** Cargue los archivos del complemento en el directorio '/ wp-content / plugins /wpo-friendly-share/', o instale el complemento a través de la pantalla de complementos de WordPress directamente.

**2**  Active el complemento a través de la pantalla \'Complementos\' en WordPress

**1** Use la pantalla Configuración -> Ajustes ->WPO friendly share para configurar el complemento

== Frequently Asked Questions ==

= - ¿Como añado los botones share en la plantilla del tema? =
Añade este codigo en el lugar de la plantilla que quieres que aparectan los botones `<?php if ( function_exists('wfs_share') ) {echo do_shortcode('[wfs_share]'); ?>`

= - ¿Como puedo añadirlos botones share con un short code? =
Añade este short code `[wfs_share]` donde quieras que aparezca 

= - ¿Como añado los botones follow en la plantilla del tema? =
Añade este codigo en el lugar de la plantilla que quieres que aparectan los botones`<?php if ( function_exists('wfs_follow') ) {echo do_shortcode('[wfs_follow]'); ?>`

= - ¿Como puedo añadirlos botones share con un short code? =
Añade este short code `[wfs_follow]` donde quieras que aparezca 

= - ¿Porque no me aparece nada si ya lo añadi con short code o en la plantilla? =
Primero tiene que haber algun boton seleccionado para que aparezcan

== Screenshots ==
1. Ajustes share
2. Ajustes follow
3. Ajustes avanzados
4. Ajustes de desactivacion

== Changelog ==

1.0.4

* - Añado telegram a la lista de compartir

* - Añado telegram a la lista de seguir 

* - Añado link a los ajustes del plugin

* - Mejoras de codificacion

* - Creo un filtro para el array de las redes sociales follow con las url y los select 'wsf_array_share_filter'

* - Creo un filtro con el contenedor y contenido de las redes sociales share 'wfs_content_share_filter'

* - Añado texto para compartir en telegran cargando uno por defecto si no hay ninguno definido

* - Creo un array con las url de las redes sociales follow

* - Creo un filtro para el array de las redes sociales follow con las url y los select 'wsf_array_follow_filter'

* - Creo un filtro con el contenedor y contenido de las redes sociales follow 'wfs_content_follow_filter'

* - Arreglo un fallo por el que se mostraba el titulo sin nada marcado al añadirlo mediante la funcion

1.0.3
* - Añadido opcion para agregar texto predefinido en negrita al conpartir en whatsapp 

* - Añadido nuevas traducciones a ingles es_US y español es_ES

* - Compruebo si es movil o web para whatsapp 

* - Añadido filtro wfs_share_end_filter para los botos share

* - Corrijo css para movil en el administrador

* - Añadido columnas con explicacion en cada seccion de la configuracion del plugin

1.0.2
* - Arreglo un fallo por el que nunca se mostraba los botones de follow en la plantilla public-render.php

1.0.1
* - Adapto el codigo php html y css a los estandares de WordPress

* - Añado funcion para eliminar las opciones creadas al desactivar el pluguin

1.0.0
* - Primera version 

== Upgrade Notice ==
= 1.0.2 =
Nuevo! ahora Telegram tambien esta disponible para compartir y seguir y mas mejoras!!!