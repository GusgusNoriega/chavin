<?php
function customizer_api_key($wp_customize) {
    // Añade una sección al Customizer
    $wp_customize->add_section('api_key_section', array(
        'title'       => 'Configuración API',
        'priority'    => 30,
    ));

    // Añade un campo para la clave API
    $wp_customize->add_setting('api_key', array(
        'default'     => '',
        'type'        => 'option',
    ));

    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        'api_key',
        array(
            'label'      => 'Clave API',
            'section'    => 'api_key_section',
            'settings'   => 'api_key',
            'type'       => 'text',
        )
    ));
}
add_action('customize_register', 'customizer_api_key');

// Añade una página de opciones en el área de administración
function api_key_admin_menu() {
    add_options_page('Configuración API', 'Configuración API', 'manage_options', 'api-key-config', 'api_key_admin_page');
}
add_action('admin_menu', 'api_key_admin_menu');

// Mostrar y guardar la clave API en la página de opciones
function api_key_admin_page() {
    // Guarda la clave API si el formulario ha sido enviado
    if (isset($_POST['api_key'])) {
        update_option('api_key', sanitize_text_field($_POST['api_key']));
    }

    // Obtener la clave API actual de la base de datos
    $api_key = get_option('api_key', '');

    echo '<div class="wrap">';
    echo '<h1>Configuración API de tokko broker</h1>';
    echo '<form method="post" action="">';
    echo '<table class="form-table">';
    echo '<tr valign="top">';
    echo '<th scope="row">Clave API</th>';
    echo '<td><input type="text" name="api_key" value="' . esc_attr($api_key) . '" /></td>';
    echo '</tr>';
    echo '</table>';
    echo '<p class="submit"><input type="submit" class="button-primary" value="Guardar cambios" /></p>';
    echo '</form>';
    echo '</div>';
}