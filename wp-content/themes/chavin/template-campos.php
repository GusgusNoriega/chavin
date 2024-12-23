<?php
/**
 * Template Name: Mostrar primer Property (Campos y Taxonomías con Slugs)
 * Description: Muestra el primer "property", sus campos personalizados (clave y valor) y el slug de sus taxonomías.
 */

get_header();

// 1. Realizamos una consulta para obtener solo 1 'property'.
$args = array(
    'post_type'      => 'property',
    'posts_per_page' => 2,
    'post__in'       => array( 2640, 31 ), // reemplaza estos valores con los IDs deseados
    'orderby'        => 'post__in',        // esto asegura que respete el orden de 'post__in'
);

$query = new WP_Query( $args );

if ( $query->have_posts() ) :
    while ( $query->have_posts() ) :
        $query->the_post();
        
        // 2. Mostramos el título del CPT (property).
        echo '<h1>' . esc_html( get_the_title() ) . '</h1>';
        
        // 3. Obtenemos todos los campos personalizados (meta) de este post.
        //    Esto devolverá cualquier clave meta que exista en la base de datos,
        //    aunque su valor sea vacío (''), siempre y cuando se haya guardado al menos una vez.
        $all_meta = get_post_meta( get_the_ID() );

        if ( ! empty( $all_meta ) ) {
            echo '<h2>Campos personalizados (Meta)</h2>';
            echo '<ul>';
            foreach ( $all_meta as $meta_key => $meta_values ) {
                // $meta_values es un array por si el mismo key tuviera múltiples valores.
                // Normalmente es un solo valor, así que hacemos implode para mostrarlo.
                $values_string = implode(', ', $meta_values);

                // Mostramos la *clave* (meta_key) y su(s) valor(es).
                echo '<li>';
                echo '<strong>Clave:</strong> ' . esc_html($meta_key) . ' <br>';
                echo '<strong>Valor:</strong> ' . esc_html($values_string);
                echo '</li>';
            }
            echo '</ul>';
        } else {
            echo '<p>No hay campos personalizados en este "property".</p>';
        }

        // 4. Obtenemos todas las taxonomías registradas para 'property'.
        //    Por cada taxonomía, mostramos su "slug" (en WP es $tax->name) y los términos asignados.
        $taxonomies = get_object_taxonomies( 'property', 'objects' );

        if ( ! empty( $taxonomies ) ) {
            echo '<h2>Taxonomías</h2>';
            foreach ( $taxonomies as $tax ) {
                // $tax->name es el "slug" técnico de la taxonomía
                // (por ejemplo, "property_category", "property_tag", etc.).
                // Si quieres ver si tiene `rewrite['slug']`, podrías usar:
                // $tax_slug = isset($tax->rewrite['slug']) ? $tax->rewrite['slug'] : $tax->name;
                // Pero normalmente $tax->name es la forma de llamar la taxonomía en el código.
                $tax_slug = $tax->name;

                // Obtenemos los términos para este post en la taxonomía actual.
                $terms = get_the_terms( get_the_ID(), $tax_slug );

                echo '<div style="margin-bottom:1em;">';
                echo '<h3>' . esc_html( $tax->labels->name ) . '</h3>';
                echo '<p><strong>Slug de la taxonomía:</strong> ' . esc_html($tax_slug) . '</p>';

                if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
                    // Extrae los nombres de cada término y los muestra.
                    $term_names = wp_list_pluck( $terms, 'name' );
                    echo '<p><strong>Términos asignados:</strong> ' . esc_html( implode( ', ', $term_names ) ) . '</p>';
                } else {
                    echo '<p>No hay términos asignados en esta taxonomía.</p>';
                }
                echo '</div>';
            }
        } else {
            echo '<p>No hay taxonomías registradas para "property".</p>';
        }

    endwhile;
    wp_reset_postdata();
else :
    echo '<p>No se encontró ningún CPT "property".</p>';
endif;

get_footer();