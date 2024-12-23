<?php
/*
Plugin Name: Conexión a Api de Tokko Broker (Adaptado a Qode + Taxonomías)
Plugin URI: https://mypageweb.com
Description: Plugin que conecta la API de Tokko Broker con WordPress, guardando los campos y taxonomías para un theme Qode.
Version: 1.8
Author: Gustavo Noriega
Author URI: https://mypageweb.com
License: GPL2
*/

// Agrega un botón en la parte superior del panel de administración
require_once plugin_dir_path(__FILE__) . 'custom-pos-type-inmubles.php';
require_once plugin_dir_path(__FILE__) . 'admin/admin-menu.php';

function mi_plugin_shortcode() {
    $output  = '<button id="mi-boton">Actualizar propiedades</button>';
    $output .= '<div id="mi-resultado"></div>';
    return $output;
}
add_shortcode('actualizar_propiedades', 'mi_plugin_shortcode');

function load_dashicons_front_end() {
    if (!wp_style_is('dashicons', 'enqueued')) {
        wp_enqueue_style('dashicons');
    }
}
add_action('wp_enqueue_scripts', 'load_dashicons_front_end');

/**
 * Descarga una imagen externamente y la inserta como 'attachment' en la biblioteca,
 * asociándola como imagen destacada al $post_id.
 */
function descargar_imagen_y_agregar_a_medios($image_url, $post_id) {
    require_once(ABSPATH . 'wp-admin/includes/file.php');
    require_once(ABSPATH . 'wp-admin/includes/media.php');
    require_once(ABSPATH . 'wp-admin/includes/image.php');
    
    $args = array(
        'post_type'      => 'attachment',
        'posts_per_page' => 1,
        'meta_key'       => 'url-base',
        'meta_value'     => $image_url
    );
    $existing_images = get_posts($args);

    if ($existing_images) {
        // Asociar la imagen existente al post
        wp_update_post(array(
            'ID'          => $existing_images[0]->ID,
            'post_parent' => $post_id
        ));
        return $existing_images[0]->ID;
    }

    $file_name = basename($image_url);
    $file_type = wp_check_filetype($file_name, null);

    $attachment = array(
        'guid'           => $image_url,
        'post_mime_type' => $file_type['type'],
        'post_title'     => 'imagen principal',
        'post_content'   => '',
        'post_status'    => 'inherit',
        'post_parent'    => $post_id
    );

    $attachment_id = wp_insert_attachment($attachment, false);
    if (is_wp_error($attachment_id)) {
        return false;
    }

    $attach_data = array(
        'width'           => 1200,
        'height'          => 1200,
        'hwstring_small'  => 'height="0" width="0"',
        'file'            => $file_name,
        'sizes'           => array(),
        'image_meta'      => array()
    );

    $sizes = array(
        'thumbnail','medium','large','full','medium_large',
        'post-thumbnail','modern-property-child-slider','property-thumb-image',
        'property-detail-video-image','agent-image','partners-logo'
    );
    foreach ($sizes as $size) {
        $attach_data['sizes'][$size] = array(
            'file'      => $file_name,
            'width'     => 1200,
            'height'    => 1200,
            'mime-type' => $file_type['type'],
            'url'       => $image_url
        );
    }

    wp_update_attachment_metadata($attachment_id, $attach_data);
    update_post_meta($attachment_id, 'url-base', $image_url);

    // Establecerla como imagen destacada
    set_post_thumbnail($post_id, $attachment_id);
    return $attachment_id;
}

/**
 * Igual que la anterior, pero NO la establece como imagen destacada
 */
