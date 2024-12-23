<?php 
/* Template Name: pagina noticias */

get_header('custom');

?>

<main class="pt-[71.55px] lg:pt-[95px]">
        <section>
            <div class="py-[40px] md:py-[80px] lg:py-[100px] container-full">
                <h3 class="text-[23px] md:text-[30px] lg:text-[44px] font-medium leading-tight text-center"
                    data-aos="fade-up" data-aos-duration="1000" data-aos-once="true">
                    <?php 
                    $titulo = get_the_title();
                    echo $titulo;
                    ?>
                </h3>
                <p class="text-[14px] md:text-[16px] font-normal font-dm text-[#595959] mt-[20px] text-center max-w-[730px] mx-auto"
                    data-aos="fade-up" data-aos-duration="1000" data-aos-once="true">
                    <?php 
                    $content = get_the_content();
                    echo $content;
                    ?>
                </p>
            </div>
        </section>
        <section class="hidden 2xl:flex">
            <div class="container-full">
                <a href="/noticia-interna.html" class="block group">
                    <div class="flex items-center border border-[#0200CD] rounded-[10px] max-h-[368px]"
                        data-aos="fade-up" data-aos-duration="1000" data-aos-once="true">
                        <div class="w-[595px] h-[368px] overflow-hidden rounded-l-[10px]">
                            <img src="<?php echo get_template_directory_uri(); ?>/img/new.webp" alt=""
                                class="w-full h-full object-cover rounded-l-[10px] transition-transform duration-500 ease-in-out transform group-hover:scale-110" />
                        </div>
                        <div class="w-[calc(100%-595px)] pl-[50px] pr-[60px]">
                            <span class="text-[#737375] font-dm text-[16px] font-normal leading-tight">20 / 03 /
                                2023</span>
                            <h3
                                class="text-[20px] md:text-[24px] xl:text-[30px] font-medium leading-tight group-hover:text-primaryBlue transition-colors ease-in-out duration-500 mt-[30px]">
                                Lorem ipsum dolor sit amet consectetur Lorem ipsum dolor sit
                                amet consectetur
                            </h3>
                            <p
                                class="leading-tight text-[16px] font-normal text-[#595959] border-b border-[#0200CD] mt-[10px] pb-[30px]">
                                Lorem ipsum dolor sit amet consectetur. Mauris urna massa
                                lacus cursus pellentesque elit nec orci. Fringilla massa
                                dignissim nunc cursus pellentesque elit nec orci. Fringilla
                                massa dignissim nunc
                            </p>
                            <div class="flex gap-4 mt-[30px] items-center">
                                <span class="text-primaryBlue text-[16px] font-bold">Compartir:</span>
                                <div class="flex gap-6">
                                    <!-- Iconos de redes sociales como botones -->
                                    <button aria-label="Compartir en Facebook">
                                        <img src="<?php echo get_template_directory_uri(); ?>/img/fb.svg" alt="Facebook" class="w-[35px] h-[35px]" />
                                    </button>
                                    <button aria-label="Compartir en Twitter">
                                        <img src="<?php echo get_template_directory_uri(); ?>/img/twitter.svg" alt="Twitter" class="w-[35px] h-[35px]" />
                                    </button>
                                    <button aria-label="Compartir en LinkedIn">
                                        <img src="<?php echo get_template_directory_uri(); ?>/img/linkedin.svg" alt="LinkedIn" class="w-[35px] h-[35px]" />
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </section>
        <section class="xl:my-[50px]">
            <div class="container-full">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-[36px]" data-aos="fade-up"
                    data-aos-duration="1000" data-aos-once="true">
                    <a href="/noticia-interna.html" class="block w-full group">
                        <div class="flex flex-col items-center border border-[#0200CD] rounded-[10px] w-full">
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
                                    Lorem ipsum dolor sit amet consectetur Lorem ipsum dolor sit
                                    amet consectetur
                                </h3>
                                <p
                                    class="leading-tight text-[16px] font-normal text-[#595959] border-b border-[#0200CD] mt-[10px] pb-[20px]">
                                    Lorem ipsum dolor sit amet consectetur. Mauris urna massa
                                    lacus cursus pellentesque elit nec orci.
                                </p>
                                <div class="flex gap-4 mt-[20px] items-center">
                                    <span class="text-primaryBlue text-[16px] font-bold">Compartir:</span>
                                    <div class="flex gap-4">
                                        <!-- Iconos de redes sociales como botones -->
                                        <button aria-label="Compartir en Facebook">
                                            <img src="<?php echo get_template_directory_uri(); ?>/img/fb.svg" alt="Facebook" class="w-[35px] h-[35px]" />
                                        </button>
                                        <button aria-label="Compartir en Twitter">
                                            <img src="<?php echo get_template_directory_uri(); ?>/img/twitter.svg" alt="Twitter" class="w-[35px] h-[35px]" />
                                        </button>
                                        <button aria-label="Compartir en LinkedIn">
                                            <img src="<?php echo get_template_directory_uri(); ?>/img/linkedin.svg" alt="LinkedIn" class="w-[35px] h-[35px]" />
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>

                    <a href="/noticia-interna.html" class="block w-full group">
                        <div class="flex flex-col items-center border border-[#0200CD] rounded-[10px] w-full">
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
                                    Lorem ipsum dolor sit amet consectetur Lorem ipsum dolor sit
                                    amet consectetur
                                </h3>
                                <p
                                    class="leading-tight text-[16px] font-normal text-[#595959] border-b border-[#0200CD] mt-[10px] pb-[20px]">
                                    Lorem ipsum dolor sit amet consectetur. Mauris urna massa
                                    lacus cursus pellentesque elit nec orci.
                                </p>
                                <div class="flex gap-4 mt-[20px] items-center">
                                    <span class="text-primaryBlue text-[16px] font-bold">Compartir:</span>
                                    <div class="flex gap-4">
                                        <!-- Iconos de redes sociales como botones -->
                                        <button aria-label="Compartir en Facebook">
                                            <img src="<?php echo get_template_directory_uri(); ?>/img/fb.svg" alt="Facebook" class="w-[35px] h-[35px]" />
                                        </button>
                                        <button aria-label="Compartir en Twitter">
                                            <img src="<?php echo get_template_directory_uri(); ?>/img/twitter.svg" alt="Twitter" class="w-[35px] h-[35px]" />
                                        </button>
                                        <button aria-label="Compartir en LinkedIn">
                                            <img src="<?php echo get_template_directory_uri(); ?>/img/linkedin.svg" alt="LinkedIn" class="w-[35px] h-[35px]" />
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>

                    <a href="/noticia-interna.html" class="block w-full group">
                        <div class="flex flex-col items-center border border-[#0200CD] rounded-[10px] w-full">
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
                                    Lorem ipsum dolor sit amet consectetur Lorem ipsum dolor sit
                                    amet consectetur
                                </h3>
                                <p
                                    class="leading-tight text-[16px] font-normal text-[#595959] border-b border-[#0200CD] mt-[10px] pb-[20px]">
                                    Lorem ipsum dolor sit amet consectetur. Mauris urna massa
                                    lacus cursus pellentesque elit nec orci.
                                </p>
                                <div class="flex gap-4 mt-[20px] items-center">
                                    <span class="text-primaryBlue text-[16px] font-bold">Compartir:</span>
                                    <div class="flex gap-4">
                                        <!-- Iconos de redes sociales como botones -->
                                        <button aria-label="Compartir en Facebook">
                                            <img src="<?php echo get_template_directory_uri(); ?>/img/fb.svg" alt="Facebook" class="w-[35px] h-[35px]" />
                                        </button>
                                        <button aria-label="Compartir en Twitter">
                                            <img src="<?php echo get_template_directory_uri(); ?>/img/twitter.svg" alt="Twitter" class="w-[35px] h-[35px]" />
                                        </button>
                                        <button aria-label="Compartir en LinkedIn">
                                            <img src="<?php echo get_template_directory_uri(); ?>/img/linkedin.svg" alt="LinkedIn" class="w-[35px] h-[35px]" />
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="flex justify-center items-center mt-[50px]" data-aos="fade-up" data-aos-duration="1000"
                    data-aos-once="true">
                    <button class="btn-third group">
                        Ver más
                        <img src="<?php echo get_template_directory_uri(); ?>/img/arrow.svg" alt=""
                            class="transition-transform duration-300 group-hover:translate-x-1" />
                    </button>
                </div>
            </div>
        </section>
        <section class="mt-[40px] md:mt-[80px] lg:mt-[120px] bg-[#0200CD]">
            <div class="relative py-[80px]">
                <img src="<?php echo get_template_directory_uri(); ?>/img/bg-hoja.svg" alt="" class="absolute top-0 w-full h-full object-cover" />
                <div class="relative z-10 flex items-center flex-col justify-center container-full text-center">
                    <h3 class="text-[23px] md:text-[30px] lg:text-[44px] leading-tight font-bold text-white">
                        ¡Escríbenos! te contactaremos
                    </h3>
                    <p class="text-[16px] font-normal text-white font-dm mt-[10px]">
                        Ponte en contacto con nosotros y descubre la calidad de nuestras
                        frutas locales.
                    </p>
                    <a href="/contactanos.html" class="btn mt-[20px] group">Contáctanos
                        <img src="<?php echo get_template_directory_uri(); ?>/img/arrow.svg" alt=""
                            class="transition-transform duration-300 group-hover:translate-x-1" /></a>
                </div>
            </div>
        </section>
</main>
   



<?php get_footer('custom');?>