<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/output.css" />
    <link href="https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css" rel="stylesheet" />
    <?php wp_head(); ?>
</head>

<body>
    <header id="home-header" class="z-[1000] fixed w-full bg-transparent transition-colors duration-700">
        <nav class="py-[10px] lg:py-[15px]" data-aos="fade-up" data-aos-duration="1000" data-aos-once="true">
            <div class="container-full flex items-center justify-between">
                <div>
                    <a href="/"><img src="<?php echo get_template_directory_uri(); ?>/img/logo.svg" alt="logo" class="w-[92px] lg:w-auto" /></a>
                </div>
                <!--<div id="menu" class="hidden xl:flex gap-6 text-white">
                    <a href="<?php echo home_url(); ?>/nosotros" class="text-lg font-normal link-border">Nosotros</a>
                    <a href="<?php echo home_url(); ?>/productos-congelados" class="text-lg font-normal link-border">
                        Productos congelados</a>
                    <a href="<?php echo home_url(); ?>/productos-deshidratados" class="text-lg font-normal link-border">Productos
                        deshidratados</a>
                    <a href="<?php echo home_url(); ?>/sostenibilidad" class="text-lg font-normal link-border">Sostenibilidad</a>
                    <a href="<?php echo home_url(); ?>/noticias" class="text-lg font-normal link-border">Noticias</a>
                    <a href="<?php echo home_url(); ?>/contactanos" class="text-lg font-normal link-border">Contáctanos</a>
                </div>-->
                <?php
                    wp_nav_menu( array(
                        'theme_location'    => 'menu_principal', // Ubicación del menú registrado
                        'container'         => 'div',             // Contenedor del menú
                        'container_id'      => 'menu',            // ID del contenedor
                        'container_class'   => 'hidden xl:flex gap-6 text-white', // Clases del contenedor
                        'menu_class'        => '',                // Clases del menú (vacío porque usamos un walker personalizado)
                        'fallback_cb'       => false,             // No mostrar nada si no hay menú asignado
                        'walker'            => new Walker_Menu_Principal(), // Walker personalizado
                        'items_wrap'        => '%3$s',
                    ) );
                ?>
                <div class="flex items-center text-white gap-4 language">
                    <button
                        class="lang-btn border-[#FFFFFF4F] hover:border-white transition-all duration-300 ease-in-out border-[1px] rounded-full w-[40px] h-[40px] lg:w-[46px] lg:h-[46px] items-center flex justify-center cursor-pointer">
                        ES
                    </button>
                    <button
                        class="lang-btn border-[#FFFFFF4F] hover:border-white transition-all duration-300 ease-in-out border-[1px] rounded-full w-[40px] h-[40px] lg:w-[46px] lg:h-[46px] items-center flex justify-center cursor-pointer">
                        EN
                    </button>
                    <div class="hidden md:flex">
                        <a href="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="35" height="36" viewBox="0 0 35 36"
                                fill="none" class="linkedin-icon group">
                                <path
                                    d="M11.667 28.3365H7.29199V13.7532H11.667V28.3365ZM27.7087 28.3365H23.3337V20.5461C23.3337 18.5161 22.6103 17.5055 21.1768 17.5055C20.0407 17.5055 19.3203 18.0713 18.9587 19.2044V28.3365H14.5837C14.5837 28.3365 14.642 15.2115 14.5837 13.7532H18.037L18.3039 16.6698H18.3943C19.2912 15.2115 20.7247 14.2228 22.6905 14.2228C24.1853 14.2228 25.3943 14.6384 26.3174 15.6825C27.2464 16.7282 27.7087 18.1311 27.7087 20.1013V28.3365Z"
                                    fill="white" class="group-hover:fill-primaryBlue" />
                                <path
                                    d="M9.47917 12.2949C10.7276 12.2949 11.7396 11.3155 11.7396 10.1074C11.7396 8.8993 10.7276 7.91992 9.47917 7.91992C8.23077 7.91992 7.21875 8.8993 7.21875 10.1074C7.21875 11.3155 8.23077 12.2949 9.47917 12.2949Z"
                                    fill="white" class="group-hover:fill-primaryBlue" />
                            </svg>
                        </a>
                    </div>
                    <div class="w-[30px] h-[20px] flex xl:hidden justify-start items-center">
                        <div class="relative w-full h-full">
                            <input type="checkbox" id="btn_menu" class="hidden" />
                            <label for="btn_menu" class="btn_menu z-30 cursor-pointer flex flex-col w-auto h-full">
                                <span id="btn_span_1" class="btn_span"></span>
                                <span id="btn_span_2" class="btn_span"></span>
                                <span id="btn_span_3" class="btn_span"></span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
        <div class="fixed inset-0 z-[1000] pointer-events-none">
            <div id="menu-responsive"
                class="mt-[72px] lg:mt-[95px] fixed bg-white transform translate-x-full transition-transform duration-300 ease-in-out h-full w-full pointer-events-auto">
                <div class="h-screen overflow-auto">
                    <div class="py-[20px] md:py-[30px] container-full">
                        <a href="<?php echo home_url(); ?>/nosotros" class="w-full flex justify-between items-center">
                            <p class="font-medium text-[16px] md:text-[20px] text-[#4F4F4F]">
                                Nosotros
                            </p>
                            <img src="<?php echo get_template_directory_uri(); ?>/img/arrow.svg" class="w-[18px] md:w-[26px]" />
                        </a>
                    </div>
                    <div class="py-[20px] md:py-[30px] container-full">
                        <a href="<?php echo home_url(); ?>/productos-congelados" class="w-full flex justify-between items-center">
                            <p class="font-normal md:font-medium text-[16px] md:text-[20px] text-[#4F4F4F]">
                                Productos congelados
                            </p>
                            <img src="<?php echo get_template_directory_uri(); ?>/img/arrow.svg" class="w-[18px] md:w-[26px]" />
                        </a>
                    </div>
                    <div class="py-[20px] md:py-[30px] container-full">
                        <a href="<?php echo home_url(); ?>/productos-deshidratados" class="w-full flex justify-between items-center">
                            <p class="font-normal md:font-medium text-[16px] md:text-[20px] text-[#4F4F4F]">
                                Productos deshidratados
                            </p>
                            <img src="<?php echo get_template_directory_uri(); ?>/img/arrow.svg" class="w-[18px] md:w-[26px]" />
                        </a>
                    </div>
                    <div class="py-[20px] md:py-[30px] container-full">
                        <a href="<?php echo home_url(); ?>/sostenibilidad" class="w-full flex justify-between items-center">
                            <p class="font-normal md:font-medium text-[16px] md:text-[20px] text-[#4F4F4F]">
                                Sostenibilidad
                            </p>
                            <img src="<?php echo get_template_directory_uri(); ?>/img/arrow.svg" class="w-[18px] md:w-[26px]" />
                        </a>
                    </div>
                    <div class="py-[20px] md:py-[30px] container-full">
                        <a href="<?php echo home_url(); ?>/noticias" class="w-full flex justify-between items-center">
                            <p class="font-normal md:font-medium text-[16px] md:text-[20px] text-[#4F4F4F]">
                                Noticias
                            </p>
                            <img src="<?php echo get_template_directory_uri(); ?>/img/arrow.svg" class="w-[18px] md:w-[26px]" />
                        </a>
                    </div>
                    <div class="py-[20px] md:py-[30px] container-full">
                        <a href="<?php echo home_url(); ?>/contactanos" class="w-full flex justify-between items-center">
                            <p class="font-normal md:font-medium text-[16px] md:text-[20px] text-[#4F4F4F]">
                                Contáctanos
                            </p>
                            <img src="<?php echo get_template_directory_uri(); ?>/img/arrow.svg" class="w-[18px] md:w-[26px]" />
                        </a>
                    </div>
                    <div class="container-full py-[40px] gap-[40px] justify-between flex flex-col">
                        <div class="flex flex-col gap-8 text-[#737375]">
                            <div class="inline-flex items-center gap-2 text-[14px] md:text-[16px]">
                                <img src="<?php echo get_template_directory_uri(); ?>/img/icon44.svg" alt="" />
                                <p>(051-1) 437-0240</p>
                            </div>
                            <div class="inline-flex items-center gap-2 text-[14px] md:text-[16px]">
                                <img src="<?php echo get_template_directory_uri(); ?>/img/icon33.svg" alt="" />
                                <p>
                                    Av. La Encalada 1420 OF.904 c.e Polo Humt II Surco - Lima
                                </p>
                            </div>
                            <a href="mailto:info@ibt.us"
                                class="inline-flex items-center gap-2 text-[14px] md:text-[16px]"><img
                                    src="<?php echo get_template_directory_uri(); ?>/img/icon22.svg" alt="" />
                                <p>ventas@agcchavin.com</p>
                            </a>
                        </div>
                        <div class="flex gap-4 items-center pb-[50px]">
                            <p class="text-[16px] text-primaryBlue font-normal">
                                Síguenos:
                            </p>
                            <div class="flex gap-3 md:gap-4">
                                <a href="" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/img/fb.svg" alt="" class="w-[40px] h-[40px]" /></a>
                                <a href="" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/img/youtube.svg" class="w-[40px] h-[40px]" /></a>
                                <a href="" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/img/linkedin.svg" alt=""
                                        class="w-[40px] h-[40px]" /></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
