![Pmk Web Dev](https://pmkchapaypintura.com/wp-content/uploads/2019/10/pmkWebDevLogo-e1570485919571.png "Pmk Web Dev")      **By Pmk Web Dev**
# WPO Friendly Share  V 1.0.2
## Descripción

- Botones que generan el enlace para compartir o ser seguidos en las principales redes sociales sin usar javascript muy ligero y realmente veloz

- No necesita apenas configuracion, para mostrar botones follow solo selecciona con que redes compartir y listo!

- Para que enlace a tus redes tienes que poner la url de tus perfiles en la configuracion del complemento 

## instalacion

**1** Cargue los archivos del complemento en el directorio '/ wp-content / plugins /wpo-friendly-share/', o instale el complemento a través de la pantalla de complementos de WordPress directamente.

**2**  Active el complemento a través de la pantalla \'Complementos\' en WordPress

**1** Use la pantalla Configuración -> Ajustes ->WPO friendly share para configurar el complemento



## Preguntas frecuentes
- ¿Como añado los botones share en la plantilla del tema? 
Añade este codigo en el lugar de la plantilla que quieres que aparectan los botones
`<?php if ( function_exists('wfs_share') ) {echo do_shortcode('[wfs_share]'); ?>`

- ¿Como puedo añadirlos botones share con un short code? 
Añade este short code `[wfs_share]` donde quieras que aparezca 

- ¿Como añado los botones follow en la plantilla del tema? 
Añade este codigo en el lugar de la plantilla que quieres que aparectan los botones
`<?php if ( function_exists('wfs_follow') ) {echo do_shortcode('[wfs_follow]'); ?>`

- ¿Como puedo añadirlos botones share con un short code? 
Añade este short code `[wfs_follow]` donde quieras que aparezca 

- ¿Porque no me aparece nada si ya lo añadi con short code o en la plantilla? 
Primero tiene que haber algun boton seleccionado para que aparezcan


##Imagenes