function descargar_imagen_y_agregar_a_medios2($image_url, $post_id) {
    require_once(ABSPATH . 'wp-admin/includes/file.php');
    require_once(ABSPATH . 'wp-admin/includes/media.php');
    require_once(ABSPATH . 'wp-admin/includes/image.php');
    
    $args = array(
        'post_type'      => 'attachment',
        'posts_per_page' => 1,
        'meta_key'       => 'url-base',
        'meta_value'     => $image_url
    );
    $existing_images = get_posts($args);

    if ($existing_images) {
        wp_update_post(array(
            'ID'          => $existing_images[0]->ID,
            'post_parent' => $post_id
        ));
        return $existing_images[0]->ID;
    }

    $file_name = basename($image_url);
    $file_type = wp_check_filetype($file_name, null);

    $attachment = array(
        'guid'           => $image_url,
        'post_mime_type' => $file_type['type'],
        'post_title'     => sanitize_file_name($file_name),
        'post_content'   => '',
        'post_status'    => 'inherit',
        'post_parent'    => $post_id
    );

    $attachment_id = wp_insert_attachment($attachment, false);
    if (is_wp_error($attachment_id)) {
        return false;
    }

    $attach_data = array(
        'width'           => 1200,
        'height'          => 1200,
        'hwstring_small'  => 'height="0" width="0"',
        'file'            => $file_name,
        'sizes'           => array(),
        'image_meta'      => array()
    );

    $sizes = array(
        'thumbnail','medium','large','full','medium_large',
        'post-thumbnail','modern-property-child-slider','property-thumb-image',
        'property-detail-video-image','agent-image','partners-logo'
    );
    foreach ($sizes as $size) {
        $attach_data['sizes'][$size] = array(
            'file'      => $file_name,
            'width'     => 1200,
            'height'    => 1200,
            'mime-type' => $file_type['type'],
            'url'       => $image_url
        );
    }

    wp_update_attachment_metadata($attachment_id, $attach_data);
    update_post_meta($attachment_id, 'url-base', $image_url);

    return $attachment_id;
}

/** 
 * Inserta o crea un término en una taxonomía dada.
 */
function taxono($taxonomy, $slug) {
    $term = get_term_by('slug', $slug, $taxonomy);
    if ($term !== false) {
        return $term->term_id;
    } else {
        $term_args = array('slug' => $slug);
        $result    = wp_insert_term($slug, $taxonomy, $term_args);
        if (!is_wp_error($result)) {
            return $result['term_id'];
        } else {
            trigger_error('Error intencional: ' . $result->get_error_message(), E_USER_ERROR);
            return false;
        }
    }
}

function asociar_post_a_termino($post_id, $term_id, $taxonomy) {
    $result = wp_set_post_terms($post_id, array($term_id), $taxonomy);
    if (!is_wp_error($result)) {
        return true;
    } else {
        trigger_error('Error intencional: ' . $result->get_error_message(), E_USER_ERROR);
        return false;
    }
}

function obtener_id_termino_por_slug($taxonomy, $slug) {
    $term = get_term_by('slug', $slug, $taxonomy);
    if ($term !== false) {
        return $term->term_id;
    } else {
        $result = wp_insert_term($slug, $taxonomy, array('slug' => $slug));
        if (!is_wp_error($result)) {
            return $result['term_id'];
        } else {
            error_log('Error al crear término: ' . $result->get_error_message());
            return false;
        }
    }
}

/**
 * Principal: obtiene propiedades de Tokko y crea/actualiza posts 'property'
 * junto con las metas y taxonomías del theme Qode.
 */
