<?php
/*
Plugin Name: Izipay Payment Integration
Description: Integración de Izipay en WordPress.
Version: 1.0
Author: Gustavo Noriega
*/

// Evitar el acceso directo al archivo
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Aquí añadiremos el resto del código

// Registrar el shortcode para mostrar el formulario
function izipay_payment_form_shortcode() {
    ob_start();
    ?>
    <!-- Tu formulario HTML aquí -->
    <form id="procesar_pedido_form">
        <label for="">Nombre</label>
        <input type="text" value="Juan" name="nombre" id="nombre"><br>

        <label for="">Apellidos</label>
        <input type="text" value="Quispe" name="ape_cli" id="ape_cli"><br>

        <label for="">Email</label>
        <input type="text" value="juan.quispe@izipay.pe" name="mail" id="mail"><br>

        <label for="">Celular</label>
        <input type="text" value="987654321" name="celular_cli" id="celular_cli"><br>

        <label for="">DNI</label>
        <input type="text" value="12457896" name="dni_cli" id="dni_cli"><br>

        <label for="">Monto</label>
        <input type="text" value="2.20" name="monto_cli" id="monto_cli"><br>

        <button id="pagar-ahora">Pagar</button>
    </form>
    <?php
    return ob_get_clean();
}
add_shortcode( 'izipay_payment_form', 'izipay_payment_form_shortcode' );

// Encolar scripts y estilos
function izipay_enqueue_scripts() {
    if ( is_page_template( 'template-tienda.php' ) ) {
        wp_enqueue_script( 'jquery' );

        // Encolar los scripts de Izipay
        wp_enqueue_script( 'kr-payment-form', 'https://static.micuentaweb.pe/static/js/krypton-client/V4.0/stable/kr-payment-form.min.js', array(), null, true );
        wp_enqueue_script( 'izipay-js', 'https://sandbox-checkout.izipay.pe/payments/v1/js/index.js', array(), null, true );

        // Encolar tu script personalizado
        wp_enqueue_script( 'izipay-custom', plugin_dir_url( __FILE__ ) . 'js/izipay-custom.js', array('jquery'), '1.0', true );

        // Localizar el script para pasar variables de PHP a JavaScript, incluyendo múltiples nonces
        wp_localize_script( 'izipay-custom', 'izipay_ajax_object', array(
            'ajax_url'               => admin_url( 'admin-ajax.php' ),
            'nonce_izipay'           => wp_create_nonce( 'izipay_nonce' ),
            'nonce_procesar_pedido'  => wp_create_nonce( 'procesar_pedido_nonce' ),
        ) );
    }
}
add_action( 'wp_enqueue_scripts', 'izipay_enqueue_scripts' );

/* fin de registrar el codigo*/

// Manejador AJAX para generar el token
function izipay_ajax_handler() {
     // Verificar si el nonce está presente
    if ( ! isset($_POST['nonce']) ) {
        wp_send_json_error('Nonce no proporcionado.');
    }

    // Verificar el nonce específico para procesar_pedido
    if ( ! wp_verify_nonce($_POST['nonce'], 'procesar_pedido_nonce') ) {
        wp_send_json_error('Nonce inválido.');
    }

    if ( isset( $_POST['transaccion'] ) && isset( $_POST['order_number'] ) && isset( $_POST['monto'] ) ) {

        $transaccion_id = sanitize_text_field( $_POST['transaccion'] );
        $order_number = sanitize_text_field( $_POST['order_number'] );
        $montototal = sanitize_text_field( $_POST['monto'] );

        // Datos de tu comercio (deberías obtener estos valores de forma segura)
        $MERCHANT_CODE = '4001834'; // Reemplaza con tu código de comercio
        $PUBLIC_KEY = 'VErethUtraQuxas57wuMuquprADrAHAb'; // Reemplaza con tu llave pública

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://sandbox-api-pw.izipay.pe/security/v1/Token/Generate",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode([
                'requestSource' => 'ECOMMERCE',
                'merchantCode' => $MERCHANT_CODE,
                'orderNumber' => $order_number,
                'publicKey' => $PUBLIC_KEY,
                'amount' => $montototal
            ]),
            CURLOPT_HTTPHEADER => [
                "Accept: application/json",
                "Content-Type: application/json",
                "transactionId:" . $transaccion_id
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            wp_send_json_error( 'cURL Error #:' . $err );
        } else {
            $decoded_response = json_decode( $response, true );

            if ( isset( $decoded_response['response']['token'] ) ) {
                $token = $decoded_response['response']['token'];
                wp_send_json_success( array( 'token' => $token ) );
            } else {
                wp_send_json_error( 'Error: ' . $response );
            }
        }

    } else {
        wp_send_json_error( 'Solicitud inválida' );
    }

    wp_die();
}
add_action( 'wp_ajax_izipay_generate_token', 'izipay_ajax_handler' );
add_action( 'wp_ajax_nopriv_izipay_generate_token', 'izipay_ajax_handler' );

/*fin de llamada ajax*/