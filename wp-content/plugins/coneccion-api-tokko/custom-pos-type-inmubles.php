<?php
/*
function crear_cpt_inmuebles() {
    $labels = array(
        'name'               => _x( 'Inmuebles', 'post type general name', 'textdomain' ),
        'singular_name'      => _x( 'Inmueble', 'post type singular name', 'textdomain' ),
        'menu_name'          => _x( 'Inmuebles', 'admin menu', 'textdomain' ),
        'name_admin_bar'     => _x( 'Inmueble', 'add new on admin bar', 'textdomain' ),
        'add_new'            => _x( 'Añadir Nuevo', 'inmueble', 'textdomain' ),
        'add_new_item'       => __( 'Añadir Nuevo Inmueble', 'textdomain' ),
        'new_item'           => __( 'Nuevo Inmueble', 'textdomain' ),
        'edit_item'          => __( 'Editar Inmueble', 'textdomain' ),
        'view_item'          => __( 'Ver Inmueble', 'textdomain' ),
        'all_items'          => __( 'Todos los Inmuebles', 'textdomain' ),
        'search_items'       => __( 'Buscar Inmuebles', 'textdomain' ),
        'parent_item_colon'  => __( 'Inmuebles Padre:', 'textdomain' ),
        'not_found'          => __( 'No se encontraron inmuebles.', 'textdomain' ),
        'not_found_in_trash' => __( 'No se encontraron inmuebles en la papelera.', 'textdomain' )
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'inmueble' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
    );

    register_post_type( 'inmuebles', $args );
}

add_action( 'init', 'crear_cpt_inmuebles' );

*/