function create_post_from_property($url_recibida) {
    set_time_limit(3000);
    $url      = $url_recibida;
    $response = wp_remote_get($url);
    $body     = wp_remote_retrieve_body($response);
    $data     = json_decode($body);
    
    if (!empty($data)) {
        foreach ($data->objects as $property) {
            // Verificamos si ya existe un post con el mismo ID de Tokko
            $post_args = array(
                'post_type'   => 'property',
                'meta_key'    => 'id-de-la-propiedad',  // <--- meta interno para reconocerla
                'meta_value'  => $property->id,
                'post_status' => 'publish',
                'numberposts' => 1,
            );
            $existing_post = get_posts($post_args);

            // *** Preparamos valores numéricos para evitar vacíos ***
            $bedrooms_value    = (!empty($property->suite_amount) && is_numeric($property->suite_amount)) ? $property->suite_amount : 0; 
            $bathrooms_value   = (!empty($property->bathroom_amount) && is_numeric($property->bathroom_amount)) ? $property->bathroom_amount : 0; 
            $floors_total      = (!empty($property->floors_amount) && is_numeric($property->floors_amount)) ? $property->floors_amount : 0; 
            $surface_value     = (!empty($property->surface) && is_numeric($property->surface)) ? $property->surface : 0; 
            $parking_value     = (!empty($property->parking_lot_amount) && is_numeric($property->parking_lot_amount)) ? $property->parking_lot_amount : 0; 
            
            // Para "floor" (piso actual) no hay un valor real en la API, así que forzamos 0
            $floor_value = 0;

            // *** CAMPOS NUEVOS O FALTANTES (numéricos => 0, texto => '') ***
            // from_center
            $from_center_value     = 0;
            // garages
            $garages_value         = 0;
            // garages_size
            $garages_size_value    = 0;
            // additional_space
            $additional_space_value = '';
            // Ejemplo de "country"
            $country_value         = '';  // Podrías usar $property->location->country ?? '' si existiera

            /**
             * -----------------------------------------------
             * 1) CREAR NUEVA PROPIEDAD
             * -----------------------------------------------
             */
            if (empty($existing_post)) {
                $post_id = wp_insert_post(array(
                    'post_type'    => 'property',
                    'post_title'   => $property->publication_title,
                    'post_content' => $property->description,
                    'post_status'  => 'publish',
                    'post_date'    => date('Y-m-d H:i:s', strtotime($property->created_at)),
                ));

                if ($post_id) {
                    // Guardamos el ID de Tokko para no duplicar
                    update_post_meta($post_id, 'id-de-la-propiedad', $property->id);

                    // ID Qode
                    update_post_meta($post_id, 'qodef_property_id_meta', $property->reference_code ?? '');

                    // =========================================================
                    //                IMAGEN PRINCIPAL & GALERÍA
                    // =========================================================
                    $fotos    = array();
                    $fotos_id = '';
                    if (!empty($property->photos)) {
                        foreach ($property->photos as $photo) {
                            if ($photo->is_front_cover) {
                                $image_url = $photo->image;
                                update_post_meta($post_id, 'imagen_principal', $image_url);
                                descargar_imagen_y_agregar_a_medios($image_url, $post_id);
                            } else {
                                $fotos[] = $photo->image;
                                $img_id  = descargar_imagen_y_agregar_a_medios2($photo->image, $post_id);
                                if ($img_id !== false) {
                                    $fotos_id .= $img_id . ',';
                                }
                            }
                        }
                    }
                    $fotos_id = rtrim($fotos_id, ',');

                    // Galería según el theme Qode
                    update_post_meta($post_id, 'qodef_property_image_gallery', $fotos_id);

                    // ==================================================
                    //   TAXONOMÍAS: property_status, property_city, etc.
                    // ==================================================
                    // 1) property_status (Venta/Alquiler/etc.)
                    if (isset($property->operations) && is_array($property->operations)) {
                        $status_ids = array(); 
                        foreach ($property->operations as $operation) {
                            if (isset($operation->operation_type)) {
                                $textoSlug2     = trim($operation->operation_type);
                                $slugTag2       = sanitize_title($textoSlug2);
                                $status_term_id = obtener_id_termino_por_slug('property-status', $slugTag2);
                                if ($status_term_id) {
                                    $status_ids[] = $status_term_id;
                                }
                                // Precios
                                if (!empty($operation->prices)) {
                                    foreach ($operation->prices as $p) {
                                        if ($p->currency === 'USD' || $p->currency === 'MXN') {
                                            update_post_meta($post_id, 'qodef_property_price_meta', $p->price);
                                            update_post_meta($post_id, 'qodef_property_price_label_meta', '$');
                                            update_post_meta($post_id, 'qodef_property_price_label_position_meta', 'before');

                                            // *** CAMBIO *** (añadimos también la meta sin prefijo "qodef_")
                                            update_post_meta($post_id, 'property_price_label_meta', '$');
                                            update_post_meta($post_id, 'property_price_label_position_meta', 'before');
                                            break;
                                        }
                                    }
                                }
                            }
                        }
                        if (!empty($status_ids)) {
                            wp_set_post_terms($post_id, $status_ids, 'property-status');
                        }
                    }

                    // 2) property_city (full_location separada por "|")
                    if (!empty($property->location->full_location)) {
                        $ubicacion_Actual  = $property->location->full_location;
                        $ubicaciones_array = explode(" | ", $ubicacion_Actual);
                        $ubicacion_ids     = array();
                        foreach ($ubicaciones_array as $ubicacion_individual) {
                            $textoUbicacion = trim($ubicacion_individual);
                            $slugUbicacion  = sanitize_title($textoUbicacion);
                            $ubicacion_id   = obtener_id_termino_por_slug('property-city', $slugUbicacion);
                            if ($ubicacion_id) {
                                $ubicacion_ids[] = $ubicacion_id;
                            }
                        }
                        if (!empty($ubicacion_ids)) {
                            wp_set_post_terms($post_id, $ubicacion_ids, 'property-city');
                        }
                    }

                    // 3) property_type
                    if (!empty($property->type->name)) {
                        $slug_type = sanitize_title($property->type->name);
                        $type_id   = obtener_id_termino_por_slug('property-type', $slug_type);
                        if ($type_id) {
                            wp_set_post_terms($post_id, array($type_id), 'property-type');
                        }
                    }

                    // 4) property_feature + servicios + adicionales
                    $servicios       = array();
                    $ambientes       = array();
                    $adicionales     = array();
                    $servicios_ids   = array();
                    $ambientes_ids   = array();
                    $adicionales_ids = array();

                    if (!empty($property->tags) && is_array($property->tags)) {
                        foreach ($property->tags as $tag) {
                            if ($tag->type == 1) {
                                $servicios[] = $tag->name;
                            } elseif ($tag->type == 2) {
                                $ambientes[] = $tag->name;
                            } elseif ($tag->type == 3) {
                                $adicionales[] = $tag->name;
                            }
                        }
                    }
                    // Asignar la taxonomía "property-tag" para servicios
                    foreach ($servicios as $serv) {
                        $slug_s  = sanitize_title($serv);
                        $s_id    = obtener_id_termino_por_slug('property-tag', $slug_s);
                        if ($s_id) $servicios_ids[] = $s_id;
                    }
                    if (!empty($servicios_ids)) {
                        wp_set_post_terms($post_id, $servicios_ids, 'property-tag');
                    }
                    // Asignar la taxonomía "property-feature" para ambientes
                    foreach ($ambientes as $amb) {
                        $slug_a = sanitize_title($amb);
                        $a_id   = obtener_id_termino_por_slug('property-feature', $slug_a);
                        if ($a_id) $ambientes_ids[] = $a_id;
                    }
                    if (!empty($ambientes_ids)) {
                        wp_set_post_terms($post_id, $ambientes_ids, 'property-feature');
                    }
                    // Asignar la taxonomía "adicionales" para $adicionales
                    foreach ($adicionales as $adi) {
                        $slug_ad = sanitize_title($adi);
                        $ad_id   = obtener_id_termino_por_slug('adicionales', $slug_ad);
                        if ($ad_id) $adicionales_ids[] = $ad_id;
                    }
                    if (!empty($adicionales_ids)) {
                        wp_set_post_terms($post_id, $adicionales_ids, 'adicionales');
                    }

                    // Guardar en meta (por si lo necesitas)
                    update_post_meta($post_id, 'servicios', $servicios);
                    update_post_meta($post_id, 'ambientes', $ambientes);
                    update_post_meta($post_id, 'adicionales', $adicionales);

                    // =================================================
                    //   OTROS CAMPOS QODE (con fallback numérico = 0)
                    // =================================================
                    update_post_meta($post_id, 'qodef_property_bedrooms_meta', $bedrooms_value);
                    update_post_meta($post_id, 'qodef_property_bathrooms_meta', $bathrooms_value);
                    update_post_meta($post_id, 'qodef_property_floor_meta', $floor_value);
                    update_post_meta($post_id, 'qodef_property_total_floors_meta', $floors_total);
                    update_post_meta($post_id, 'qodef_property_size_meta', $surface_value);
                    update_post_meta($post_id, 'qodef_property_area_size_meta', $surface_value);
                    update_post_meta($post_id, 'qodef_property_parking_meta', $parking_value);

                    // *** CAMPOS NUEVOS O FALTANTES ***
                    // *** CAMBIO *** forzamos 0 o '' si no hay valor
                    update_post_meta($post_id, 'qodef_property_from_center_meta', $from_center_value);
                    update_post_meta($post_id, 'qodef_property_garages_meta', $garages_value);
                    update_post_meta($post_id, 'qodef_property_garages_size_meta', $garages_size_value);
                    update_post_meta($post_id, 'qodef_property_additional_space_meta', $additional_space_value);
                    update_post_meta($post_id, 'qodef_property_address_country_meta', $country_value);

                    // También un campo para ocultar título (si quieres unificarlo)
                    update_post_meta($post_id, 'qodef_show_title_area_property_single_meta', 'no');

                    // Año de construcción, heating, etc. se quedan vacíos
                    update_post_meta($post_id, 'qodef_property_year_built_meta', '');
                    update_post_meta($post_id, 'qodef_property_heating_meta', '');
                    update_post_meta($post_id, 'qodef_property_accommodation_meta', '');
                    update_post_meta($post_id, 'qodef_property_ceiling_height_meta', '');

                    // Direcciones
                    update_post_meta($post_id, 'qodef_property_full_address_meta', $property->location->full_location ?? '');
                    update_post_meta($post_id, 'qodef_property_full_address_latitude', $property->geo_lat ?? '');
                    update_post_meta($post_id, 'qodef_property_full_address_longitude', $property->geo_long ?? '');
                    update_post_meta($post_id, 'qodef_property_simple_address_meta', $property->address ?? '');
                    // Código postal (vacío si no existe)
                    update_post_meta($post_id, 'qodef_property_zip_code_meta', '');
                    // Guardar coords combinadas
                    update_post_meta(
                        $post_id, 
                        'cordenadas', 
                        ($property->geo_lat ?? '') . ', ' . ($property->geo_long ?? '')
                    );

                    // Fecha de publicación en meta
                    $fecha_publicacion = date('F d, Y', strtotime($property->created_at));
                    update_post_meta($post_id, 'qodef_property_publication_date_meta', $fecha_publicacion);

                    // Términos de arrendamiento, etc., vacíos
                    update_post_meta($post_id, 'qodef_leasing_terms_meta', maybe_serialize(array()));
                    update_post_meta($post_id, 'qodef_costs_meta', maybe_serialize(array()));

                    // Manejo de agent (producer):
                    $agente_id = manejar_productor($property);
                    if ($agente_id !== null) {
                        // update_post_meta($post_id, 'qodef_property_contact_agent_meta', $agente_id);
                    }

                } // fin if($post_id)
            } 
            /**
             * -----------------------------------------------
             * 2) ACTUALIZAR PROPIEDAD EXISTENTE
             * -----------------------------------------------
             */
            else {
                $existing_post = $existing_post[0];
                $post_id       = $existing_post->ID;

                // Si la descripción cambió, actualizamos
                $existing_desc = $existing_post->post_content;
                if ($existing_desc !== $property->description) {
                    wp_update_post(array(
                        'ID'           => $post_id,
                        'post_content' => $property->description,
                    ));
                }

                // Actualizamos qodef_property_id_meta
                update_post_meta($post_id, 'qodef_property_id_meta', $property->reference_code ?? '');

                // IMÁGENES
                $fotos    = array();
                $fotos_id = '';
                if (!empty($property->photos)) {
                    foreach ($property->photos as $photo) {
                        if ($photo->is_front_cover) {
                            $image_url = $photo->image;
                            update_post_meta($post_id, 'imagen_principal', $image_url);
                            descargar_imagen_y_agregar_a_medios($image_url, $post_id);
                        } else {
                            $fotos[] = $photo->image;
                            $img_id  = descargar_imagen_y_agregar_a_medios2($photo->image, $post_id);
                            if ($img_id !== false) {
                                $fotos_id .= $img_id . ',';
                            }
                        }
                    }
                }
                $fotos_id = rtrim($fotos_id, ',');

                update_post_meta($post_id, 'qodef_property_image_gallery', $fotos_id);

                // TAXONOMÍAS property_status
                if (isset($property->operations) && is_array($property->operations)) {
                    $status_ids = array();
                    foreach ($property->operations as $operation) {
                        if (isset($operation->operation_type)) {
                            $textoSlug2     = trim($operation->operation_type);
                            $slugTag2       = sanitize_title($textoSlug2);
                            $status_term_id = obtener_id_termino_por_slug('property-status', $slugTag2);
                            if ($status_term_id) {
                                $status_ids[] = $status_term_id;
                            }
                            // Precios
                            if (!empty($operation->prices)) {
                                foreach ($operation->prices as $p) {
                                    if ($p->currency === 'USD' || $p->currency === 'MXN') {
                                        update_post_meta($post_id, 'qodef_property_price_meta', $p->price);
                                        update_post_meta($post_id, 'qodef_property_price_label_meta', '$');
                                        update_post_meta($post_id, 'qodef_property_price_label_position_meta', 'before');

                                        // *** CAMBIO *** (añadimos también sin el prefijo "qodef_")
                                        update_post_meta($post_id, 'property_price_label_meta', '$');
                                        update_post_meta($post_id, 'property_price_label_position_meta', 'before');
                                        break;
                                    }
                                }
                            }
                        }
                    }
                    if (!empty($status_ids)) {
                        wp_set_post_terms($post_id, $status_ids, 'property-status');
                    }
                }

                // property_city
                if (!empty($property->location->full_location)) {
                    $ubicacion_Actual  = $property->location->full_location;
                    $ubicaciones_array = explode(" | ", $ubicacion_Actual);
                    $ubicacion_ids     = array();
                    foreach ($ubicaciones_array as $ubicacion_individual) {
                        $textoUbicacion = trim($ubicacion_individual);
                        $slugUbicacion  = sanitize_title($textoUbicacion);
                        $ubicacion_id   = obtener_id_termino_por_slug('property-city', $slugUbicacion);
                        if ($ubicacion_id) {
                            $ubicacion_ids[] = $ubicacion_id;
                        }
                    }
                    if (!empty($ubicacion_ids)) {
                        wp_set_post_terms($post_id, $ubicacion_ids, 'property-city');
                    }
                }

                // property_type
                if (!empty($property->type->name)) {
                    $slug_type = sanitize_title($property->type->name);
                    $type_id   = obtener_id_termino_por_slug('property-type', $slug_type);
                    if ($type_id) {
                        wp_set_post_terms($post_id, array($type_id), 'property-type');
                    }
                }

                // property_feature + servicios + adicionales
                $servicios       = array();
                $ambientes       = array();
                $adicionales     = array();
                $servicios_ids   = array();
                $ambientes_ids   = array();
                $adicionales_ids = array();

                if (!empty($property->tags) && is_array($property->tags)) {
                    foreach ($property->tags as $tag) {
                        if ($tag->type == 1) {
                            $servicios[] = $tag->name;
                        } elseif ($tag->type == 2) {
                            $ambientes[] = $tag->name;
                        } elseif ($tag->type == 3) {
                            $adicionales[] = $tag->name;
                        }
                    }
                }
                // servicios => property-tag
                foreach ($servicios as $serv) {
                    $slug_s  = sanitize_title($serv);
                    $s_id    = obtener_id_termino_por_slug('property-tag', $slug_s);
                    if ($s_id) $servicios_ids[] = $s_id;
                }
                if (!empty($servicios_ids)) {
                    wp_set_post_terms($post_id, $servicios_ids, 'property-tag');
                }
                // ambientes => property-feature
                foreach ($ambientes as $amb) {
                    $slug_a = sanitize_title($amb);
                    $a_id   = obtener_id_termino_por_slug('property-feature', $slug_a);
                    if ($a_id) $ambientes_ids[] = $a_id;
                }
                if (!empty($ambientes_ids)) {
                    wp_set_post_terms($post_id, $ambientes_ids, 'property-feature');
                }
                // adicionales => "adicionales"
                foreach ($adicionales as $adi) {
                    $slug_ad = sanitize_title($adi);
                    $ad_id   = obtener_id_termino_por_slug('adicionales', $slug_ad);
                    if ($ad_id) $adicionales_ids[] = $ad_id;
                }
                if (!empty($adicionales_ids)) {
                    wp_set_post_terms($post_id, $adicionales_ids, 'adicionales');
                }

                update_post_meta($post_id, 'servicios', $servicios);
                update_post_meta($post_id, 'ambientes', $ambientes);
                update_post_meta($post_id, 'adicionales', $adicionales);

                // *** Reutilizamos los valores preparados arriba ***
                update_post_meta($post_id, 'qodef_property_bedrooms_meta', $bedrooms_value);
                update_post_meta($post_id, 'qodef_property_bathrooms_meta', $bathrooms_value);
                update_post_meta($post_id, 'qodef_property_floor_meta', $floor_value);

                // *** CAMBIO *** Campos "faltantes" o que queramos unificar
                update_post_meta($post_id, 'qodef_property_from_center_meta', $from_center_value);
                update_post_meta($post_id, 'qodef_property_garages_meta', $garages_value);
                update_post_meta($post_id, 'qodef_property_garages_size_meta', $garages_size_value);
                update_post_meta($post_id, 'qodef_property_additional_space_meta', $additional_space_value);
                update_post_meta($post_id, 'qodef_property_address_country_meta', $country_value);
                update_post_meta($post_id, 'qodef_show_title_area_property_single_meta', 'no');

                // Cant. total de pisos
                update_post_meta($post_id, 'qodef_property_total_floors_meta', $floors_total);
                update_post_meta($post_id, 'qodef_property_size_meta', $surface_value);
                update_post_meta($post_id, 'qodef_property_area_size_meta', $surface_value);
                update_post_meta($post_id, 'qodef_property_parking_meta', $parking_value);

                // Direcciones
                update_post_meta($post_id, 'qodef_property_full_address_meta', $property->location->full_location ?? '');
                update_post_meta($post_id, 'qodef_property_full_address_latitude', $property->geo_lat ?? '');
                update_post_meta($post_id, 'qodef_property_full_address_longitude', $property->geo_long ?? '');
                update_post_meta($post_id, 'qodef_property_simple_address_meta', $property->address ?? '');

                // Producer => Agent
                $agente_id = manejar_productor($property);
                if ($agente_id !== null) {
                    // update_post_meta($post_id, 'qodef_property_contact_agent_meta', $agente_id);
                }
            } // fin else (existe)
        } // fin foreach
    } // fin if(!empty($data))
}

