<?php
/*
Template Name: Plantilla de propiedades
*/
get_header(); ?>

<main id="main" class="site-main">

    <?php
    // Start the loop.
    while ( have_posts() ) :
        the_post();
	     $destacado = get_field('destacado');
	     $venta = get_field('venta');
	     $alquiler = get_field('alquiler');
	     $precio_dolares = get_field('price');
	     $precio_argentino = get_field('precio_argentino');
	     $imagen_principal = get_field('imagen_principal');
	     $imagenes_array = get_field('fotos');
	     $tipo_de_propiedad = get_field('tipo_de_propiedad');
	     $ambientes_numero = get_field('ambientes_numero');
	     $cubierta =  get_field('roofed_surface');
	     $banos =  get_field('bedrooms');
	     $total_construido = get_field('total_surface');
	     $habitaciones = get_field('bedrooms');
	     $direccion = get_field('address');
	     $servicios = get_field('servicios');
	     $ambientes = get_field('ambientes');
	     $adicionales = get_field('adicionales');
    ?>
        
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <header class="entry-header">
				<div class="entry-botones-superiores-propiedad">
					<a href="https://propiedades.castillapropiedades.com.ar/Propiedades">
						<div class="entry-botones-superiores-propiedad-volver">
						  <span class="dashicons dashicons-undo"></span>
						  <span class="volver-propiedades">Volver a </br>resultados</span>
						</div>
				    </a>
				    <div class="entry-botones-superiores-propiedad-favorito">
				    <?php
				    if ($destacado) {
					   echo '<span class="dashicons dashicons-star-filled"></span>'; 
					} else {
					   echo '<span class="dashicons dashicons-star-empty"></span>';
					}
				     ?>
					</div>
				    <div class="entry-botones-superiores-propiedad-fotos-videos">
						<div class="entry-botones-superiores-propiedad-fotos">
					       <span class="dashicons dashicons-camera-alt"></span>
						   <span class="volver-propiedades">Ver</br>fotos</span>
						</div>
				        			   					
				    </div>
				</div>
                <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
                 <div class="entry-precios-venta-alquiler">
					   <?php
						if ($venta) {
						   echo '<div class="entry-precios-venta">
									  <div class="entry-precios-venta-cont-venta-titulo">
										 <h2>Venta</h2>
									  </div>
									  <div class="entry-precios-venta-cont-venta-precio">
										 <p>Precio USD ' . $precio_dolares . '</p>';
							          if ($precio_argentino) {
										 echo '<p>Precio ARG' . $precio_argentino . '</p>';
										 }				  
								  echo '</div></div>'; 
						 } 
					     if ($alquiler) {
						   echo '<div class="entry-precios-alquiler">
									  <div class="entry-precios-alquiler-cont-alquiler-titulo">
										 <h2>Alquiler</h2>
									  </div>
									  <div class="entry-precios-alquiler-cont-alquiler-precio">
										 	 <p>Precio USD ' . $precio_dolares . '</p>';
							          if ($precio_argentino) {
										 echo '<p>Precio ARG' . $precio_argentino . '</p>';
										 }				  
								  echo '</div></div>'; 
						 } 
					   ?>
				 
				 </div>
            </header><!-- .entry-header -->
            <div class="entry-content">
				<div class="entry-content-left">
					<div class="entry-content-left-slider">
						<div class="slider">
							<?php  if ($venta) { echo '<img src="' . $imagen_principal . '" class="slide">'; } 	   
							
							foreach ($imagenes_array as $elemento) {
										// Mostrar cada elemento en un párrafo
										echo '<img src="' . $elemento . '" class="slide">';
									}
							?>
	
						   <button class="prev">Anterior</button>
						  <button class="next">Siguiente</button>
						</div>
						
				     </div>
					 
						<?php
					    if ($servicios) {
						 echo '<div class="entry-content-left-contenedor"><h2>servicios</h2>
						 <div class="entry-content-left-contenedor-info">';
						 foreach ($servicios as $servicio) {
										// Mostrar cada elemento en un párrafo
							             echo '<div class="entry-content-left-contenedor-item">
								           <span class="dashicons dashicons-saved"></span>
								           <span class="entry-content-contenedor-item-titulo">' . $servicio . '</span>
							              </div>';
										
									}
												
						 echo '</div></div>';
							}
					   if ($ambientes) {
						 echo '<div class="entry-content-left-contenedor"><h2>Ambientes</h2>
						 <div class="entry-content-left-contenedor-info">';
						 foreach ($ambientes as $ambiente) {
										// Mostrar cada elemento en un párrafo
							             echo '<div class="entry-content-left-contenedor-item">
								           <span class="dashicons dashicons-saved"></span>
								           <span class="entry-content-contenedor-item-titulo">' . $ambiente . '</span>
							              </div>';
										
									}
												
						 echo '</div></div>';
							}
					if ($adicionales) {
						 echo '<div class="entry-content-left-contenedor"><h2>Adicionales</h2>
						 <div class="entry-content-left-contenedor-info">';
						 foreach ($adicionales as $adicional) {
										// Mostrar cada elemento en un párrafo
							             echo '<div class="entry-content-left-contenedor-item">
								           <span class="dashicons dashicons-saved"></span>
								           <span class="entry-content-contenedor-item-titulo">' . $adicional . '</span>
							              </div>';
										
									}
												
						 echo '</div></div>';
							}
					?>
					
					 <div class="entry-content-left-contenedor">
						<h2>Descripcion</h2>
						 <?php the_content(); ?>
				     </div>			
				</div>
				 <div class="entry-content-right">
					 <div class="entry-content-right-contenedor-content">
					   <div>
						<div class="content-right-contenedor-content-item">
                          <span class="content-right-contenedor-content-item-titulo">Tipo de propiedad</span>
						  <span class="content-right-contenedor-content-item-contenido"><?php echo $tipo_de_propiedad  ?>                             </span>
				        </div>
						<div class="content-right-contenedor-content-item">
                          <span class="content-right-contenedor-content-item-titulo">Ambientes</span>
						  <span class="content-right-contenedor-content-item-contenido"><?php echo $ambientes_numero  ?>                             </span>
				        </div>
						 <div class="content-right-contenedor-content-item">
                          <span class="content-right-contenedor-content-item-titulo">Cubierta total</span>
						  <span class="content-right-contenedor-content-item-contenido"><?php echo $cubierta  ?></span>
				        </div>
						 <div class="content-right-contenedor-content-item">
                          <span class="content-right-contenedor-content-item-titulo">Baños</span>
						  <span class="content-right-contenedor-content-item-contenido"><?php echo $banos ?></span>
				        </div>
						 <div class="content-right-contenedor-content-item">
                          <span class="content-right-contenedor-content-item-titulo">Total construido</span>
						  <span class="content-right-contenedor-content-item-contenido"><?php echo $total_construido ?>                               </span>
				        </div>
						 <div class="content-right-contenedor-content-item">
                          <span class="content-right-contenedor-content-item-titulo">Habitaciones</span>
						  <span class="content-right-contenedor-content-item-contenido"><?php echo $habitaciones ?></span>
				        </div>
						 <div class="content-right-contenedor-content-item">
                          <span class="content-right-contenedor-content-item-titulo">Direcciòn</span>
						  <span class="content-right-contenedor-content-item-contenido"><?php echo $direccion ?></span>
				        </div>
				     </div>
				   </div>
				</div>
			</div>	
        </article><!-- #post-<?php the_ID(); ?> -->

    <?php endwhile; ?>

</main><!-- #main -->

<?php get_footer(); ?>
<?php if ( is_singular( 'propiedades' ) ) : // Verificar si se está utilizando la plantilla "template-eventos.php" ?>
    <script>
        // Aquí va tu script JS
        const slides = document.querySelectorAll('.slide');
const prev = document.querySelector('.prev');
const next = document.querySelector('.next');
let currentSlide = 0;

// Mostrar la primera imagen al cargar la página
slides[currentSlide].classList.add('active');

// Función para mostrar la siguiente imagen
function nextSlide() {
  slides[currentSlide].classList.remove('active');
  currentSlide = (currentSlide + 1) % slides.length;
  slides[currentSlide].classList.add('active');
}

// Función para mostrar la imagen anterior
function prevSlide() {
  slides[currentSlide].classList.remove('active');
  currentSlide = (currentSlide - 1 + slides.length) % slides.length;
  slides[currentSlide].classList.add('active');
}

// Agregar eventos click a los botones
next.addEventListener('click', nextSlide);
prev.addEventListener('click', prevSlide);
    </script>
<?php endif; ?>