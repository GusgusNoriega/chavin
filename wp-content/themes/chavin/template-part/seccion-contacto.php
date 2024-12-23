<?php
// Recuperar los campos desde la página de opciones
$imagen_fondo_contacto    = get_field('imagen_fondo_contacto', 'option');
$titulo_banner_contacto   = get_field('titulo_banner_contacto', 'option');
$texto_banner_contacto    = get_field('texto_banner_contacto', 'option');
$texto_boton_contacto     = get_field('texto_boton_contacto', 'option');
$enlace_boton_contacto    = get_field('enlace_boton_contacto', 'option');

?>
<section class="mt-[40px] md:mt-[80px] lg:mt-[120px] bg-[#0200CD]">
    <div class="relative py-[80px]">
        <?php
                    if( $imagen_fondo_contacto ) {
                        $imagen_url = esc_url($imagen_fondo_contacto['url']);
                        $imagen_alt = esc_attr($imagen_fondo_contacto['alt']);
                        $imagen = '<img src="' . $imagen_url . '" alt="' . $imagen_alt . '"
                class="absolute top-1/2 left-1/2 transform -translate-x-1/2  -translate-y-1/2 h-full object-cover" />';
                       echo $imagen;
                    }
                ?>
        <div class="relative z-10 flex items-center flex-col justify-center container-full text-center">
            <h3 class="text-[23px] md:text-[30px] lg:text-[44px] leading-tight font-bold text-white">
                <?php echo $titulo_banner_contacto;?>
            </h3>
            <p class="text-[16px] font-normal text-white font-dm mt-[10px]">
                <?php echo $texto_banner_contacto;?>
            </p>
            <a href="<?php echo $enlace_boton_contacto;?>" class="btn mt-[20px] group">
                <?php echo $texto_boton_contacto;?>
                <img src="<?php echo get_template_directory_uri(); ?>/img/arrow.svg" alt=""
                    class="transition-transform duration-300 group-hover:translate-x-1" /></a>
        </div>
    </div>
</section>
