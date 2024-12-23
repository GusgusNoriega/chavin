<?php
function mi_theme_enqueue_styles() {
    // Registrar y encolar los estilos principales
    wp_enqueue_style(
        'mi-theme-style', // Identificador único del estilo
        get_stylesheet_uri(), // Ruta al archivo style.css principal
        array(), // Dependencias (si usa otros estilos antes, se especifican aquí)
        '1.0', // Versión del archivo para control de caché
        'all' // Tipo de medio (all, screen, print, etc.)
    );
}
add_action('wp_enqueue_scripts', 'mi_theme_enqueue_styles');