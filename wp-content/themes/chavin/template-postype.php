<?php
/**
 * Template Name: Listar CPTs
 * Description: Muestra todos los Custom Post Types registrados, junto con sus entradas.
 */

get_header();

// 1. Obtiene todos los post types que sean públicos y NO sean los incorporados por defecto (page, post, etc.).
$args = array(
    'public'   => true,
    '_builtin' => false,
);

$post_types = get_post_types($args, 'objects');

if ( ! empty( $post_types ) ):
    foreach ( $post_types as $cpt ) :
        // $cpt->name es el slug del Custom Post Type (ej. 'movies', 'books', etc.)
        ?>
        
        <section style="margin-bottom: 2rem;">
            <h2><?php echo esc_html( $cpt->labels->name ); ?></h2>
            <p><strong>Slug:</strong> <?php echo esc_html( $cpt->name ); ?></p>
            
            <?php
            // 2. Creamos una consulta de WP_Query para obtener todos los posts de este CPT.
            $cpt_query = new WP_Query( array(
                'post_type'      => $cpt->name,
                'posts_per_page' => -1,
            ) );

            if ( $cpt_query->have_posts() ) :
                echo '<ul>';
                while ( $cpt_query->have_posts() ) :
                    $cpt_query->the_post();
                    ?>
                    <li>
                        <a href="<?php the_permalink(); ?>">
                            <?php the_title(); ?>
                        </a>
                    </li>
                    <?php
                endwhile;
                echo '</ul>';
            else :
                echo '<p>No hay entradas para este CPT.</p>';
            endif;
            wp_reset_postdata();
            ?>
        </section>

        <?php
    endforeach;
else:
    echo '<p>No hay Custom Post Types públicos registrados (aparte de los nativos).</p>';
endif;

get_footer();