/**
 * Elimina en WP los posts que ya no estén en la API de Tokko
 */
function borrar_post_from_property($url_recibida) {
    $existing_posts = get_posts(array(
        'post_type'      => 'property',
        'meta_key'       => 'id-de-la-propiedad',
        'meta_value'     => '',
        'meta_compare'   => '!=',
        'fields'         => 'ids',
        'posts_per_page' => -1,
    ));
    $existing_tokko_ids = array();
    foreach ($existing_posts as $post_id) {
        $existing_tokko_ids[] = get_post_meta($post_id, 'id-de-la-propiedad', true);
    }

    // Obtener los IDs de las propiedades que sí existen en Tokko
    $url      = $url_recibida;
    $response = wp_remote_get($url);
    $body     = wp_remote_retrieve_body($response);
    $data     = json_decode($body);
    $tokko_property_ids = array();

    if (!empty($data)) {
        foreach ($data->objects as $property) {
            $tokko_property_ids[] = $property->id;
        }
    }

    // Eliminar las que no estén ya en Tokko
    $posts_to_delete = array_diff($existing_tokko_ids, $tokko_property_ids);
    if (!empty($posts_to_delete)) {
        foreach ($posts_to_delete as $tokko_id) {
            $post_id = get_posts(array(
                'post_type'      => 'property',
                'meta_key'       => 'id-de-la-propiedad',
                'meta_value'     => $tokko_id,
                'meta_compare'   => '=',
                'fields'         => 'ids',
                'posts_per_page' => 1,
            ));
            if (!empty($post_id)) {
                wp_delete_post($post_id[0], true);
            }
        }
    }
}

