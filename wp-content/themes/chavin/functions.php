<?php
function chavin_theme_setup() {
    // Soporte para el título dinámico
    add_theme_support( 'title-tag' );

    // Soporte para menús
    register_nav_menus( array(
        'menu_principal' => __( 'Menú Principal', 'chavin' ),
        'menu_secundario'  => __('Menú Secundario'),
    ) );
}
add_action( 'after_setup_theme', 'chavin_theme_setup' );

function chavin_enqueue_scripts() {
    wp_enqueue_style( 'chavin-style', get_stylesheet_uri() );
}
add_action( 'wp_enqueue_scripts', 'chavin_enqueue_scripts' );

// Este código puede ir en functions.php de tu tema o en un plugin personalizado
add_action('rest_api_init', 'registrar_endpoint_producto');

function registrar_endpoint_producto() {
    register_rest_route('myapi/v1', '/producto/(?P<id>\d+)', array(
        'methods'  => 'GET',
        'callback' => 'obtener_datos_producto'
    ));
}

function obtener_datos_producto($request) {
    $post_id = $request['id'];

    // Verificar que el post exista y que sea del tipo correcto
    $post = get_post($post_id);
    if (!$post || $post->post_type !== 'producto') {
        return new WP_Error('no_post', 'No se encontró el producto con ese ID.', array('status' => 404));
    }

    // Obtener campos básicos del post
    $titulo = get_the_title($post_id);
    $contenido = apply_filters('the_content', $post->post_content);
    $link = get_permalink($post_id);

    // Obtener campos ACF

    // Campo icono (imagen)
    $icono_id = get_field('icono', $post_id);
    $icono_url = obtener_url_imagen($icono_id);

    // Campo titulo_2 (texto)
    $titulo_2 = get_field('titulo_2', $post_id);

    // Campo seccion_1_imagen_1 (imagen)
    $seccion_1_imagen_1_id = get_field('seccion_1_imagen_1', $post_id);
    $seccion_1_imagen_1_url = obtener_url_imagen($seccion_1_imagen_1_id);

    // Campo estacionalidad (checkbox, generalmente array)
    $estacionalidad = get_field('estacionalidad', $post_id);
    // $estacionalidad será un array con las opciones seleccionadas. Si deseas una cadena separada por comas:
    // $estacionalidad_str = !empty($estacionalidad) ? implode(', ', $estacionalidad) : '';

    // Campo presentaciones (repetidor)
    $presentaciones_data = array();
    if (have_rows('presentaciones', $post_id)) {
        while (have_rows('presentaciones', $post_id)) {
            the_row();
            $presentacion_imagen_id = get_sub_field('imagen');
            $presentacion_imagen_url = obtener_url_imagen($presentacion_imagen_id);

            $presentacion_texto = get_sub_field('texto');

            $presentaciones_data[] = array(
                'imagen' => $presentacion_imagen_url,
                'texto'  => $presentacion_texto
            );
        }
    }

    // Campo paquete (imagen)
    $paquete_id = get_field('paquete', $post_id);
    $paquete_url = obtener_url_imagen($paquete_id);

    // Armar el array de respuesta
    $response = array(
        'id'                 => $post_id,
        'titulo'             => $titulo,
        'contenido'          => $contenido,
        'link'               => $link,
        'icono'              => $icono_url,
        'titulo_2'           => $titulo_2,
        'seccion_1_imagen_1' => $seccion_1_imagen_1_url,
        'estacionalidad'     => $estacionalidad, // es un array, puedes dejarlo así
        'presentaciones'     => $presentaciones_data,
        'paquete'            => $paquete_url
    );

    return $response;
}

/**
 * Función auxiliar para obtener la URL de una imagen dado su ID
 */
function obtener_url_imagen($attachment_id) {
    if (!$attachment_id) {
        return '';
    }
    $imagen_data = wp_get_attachment_image_src($attachment_id, 'full');
    if ($imagen_data && isset($imagen_data[0])) {
        return $imagen_data[0];
    }
    return '';
}
/*
ok te dare todos los campos y que tipo son para que puedas organizar el codigo,
primero necesito el titulo del post y el contenido por defecto que da wordpress,

ahora tambien necesito los campos personalizados


nombre 'icono' campo de tipo imagen 
nombre 'titulo_2' campo de tipo texto
nombre 'seccion_1_imagen_1' campo de tipo imagen
nombre 'estacionalidad' campo de tipo casilla de verificacion
nombre 'presentaciones' campo de tipo repetidor con los campos ['imagen' de tipo imagen, 'texto' de tipo texto]
nombre 'paquete' campo de tipo imagen
*/

function cargar_funciones_tema() {
    $carpeta_funciones = get_template_directory() . '/funciones/';

    // Verificar si la carpeta existe
    if ( ! file_exists( $carpeta_funciones ) ) {
        return;
    }

    // Obtener todos los archivos PHP dentro de la carpeta
    $archivos = glob( $carpeta_funciones . '*.php' );

    // Incluir cada archivo
    if ( $archivos ) {
        foreach ( $archivos as $archivo ) {
            require_once $archivo;
        }
    }
}
add_action( 'after_setup_theme', 'cargar_funciones_tema' );

