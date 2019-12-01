********************************
 2.0.0 18/11/2019
********************************
- Añadido los iconos con svg incrustrados
- Añadido opciones de personalización
- Añado javascript solo en admin para mostrar resultado en tiempo real
- Añado tambien opcion para personalizar el titulo
- Añado una funcion con un array en asset con toda la info de la redes
- elimino el filtro de wsf_array_share_filter y wsf_array_follow_filter por que ya no existe esa bariable ahora es $social_network quien se contiene toda la informacion
- añado un filtro ('wsf_array_social_network_filter') para el array $social_network con las url_follow url_share, select_follow, select_share y los iconos
- añado dos array uno $social_network_share  y otro $social_network_follow  para poder compararlos con el array $social_network y mostrar solo las que procedan
- oculto los iconos que no esten marcados
- añado un filtro para las redes sociales share wsf_array_social_network_share_filter
- añado un filtro para las redes sociales follow wsf_array_social_network_follow_filter
- añadido estilo por defecto a los iconos
- añadido opcion para los iconos antiguos
- mejorado css para movil en el admin



********************************
 proximas incorporaciones
********************************
- guardar en un array las opciones y sanearlas antes manteniendo la configuracion
- redirigir al activar el plugin

- traducir y explicar las nuevas funciones
- ordenar css del admin




********************************
 1.0.5 y 1.1.0
********************************
-traduzco el plugin al ingles y corrijo un fallo de depuracion de la antigua  version 




********************************
 1.0.4 28/10/2019--03/11/2019 
********************************
- añado icono de telegram al spriter
- añado telegram a la lista de compartir
- añado telegram a la lista de seguir 
- añado link a los ajustes del plugin
- uso la funcion urlencode en el titulo y thumbnail
- uso funcion esc_url() en url de follow
- creo un array con las url de las redes sociales para compartir
- Creo un filtro para el array de las redes sociales follow con las url y los select 'wsf_array_share_filter'
- Creo un filtro con el contenedor y contenido de las redes sociales share 'wfs_content_share_filter'
- añado texto para compartir en telegran cargando uno por defecto si no hay ninguno definido
- creo un array con las url de las redes sociales follow
- Creo un filtro para el array de las redes sociales follow con las url y los select 'wsf_array_follow_filter'
- Creo un filtro con el contenedor y contenido de las redes sociales follow 'wfs_content_follow_filter'
- Arreglo un fallo por el que se mostraba el titulo sin nada marcado al aññadirlo mediante la funcion
- Unifico la funcion de eventos de google analytics





********************************
 1.0.3 10/10/2019 - 13/10/2019
********************************
- Añadido opcion para agregar texto predefinido en negrita al conpartir en whatsapp 
- Añadido nuevas traducciones a ingles es_US y español es_ES
- compruebo si es movil o web para whatsapp 
- añadido filtro wfs_share_end_filter para los botos share
- corrijo css para movil en el administrador
- añadido columnas con explicacion en cada seccion de la configuracion del plugin
- pongo mas orden en public render




********************************
 1.0.2 07/10/2019
********************************
- arreglo un fallo por el que nunca se mostraba los botones de follow en la plantilla public-render.php
- añado logo pmk web dev
- cambio la funcion wfs_add_options() a admin
- elimino el registro de fallo al activar



********************************
 1.0.1 03/10/2019 07/10/2019
********************************
- Adapto el codigo php html y css a los estandares de WordPress
- Añado botones para seleccionar si se muestra al principio o al final o los dos
- hago flex el contenedor de los botones
- añado condicion para que no muestre nada si no hay nada seleccionado
- añado funcion para eliminar las opciones creadas al desactivar el pluguin
- añado el archivo readme.txt



********************************
 1.0.0 26/09/2019
********************************
- reescibo el plugin entero

