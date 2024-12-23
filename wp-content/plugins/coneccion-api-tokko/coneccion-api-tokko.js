var key = "abf6378099864bffc40be9987e13272aebe7e5c8";
var limit = 10;
var offset = 0;
var totalCountPropiedades;


jQuery(document).ready(function($) {

    function fetchProperties() {
        var miURL = `https://tokkobroker.com/api/v1/property/?format=json&lang=es_ar&key=${key}&availability=available&offset=${offset}&limit=${limit}`;
        console.log(miURL);
        // Hacer una solicitud AJAX a miURL
        fetch(miURL)
            .then(response => response.json()) // Convertir la respuesta a JSON
            .then(data => {
                if (offset === 0) { // Solo queremos obtener el totalCountPropiedades una vez
                    totalCountPropiedades = data.meta.total_count;
                    console.log(totalCountPropiedades);
                }

                // Hacer una petición POST a tu backend
                $.ajax({
                    type: 'POST',
                    url: ajaxurl,
                    data: {
                        action: 'mi_funcion',
                        url_parametro: miURL,
                        offsetpro: offset + limit,
                        totalCountPropiedadesTokko: totalCountPropiedades
                    },
                    success: function(response) {
                        $('#mi-resultado').html(response);
                        // Aumentar offset y llamar de nuevo si aún no hemos alcanzado el límite
                        if (offset < totalCountPropiedades - limit) {
                            offset += limit;
                            fetchProperties(); // Llama recursivamente
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error('Error en la petición AJAX:', errorThrown);
                        
                        // Si hay un error, incrementa el offset y sigue con la siguiente propiedad
                        if (offset < totalCountPropiedades - limit) {
                            offset += limit;
                            fetchProperties(); // Llama recursivamente
                        }
                    }
                });
            });  // <-- Aquí es donde faltaba el cierre de llave y paréntesis

    }

    // Iniciar el proceso cuando se haga clic en el botón
    $('#mi-boton').click(fetchProperties);

});