/**
 * Llamada AJAX que dispara create_post_from_property
 */
function mi_funcion() {
    $url_recibida               = $_POST['url_parametro'];
    $offsetpro                  = $_POST['offsetpro'];
    $totalCountPropiedadesTokko = $_POST['totalCountPropiedadesTokko'];

    create_post_from_property($url_recibida);
    // Si quieres también borrar las que no están en Tokko:
    // borrar_post_from_property($url_recibida);

    if ($totalCountPropiedadesTokko == $offsetpro) {
        echo "Se han actualizado " . $offsetpro . " de " . $totalCountPropiedadesTokko . " propiedades con éxito.";
    } else {
        echo "Actualizados " . $offsetpro . " de " . $totalCountPropiedadesTokko . " propiedades. Por favor, espera...";
    }
    die();
}
add_action('wp_ajax_mi_funcion', 'mi_funcion');
add_action('wp_ajax_nopriv_mi_funcion', 'mi_funcion');

/**
 * Encolamos el JS para el botón
 */
function mi_plugin_scripts() {
    wp_enqueue_script('mi-plugin-script', plugin_dir_url(__FILE__) . 'coneccion-api-tokko.js', array('jquery'), '1.1.0', true);
}
add_action('wp_enqueue_scripts', 'mi_plugin_scripts');
add_action('admin_enqueue_scripts', 'mi_plugin_scripts');

