=== WPO friendly Share ===
Contributors: pumukyyy
Tags: botones para compartir, share,follow
Requires at least: 4.0
Tested up to: 5.2.3
Stable tag: 1.0.1
License: GNU General Public License v2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Simples botones para compartir o ser seguidos en las redes sin usar javascript!!

== Description ==
Botones que generan el enlace para compartir o ser seguidos en las principales redes sociales
sin usar javascript muy ligero y realmente veloz 
No necesita apenas configuracion, solo selecciona con que redes compartir y listo! 
Para que enlace a tus perfiles tienes que poner la url de tus perfiles en la configuracion del complemento

== Installation ==
1. Cargue los archivos del complemento en el directorio \'/ wp-content / plugins /wpo-friendly-share\', o instale el complemento a través de la pantalla de complementos de WordPress directamente.
2. Active el complemento a través de la pantalla \'Complementos\' en WordPress
1. Use la pantalla Configuración-> Ajustes->WPO friendly share para configurar el complemento

== Frequently Asked Questions ==
= ¿Como añado los botones share en la plantilla del tema? =
Añade este codigo en el lugar de la plantilla que quieres que aparectan los botones
if ( function_exists('wfs_share') ) {echo do_shortcode('[wfs_share]');
= ¿Como puedo añadirlos botones share con un short code? =
Añade este short code donde quieras que aparezca [wfs_share]
= ¿Como añado los botones follow en la plantilla del tema? =
Añade este codigo en el lugar de la plantilla que quieres que aparectan los botones
if ( function_exists('wfs_follow') ) {echo do_shortcode('[wfs_follow]');
= ¿Como puedo añadirlos botones follow con un short code? =
Añade este short code donde quieras que aparezca [wfs_follow]
= ¿Porque no me aparece nada si ya lo añadi con short code o en la plantilla? =
Primero tiene que haber algun boton seleccionado para que aparezca

== Screenshots ==

== Changelog ==
1.0.1
1.0.0

== Upgrade Notice ==
= 1.0.1 =
Recommended update for all users