jQuery(document).ready(function($) {

    $('#pagar-ahora').click(function(event) {
        event.preventDefault();

        // Generar IDs de transacción y orden
        const currentTimeUnix = Math.floor(Date.now()) * 1000;
        const transactionId = currentTimeUnix.toString().slice(0, 14);
        const orderNumber = currentTimeUnix.toString().slice(0, 10).toString();

        // Obtener valores del formulario
        const montoPagar = $('#monto_cli').val();
        const nomcli = $('#nombre').val();
        const apecli = $('#ape_cli').val();
        const emailcli = $('#mail').val();
        const celularcli = $('#celular_cli').val();
        const dnicli = $('#dni_cli').val();

        // Preparar datos para AJAX
        $.ajax({
            url: izipay_ajax_object.ajax_url,
            method: 'POST',
            data: {
                action: 'izipay_generate_token',
                nonce: izipay_ajax_object.nonce_procesar_pedido,
                transaccion: transactionId,
                order_number: orderNumber,
                monto: montoPagar
            },
            success: function(response) {
                if (response.success) {
                    var token = response.data.token;
                    // Configurar y cargar el formulario de pago
                    const iziConfig = {
                        config: {
                            transactionId: transactionId,
                            action: 'pay',
                            merchantCode: '4001834', // Reemplaza con tu código de comercio
                            order: {
                                orderNumber: orderNumber,
                                currency: "PEN",
                                amount: montoPagar,
                                payMethod: "CARD, QR, YAPE_CODE",
                                processType: "AT",
                                merchantBuyerId: "4001834", // Reemplaza si es necesario
                                installments: "00",
                                dateTimeTransaction: currentTimeUnix.toString(),
                            },
                            billing: {
                                firstName: nomcli,
                                lastName: apecli,
                                email: emailcli,
                                phoneNumber: celularcli,
                                street: 'Av. xxxxx',
                                city: 'Lima',
                                state: 'Lima',
                                country: 'PE',
                                postalCode: '15300',
                                documentType: 'DNI',
                                document: dnicli,
                            },
                            render: {
                                typeForm: Izipay.enums.typeForm.POP_UP,
                                container: '#your-iframe-payment',
                                showButtonProcessForm: true,
                                redirectUrls: {
                                    onSuccess: 'https://tu-sitio.com/success',
                                    onError: 'https://tu-sitio.com/error',
                                    onCancel: 'https://tu-sitio.com/cancel',
                                }
                            },
                            appearance: {
                                styleInput: "normal",
                                logo: "",
                                theme: "green",
                            },
                        },
                    };

                   const callbackResponsePayment = (response) => {
                        console.log(response);

                          // Obtener los datos del formulario
                        var formData = {
                            action: 'procesar_pedido', // Nombre de la acción en PHP
                            nombre: $('#nombre').val(),
                            mail: $('#mail').val(),
                            'datos-entradas': $('#datos-entradas').val(),
                            pago: response // Integrar la respuesta del pago
                        };
                        
                        // Verifica el estado del pago
                        if (response.message === 'OK') { // Ajusta según la respuesta real
                            
                            console.log(formData);
                            // Preparar los datos del formulario
                            var formData = {
                                action: 'procesar_pedido', // Nombre de la acción en PHP
                                nonce: izipay_ajax_object.nonce_procesar_pedido, // Incluir el nonce para seguridad
                                nombre: $('#nombre').val(),
                                mail: $('#mail').val(),
                                'datos-entradas': $('#datos-entradas').val(),
                                pago: response // Integrar la respuesta del pago
                            };

                            // Enviar los datos combinados al servidor vía AJAX
                            $.ajax({
                                url: izipay_ajax_object.ajax_url,
                                method: 'POST',
                                data: formData,
                                success: function(serverResponse) {
                                    if (serverResponse.success) {
                                        
                                        window.location.href = "/confirmacion/?ticket_number=" + serverResponse.data;
                                    } else {
                                        // Manejar errores del servidor
                                       
                                        console.error('Error al procesar el pedido:', serverResponse.data);
                                    }
                                },
                                error: function(error) {
                                    console.error('Error en la solicitud AJAX al procesar el pedido:', error);
                                    
                                }
                            });


                        } else {
                            
                            console.error('Pago fallido:', response);
                            console.log(formData);
                        }
                    };

                    try {
                        const izi = new Izipay({
                            config: iziConfig.config,
                        });
                        izi &&
                            izi.LoadForm({
                                authorization: token,
                                keyRSA: 'RSA',
                                callbackResponse: callbackResponsePayment,
                            });
                    } catch (error) {
                        console.error('Error al cargar el formulario de pago', error);
                    }

                } else {
                    console.error('Error:', response.data);
                }
            },
            error: function(error) {
                console.error('Error en la solicitud AJAX:', error);
            }
        });
    });

});