add_action('admin_notices', 'mi_plugin_admin_notice');
function mi_plugin_admin_notice() {
    echo do_shortcode('[actualizar_propiedades]');
}

/**
 * Maneja la creación o asociación de un "Agent" a partir del $property->producer
 */
function manejar_productor($property) {
    if (!isset($property->producer) || is_null($property->producer)) {
        return null;
    }

    $producer    = $property->producer;
    $agent_email = $producer->email;

    // Verificar si existe un agente con el mismo correo
    $args = array(
        'post_type'      => 'agent',
        'meta_query'     => array(
            array(
                'key'     => 'REAL_HOMES_agent_email',
                'value'   => $agent_email,
                'compare' => '='
            )
        ),
        'posts_per_page' => 1
    );
    $existing_agents = get_posts($args);

    if (!empty($existing_agents)) {
        return $existing_agents[0]->ID;
    }

    // Crear un nuevo "agent"
    $agent_data = array(
        'post_title'  => $producer->name,
        'post_type'   => 'agent',
        'post_status' => 'publish'
    );
    $agent_id = wp_insert_post($agent_data);
    if (is_wp_error($agent_id)) {
        return false;
    }

    update_post_meta($agent_id, 'REAL_HOMES_whatsapp_number', $producer->cellphone);
    update_post_meta($agent_id, 'REAL_HOMES_agent_email', $producer->email);

    if ($producer->picture){
        descargar_imagen_y_agregar_a_medios($producer->picture, $agent_id);
    }

    return $agent_id;
}

/**
 * (OPCIONAL) Eliminar de la librería todos los attachments que se hayan creado con "url-base".
 * ¡Úsalo con cuidado!
 */
// function eliminar_medios_con_url_base() {
//     $args = array(
//         'post_type'   => 'attachment',
//         'numberposts' => -1,
//         'post_status' => 'any',
//         'meta_query'  => array(
//             array(
//                 'key'     => 'url-base',
//                 'compare' => 'EXISTS'
//             )
//         )
//     );
//     $attachments = get_posts($args);

//     foreach ($attachments as $attachment) {
//         wp_delete_attachment($attachment->ID, true);
//     }
//     echo "Medios con 'url-base' eliminados.";
// }
// eliminar_medios_con_url_base();





