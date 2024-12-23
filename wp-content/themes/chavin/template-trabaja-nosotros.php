<?php 
/* Template Name: pagina trabaja con nosotros*/
get_header('custom');

?>

<main class="pt-[71.55px] lg:pt-[95px]">
        <section class="degradado relative overflow-hidden w-full">
            <img src="<?php echo get_template_directory_uri(); ?>/img/flores-2.svg" alt="" class="absolute top-0 left-0" />
            <div class="h-full flex flex-col lg:flex-row justify-between items-center">
                <div class="lg:w-[55%] w-full pt-[50px] pb-[50px] md:pt-[150px] lg:pb-[150px] container-full">
                    <h3 class="text-[44px] font-medium text-center leading-tight" data-aos="fade-up"
                        data-aos-duration="1000" data-aos-once="true">
                        ¡Trabaja con nosotros!
                    </h3>
                    <div class="max-w-[466px] mx-auto mt-[45px]">
                        <form class="space-y-4 w-full" data-aos="fade-up" data-aos-duration="1000" data-aos-once="true">
                            <div class="w-full">
                                <input type="text" placeholder="Nombres completos" class="input-custom" />
                            </div>
                            <div class="w-full flex gap-4">
                                <input type="number" placeholder="Celular" class="input-custom" />
                            </div>
                            <div class="w-full">
                                <input type="email" placeholder="Correo" class="input-custom" />
                            </div>
                            <div class="w-full flex flex-col sm:flex-row gap-4">
                                        <div class="w-full relative">
                                            <div class="select-menu">
                                                <div class="select-btn">
                                                    <span class="sBtn-text">Selecciona un puesto de trabajo</span>
                                                    <i class="bx bx-chevron-down"></i>
                                                </div>

                                                <ul class="options">
                                                    <li class="option">
                                                        <span class="option-text">Productos congelados</span>
                                                    </li>
                                                    <li class="option">
                                                        <span class="option-text">Productos deshidratados</span>
                                                    </li>
                                                    <li class="option">
                                                        <span class="option-text">Productos mixtos</span>
                                                    </li>
                                                </ul>
                                            </div>
                                                <!-- <select class="input-custom appearance-none">
                                                    <option disabled selected>
                                                    Seleccionar tipo de producto
                                                    </option>
                                                    <option value="opcion1">Productos congelados</option>
                                                    <option value="opcion2">Productos deshidratados</option>
                                                    <option value="opcion2">Productos mixtos</option>
                                                </select>
                                                <div
                                                    class="absolute inset-y-0 right-2 flex items-center px-2 pointer-events-none"
                                                >
                                                    <svg
                                                    class="w-4 h-4 text-primaryBlue"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    fill="none"
                                                    viewBox="0 0 24 24"
                                                    stroke="currentColor"
                                                    >
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M19 9l-7 7-7-7"
                                                    />
                                                    </svg>
                                                </div> -->
                                        </div>

                                    </div>
                            <div class="flex gap-2 items-center">
                                <input id="file-upload" type="file" class="hidden" />
                                <label for="file-upload"
                                    class="block w-fit text-center border-[1px] border-primaryBlue text-primaryBlue py-2 px-3 rounded-[10px] cursor-pointer">
                                    Subir archivo
                                </label>
                                <span class="text-[16px] text-[#0200CD4D]">Formato PDF</span>
                            </div>
                            <div class="flex justify-start pt-[20px]">
                                <button type="submit" class="btn group">
                                    Enviar
                                    <img src="<?php echo get_template_directory_uri(); ?>/img/arrow.svg" alt=""
                                        class="transition-transform duration-300 group-hover:translate-x-1" />
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="lg:w-[45%] h-[500px] lg:h-full w-[100%]">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/chavin11.webp" alt=""
                        class="w-full h-full object-cover lg:rounded-[20px] 2xl:rounded-none object-top" />
                </div>
            </div>
        </section>
</main>
<script>
        const optionMenu = document.querySelector(".select-menu"),
            selectBtn = optionMenu.querySelector(".select-btn"),
            options = optionMenu.querySelectorAll(".option"),
            sBtn_text = optionMenu.querySelector(".sBtn-text");

        // Variable para almacenar la opción seleccionada
        let selectedOption = null;

        // Abre o cierra el menú de selección al hacer clic en el botón
        selectBtn.addEventListener("click", () => {
            optionMenu.classList.toggle("active");
            // Si el menú está abierto y no se ha seleccionado ninguna opción, muestra el texto por defecto
            if (!selectedOption) {
                sBtn_text.innerText = "Seleccionar tipo de producto";
            }
        });

        // Cambia el texto del botón al seleccionar una opción
        options.forEach((option) => {
            option.addEventListener("click", () => {
                // Elimina la clase "selected" de todas las opciones
                options.forEach((opt) => opt.classList.remove("selected"));

                // Agrega la clase "selected" a la opción seleccionada
                option.classList.add("selected");

                // Captura el texto de la opción seleccionada
                selectedOption = option.querySelector(".option-text").innerText;
                sBtn_text.innerText = selectedOption;

                // Cierra el menú después de seleccionar una opción
                optionMenu.classList.remove("active");
            });
        });

        // Cerrar el select si se hace clic fuera del contenedor
        document.addEventListener("click", (event) => {
            if (
                !optionMenu.contains(event.target) &&
                !selectBtn.contains(event.target)
            ) {
                optionMenu.classList.remove("active");
            }
        });
    </script>
    

<?php get_footer();?>