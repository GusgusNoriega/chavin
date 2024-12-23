<?php

// Walker personalizado para el Menú Principal
if ( ! class_exists( 'Walker_Nav_Menu' ) ) {
    return;
}

class Walker_Menu_Principal extends Walker_Nav_Menu {

    /**
     * Inicia el nivel de elementos del menú.
     * Sobrescribimos este método para evitar generar <ul>.
     */
    public function start_lvl( &$output, $depth = 0, $args = null ) {
        // No hacemos nada aquí para eliminar <ul>
    }

    /**
     * Finaliza el nivel de elementos del menú.
     * Sobrescribimos este método para evitar generar </ul>.
     */
    public function end_lvl( &$output, $depth = 0, $args = null ) {
        // No hacemos nada aquí para eliminar </ul>
    }

    /**
     * Inicia un elemento del menú.
     */
    public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
        // Verificar si el elemento actual es la página actual
      

        // Construir el enlace con las clases deseadas
        $output .= '<a href="' . esc_url( $item->url ) . '" class="text-lg font-normal link-border ">' . esc_html( $item->title ) . '</a>';
    }

    /**
     * Finaliza un elemento del menú.
     */
    public function end_el( &$output, $item, $depth = 0, $args = null ) {
        // No hacemos nada aquí
    }
}