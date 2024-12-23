<?php 

get_header('custom'); 

function agregar_clases_etiquetas($content) {
    // Reemplazar <p>
    $content = preg_replace(
        '/<p>/', 
        '<p class="font-dm text-[14px] md:text-[16px] font-normal mt-[40px] text-[#595959]" data-aos="fade-up" data-aos-duration="1000" data-aos-once="true">', 
        $content
    );

    // Reemplazar <h4>
    $content = preg_replace(
        '/<h4>/', 
        '<h4 class="font-beebo text-[20px] lg:text-[30px] font-medium mt-[40px] text-[#595959]" data-aos="fade-up" data-aos-duration="1000" data-aos-once="true">', 
        $content
    );

    // Reemplazar <ul>
    $content = preg_replace(
        '/<ul>/', 
        '<ul class="list-disc marker:text-primaryBlue marker:text-[25px] pl-6 mt-[10px] text-[#595959]" data-aos="fade-up" data-aos-duration="1000" data-aos-once="true">', 
        $content
    );

    return $content;
}
add_filter('the_content', 'agregar_clases_etiquetas', 20);
?>

<main class="pt-[71.55px] lg:pt-[95px]">
        <section>
            <div class="py-[50px] lg:py-[100px]">
                <h3 class="container-full text-[23px] md:text-[30px] lg:text-[44px] font-medium leading-tight text-center max-w-[1100px] mx-auto"
                    data-aos="fade-up" data-aos-duration="1000" data-aos-once="true">
                    Lorem ipsum dolor sit amet consectetur Lorem ipsum dolor sit amet
                    consectetur
                </h3>
                <?php
                $image = get_field('imagen'); // Ajusta el nombre del campo ACF

                if( $image ) {
                    // $image es un array con 'url', 'alt', 'title', 'width', 'height'
                    ?>
                    <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" class="w-full h-[304px] md:h-[399px] lg:h-[514px] object-cover mt-[50px]">
                    <?php
                }
                ?>
                
            </div>
        </section>
        <section>
            <div class="container-full lg:px-[100px]">
                <span class="font-dm text-[16px] font-normal text-[#595959]" data-aos="fade-up" data-aos-duration="1000"
                    data-aos-once="true"><?php echo get_the_date('d / m / Y'); ?></span>
                    <?php the_content(); ?>

                    <?php
                    $file_url = get_field('archivo'); // Reemplaza 'archivo' con el nombre de tu campo ACF

                    if( $file_url ) : ?>
                        <a class="btn mt-[40px]" href="<?php echo esc_url($file_url); ?>" data-aos="fade-up" data-aos-duration="1000" data-aos-once="true" download>Descargar PDF</a>
                    <?php endif; ?>
                
                <div class="border-b-[1px] border-primaryBlue w-full my-[40px]" data-aos="fade-up"
                    data-aos-duration="1000" data-aos-once="true"></div>
                <div class="flex gap-4 items-center" data-aos="fade-up" data-aos-duration="1000" data-aos-once="true">
                    <span class="text-primaryBlue text-[14px] md:text-[16px] font-bold">Compartir:</span>
                    <?php
                        $post_id = get_the_id();
                        echo chavin_share_buttons( $post_id );
                     ?>     
                </div>
            </div>
        </section>
        <section class="mt-[50px] sm:mt-[80px]">
            <div class="container-full">
                <div class="more-news">
                    <div class="flex justify-between items-center">
                        <h4 class="font-beebo text-[26px] md:text-[40px] font-medium text-black" data-aos="fade-up"
                            data-aos-duration="1000" data-aos-once="true">
                            Noticias relacionadas
                        </h4>
                        <div class="flex items-center gap-2 md:gap-4" data-aos="fade-up" data-aos-duration="1000"
                            data-aos-once="true">
                            <div
                                class="swiper-button-prev w-[38px] h-[38px] md:w-[48px] md:h-[48px] z-[2] after:content-none static mt-0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="51" height="50" viewBox="0 0 51 50"
                                    fill="none" class="transform rotate-[180deg]">
                                    <circle cx="25.5518" cy="25" r="24.3534" stroke="#0200CD" stroke-width="1.29311" />
                                    <path
                                        d="M26.6658 33.3681C26.5856 33.288 26.522 33.1929 26.4787 33.0883C26.4353 32.9836 26.4129 32.8715 26.4129 32.7582C26.4129 32.6449 26.4353 32.5327 26.4787 32.4281C26.522 32.3234 26.5856 32.2284 26.6658 32.1483L32.9531 25.8621L16.0694 25.8621C15.8408 25.8621 15.6216 25.7712 15.4599 25.6096C15.2982 25.4479 15.2074 25.2287 15.2074 25C15.2074 24.7714 15.2982 24.5522 15.4599 24.3905C15.6216 24.2288 15.8408 24.138 16.0694 24.138L32.9531 24.138L26.6658 17.8518C26.504 17.69 26.4131 17.4706 26.4131 17.2419C26.4131 17.0131 26.504 16.7938 26.6658 16.632C26.8275 16.4703 27.0469 16.3794 27.2756 16.3794C27.5044 16.3794 27.7238 16.4703 27.8855 16.632L35.6437 24.3902C35.7238 24.4702 35.7874 24.5653 35.8308 24.6699C35.8742 24.7746 35.8965 24.8868 35.8965 25C35.8965 25.1133 35.8742 25.2255 35.8308 25.3301C35.7874 25.4348 35.7238 25.5299 35.6437 25.6099L27.8855 33.3681C27.8055 33.4482 27.7104 33.5118 27.6057 33.5552C27.5011 33.5986 27.3889 33.6209 27.2756 33.6209C27.1624 33.6209 27.0502 33.5986 26.9455 33.5552C26.8409 33.5118 26.7458 33.4482 26.6658 33.3681Z"
                                        fill="#0200CD" />
                                </svg>
                            </div>
                            <div
                                class="swiper-button-next w-[38px] h-[38px] md:w-[48px] md:h-[48px] z-[2] after:content-none static mt-0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="51" height="50" viewBox="0 0 51 50"
                                    fill="none">
                                    <circle cx="25.5518" cy="25" r="24.3534" stroke="#0200CD" stroke-width="1.29311" />
                                    <path
                                        d="M26.6658 33.3681C26.5856 33.288 26.522 33.1929 26.4787 33.0883C26.4353 32.9836 26.4129 32.8715 26.4129 32.7582C26.4129 32.6449 26.4353 32.5327 26.4787 32.4281C26.522 32.3234 26.5856 32.2284 26.6658 32.1483L32.9531 25.8621L16.0694 25.8621C15.8408 25.8621 15.6216 25.7712 15.4599 25.6096C15.2982 25.4479 15.2074 25.2287 15.2074 25C15.2074 24.7714 15.2982 24.5522 15.4599 24.3905C15.6216 24.2288 15.8408 24.138 16.0694 24.138L32.9531 24.138L26.6658 17.8518C26.504 17.69 26.4131 17.4706 26.4131 17.2419C26.4131 17.0131 26.504 16.7938 26.6658 16.632C26.8275 16.4703 27.0469 16.3794 27.2756 16.3794C27.5044 16.3794 27.7238 16.4703 27.8855 16.632L35.6437 24.3902C35.7238 24.4702 35.7874 24.5653 35.8308 24.6699C35.8742 24.7746 35.8965 24.8868 35.8965 25C35.8965 25.1133 35.8742 25.2255 35.8308 25.3301C35.7874 25.4348 35.7238 25.5299 35.6437 25.6099L27.8855 33.3681C27.8055 33.4482 27.7104 33.5118 27.6057 33.5552C27.5011 33.5986 27.3889 33.6209 27.2756 33.6209C27.1624 33.6209 27.0502 33.5986 26.9455 33.5552C26.8409 33.5118 26.7458 33.4482 26.6658 33.3681Z"
                                        fill="#0200CD" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="swiper swiperNews mt-[50px] relative" data-aos="fade-up" data-aos-duration="1000"
                        data-aos-once="true">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <a href="/noticia-interna.html" class="block w-full group">
                                    <div
                                        class="flex flex-col items-center border border-[#0200CD] rounded-[10px] w-full">
                                        <div class="w-full h-[250px] overflow-hidden rounded-t-[10px]">
                                            <img src="<?php echo get_template_directory_uri(); ?>/img/new.webp" alt=""
                                                class="w-full h-full object-cover rounded-t-[10px] transition-transform duration-500 ease-in-out transform group-hover:scale-110" />
                                        </div>
                                        <div class="w-full p-[20px]">
                                            <span class="text-[#737375] font-dm text-[16px] font-normal leading-tight">
                                                20 / 03 / 2023
                                            </span>
                                            <h3
                                                class="text-[20px] md:text-[24px] xl:text-[30px] font-medium leading-tight group-hover:text-primaryBlue transition-colors ease-in-out duration-500 mt-[10px]">
                                                Lorem ipsum dolor sit amet consectetur Lorem ipsum
                                                dolor sit amet consectetur
                                            </h3>
                                            <p
                                                class="leading-tight text-[16px] font-normal text-[#595959] border-b border-[#0200CD] mt-[10px] pb-[20px]">
                                                Lorem ipsum dolor sit amet consectetur. Mauris urna
                                                massa lacus cursus pellentesque elit nec orci.
                                            </p>
                                            <div class="flex gap-4 mt-[20px]">
                                                <span class="text-primaryBlue text-[16px] font-bold">Compartir:</span>
                                                <div class="flex gap-4">
                                                    <!-- Iconos de redes sociales como botones -->
                                                    <button aria-label="Compartir en Facebook">
                                                        <img src="<?php echo get_template_directory_uri(); ?>/img/fb.svg" alt="Facebook" />
                                                    </button>
                                                    <button aria-label="Compartir en Twitter">
                                                        <img src="<?php echo get_template_directory_uri(); ?>/img/twitter.svg" alt="Twitter" />
                                                    </button>
                                                    <button aria-label="Compartir en LinkedIn">
                                                        <img src="<?php echo get_template_directory_uri(); ?>/img/linkedin.svg" alt="LinkedIn" />
                                                    </button>
                                                    <button aria-label="Copiar enlace">
                                                        <img src="<?php echo get_template_directory_uri(); ?>/img/link.svg" alt="Enlace" />
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="swiper-slide">
                                <a href="/noticia-interna.html" class="block w-full group">
                                    <div
                                        class="flex flex-col items-center border border-[#0200CD] rounded-[10px] w-full">
                                        <div class="w-full h-[250px] overflow-hidden rounded-t-[10px]">
                                            <img src="<?php echo get_template_directory_uri(); ?>/img/new.webp" alt=""
                                                class="w-full h-full object-cover rounded-t-[10px] transition-transform duration-500 ease-in-out transform group-hover:scale-110" />
                                        </div>
                                        <div class="w-full p-[20px]">
                                            <span class="text-[#737375] font-dm text-[16px] font-normal leading-tight">
                                                20 / 03 / 2023
                                            </span>
                                            <h3
                                                class="text-[20px] md:text-[24px] xl:text-[30px] font-medium leading-tight group-hover:text-primaryBlue transition-colors ease-in-out duration-500 mt-[10px]">
                                                Lorem ipsum dolor sit amet consectetur Lorem ipsum
                                                dolor sit amet consectetur
                                            </h3>
                                            <p
                                                class="leading-tight text-[16px] font-normal text-[#595959] border-b border-[#0200CD] mt-[10px] pb-[20px]">
                                                Lorem ipsum dolor sit amet consectetur. Mauris urna
                                                massa lacus cursus pellentesque elit nec orci.
                                            </p>
                                            <div class="flex gap-4 mt-[20px]">
                                                <span class="text-primaryBlue text-[16px] font-bold">Compartir:</span>
                                                <div class="flex gap-4">
                                                    <!-- Iconos de redes sociales como botones -->
                                                    <button aria-label="Compartir en Facebook">
                                                        <img src="<?php echo get_template_directory_uri(); ?>/img/fb.svg" alt="Facebook" />
                                                    </button>
                                                    <button aria-label="Compartir en Twitter">
                                                        <img src="<?php echo get_template_directory_uri(); ?>/img/twitter.svg" alt="Twitter" />
                                                    </button>
                                                    <button aria-label="Compartir en LinkedIn">
                                                        <img src="<?php echo get_template_directory_uri(); ?>/img/linkedin.svg" alt="LinkedIn" />
                                                    </button>
                                                    <button aria-label="Copiar enlace">
                                                        <img src="<?php echo get_template_directory_uri(); ?>/img/link.svg" alt="Enlace" />
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="swiper-slide">
                                <a href="/noticia-interna.html" class="block w-full group">
                                    <div
                                        class="flex flex-col items-center border border-[#0200CD] rounded-[10px] w-full">
                                        <div class="w-full h-[250px] overflow-hidden rounded-t-[10px]">
                                            <img src="<?php echo get_template_directory_uri(); ?>/img/new.webp" alt=""
                                                class="w-full h-full object-cover rounded-t-[10px] transition-transform duration-500 ease-in-out transform group-hover:scale-110" />
                                        </div>
                                        <div class="w-full p-[20px]">
                                            <span class="text-[#737375] font-dm text-[16px] font-normal leading-tight">
                                                20 / 03 / 2023
                                            </span>
                                            <h3
                                                class="text-[20px] md:text-[24px] xl:text-[30px] font-medium leading-tight group-hover:text-primaryBlue transition-colors ease-in-out duration-500 mt-[10px]">
                                                Lorem ipsum dolor sit amet consectetur Lorem ipsum
                                                dolor sit amet consectetur
                                            </h3>
                                            <p
                                                class="leading-tight text-[16px] font-normal text-[#595959] border-b border-[#0200CD] mt-[10px] pb-[20px]">
                                                Lorem ipsum dolor sit amet consectetur. Mauris urna
                                                massa lacus cursus pellentesque elit nec orci.
                                            </p>
                                            <div class="flex gap-4 mt-[20px]">
                                                <span class="text-primaryBlue text-[16px] font-bold">Compartir:</span>
                                                <div class="flex gap-4">
                                                    <!-- Iconos de redes sociales como botones -->
                                                    <button aria-label="Compartir en Facebook">
                                                        <img src="<?php echo get_template_directory_uri(); ?>/img/fb.svg" alt="Facebook" />
                                                    </button>
                                                    <button aria-label="Compartir en Twitter">
                                                        <img src="<?php echo get_template_directory_uri(); ?>/img/twitter.svg" alt="Twitter" />
                                                    </button>
                                                    <button aria-label="Compartir en LinkedIn">
                                                        <img src="<?php echo get_template_directory_uri(); ?>/img/linkedin.svg" alt="LinkedIn" />
                                                    </button>
                                                    <button aria-label="Copiar enlace">
                                                        <img src="<?php echo get_template_directory_uri(); ?>/img/link.svg" alt="Enlace" />
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="swiper-slide">
                                <a href="/noticia-interna.html" class="block w-full group">
                                    <div
                                        class="flex flex-col items-center border border-[#0200CD] rounded-[10px] w-full">
                                        <div class="w-full h-[250px] overflow-hidden rounded-t-[10px]">
                                            <img src="<?php echo get_template_directory_uri(); ?>/img/new.webp" alt=""
                                                class="w-full h-full object-cover rounded-t-[10px] transition-transform duration-500 ease-in-out transform group-hover:scale-110" />
                                        </div>
                                        <div class="w-full p-[20px]">
                                            <span class="text-[#737375] font-dm text-[16px] font-normal leading-tight">
                                                20 / 03 / 2023
                                            </span>
                                            <h3
                                                class="text-[20px] md:text-[24px] xl:text-[30px] font-medium leading-tight group-hover:text-primaryBlue transition-colors ease-in-out duration-500 mt-[10px]">
                                                Lorem ipsum dolor sit amet consectetur Lorem ipsum
                                                dolor sit amet consectetur
                                            </h3>
                                            <p
                                                class="leading-tight text-[16px] font-normal text-[#595959] border-b border-[#0200CD] mt-[10px] pb-[20px]">
                                                Lorem ipsum dolor sit amet consectetur. Mauris urna
                                                massa lacus cursus pellentesque elit nec orci.
                                            </p>
                                            <div class="flex gap-4 mt-[20px]">
                                                <span class="text-primaryBlue text-[16px] font-bold">Compartir:</span>
                                                <div class="flex gap-4">
                                                    <!-- Iconos de redes sociales como botones -->
                                                    <button aria-label="Compartir en Facebook">
                                                        <img src="<?php echo get_template_directory_uri(); ?>/img/fb.svg" alt="Facebook" />
                                                    </button>
                                                    <button aria-label="Compartir en Twitter">
                                                        <img src="<?php echo get_template_directory_uri(); ?>/img/twitter.svg" alt="Twitter" />
                                                    </button>
                                                    <button aria-label="Compartir en LinkedIn">
                                                        <img src="<?php echo get_template_directory_uri(); ?>/img/linkedin.svg" alt="LinkedIn" />
                                                    </button>
                                                    <button aria-label="Copiar enlace">
                                                        <img src="<?php echo get_template_directory_uri(); ?>/img/link.svg" alt="Enlace" />
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="swiper-slide">
                                <a href="/noticia-interna.html" class="block w-full group">
                                    <div
                                        class="flex flex-col items-center border border-[#0200CD] rounded-[10px] w-full">
                                        <div class="w-full h-[250px] overflow-hidden rounded-t-[10px]">
                                            <img src="<?php echo get_template_directory_uri(); ?>/img/new.webp" alt=""
                                                class="w-full h-full object-cover rounded-t-[10px] transition-transform duration-500 ease-in-out transform group-hover:scale-110" />
                                        </div>
                                        <div class="w-full p-[20px]">
                                            <span class="text-[#737375] font-dm text-[16px] font-normal leading-tight">
                                                20 / 03 / 2023
                                            </span>
                                            <h3
                                                class="text-[20px] md:text-[24px] xl:text-[30px] font-medium leading-tight group-hover:text-primaryBlue transition-colors ease-in-out duration-500 mt-[10px]">
                                                Lorem ipsum dolor sit amet consectetur Lorem ipsum
                                                dolor sit amet consectetur
                                            </h3>
                                            <p
                                                class="leading-tight text-[16px] font-normal text-[#595959] border-b border-[#0200CD] mt-[10px] pb-[20px]">
                                                Lorem ipsum dolor sit amet consectetur. Mauris urna
                                                massa lacus cursus pellentesque elit nec orci.
                                            </p>
                                            <div class="flex gap-4 mt-[20px]">
                                                <span class="text-primaryBlue text-[16px] font-bold">Compartir:</span>
                                                <div class="flex gap-4">
                                                    <!-- Iconos de redes sociales como botones -->
                                                    <button aria-label="Compartir en Facebook">
                                                        <img src="<?php echo get_template_directory_uri(); ?>/img/fb.svg" alt="Facebook" />
                                                    </button>
                                                    <button aria-label="Compartir en Twitter">
                                                        <img src="<?php echo get_template_directory_uri(); ?>/img/twitter.svg" alt="Twitter" />
                                                    </button>
                                                    <button aria-label="Compartir en LinkedIn">
                                                        <img src="<?php echo get_template_directory_uri(); ?>/img/linkedin.svg" alt="LinkedIn" />
                                                    </button>
                                                    <button aria-label="Copiar enlace">
                                                        <img src="<?php echo get_template_directory_uri(); ?>/img/link.svg" alt="Enlace" />
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php get_template_part('template-part/seccion-contacto'); ?>
</main>

<?php get_footer(); ?>