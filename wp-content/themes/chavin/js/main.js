document.addEventListener("DOMContentLoaded", function () {
  AOS.init();
  const currentPath = window.location.pathname;
  const menuLinks = document.querySelectorAll("#menu a");

  const currentPage = currentPath.substring(currentPath.lastIndexOf("/") + 1);
  menuLinks.forEach((link) => {
    // Verifica si el pathname del enlace coincide con la ruta actual
    if (new URL(link.href).pathname === currentPath) {
      link.classList.add("link-border-active"); // Agrega la clase si coincide
    }
  });

  const btnMenu = document.getElementById("btn_menu");
  const menuResponsive = document.getElementById("menu-responsive");

  if (btnMenu && menuResponsive) {
    btnMenu.addEventListener("change", function () {
      if (btnMenu.checked) {
        menuResponsive.classList.remove("translate-x-full");
        menuResponsive.classList.add("translate-x-0");
        document.body.classList.add("overflow-hidden");
      } else {
        menuResponsive.classList.remove("translate-x-0");
        menuResponsive.classList.add("translate-x-full");
        document.body.classList.remove("overflow-hidden");
      }
    });
  }

  const MyApp = {
    swiperImg: {
      init: function () {
        new Swiper(".swiperImg", {
          slidesPerView: 3.4,
          spaceBetween: 10,
          navigation: {
            nextEl: ".swiper-img-btn .swiper-button-next",
            prevEl: ".swiper-img-btn .swiper-button-prev",
          },
          breakpoints: {
            0: {
              slidesPerView: 1.4,
            },
            768: {
              slidesPerView: 2.4,
            },
            1024: {
              slidesPerView: 3.4,
            },
          },
        });
      },
    },
    swiperHitos: {
      init: function () {
        new Swiper(".swiperHitos", {
          slidesPerView: 4,
          spaceBetween: 0,
          navigation: {
            nextEl: ".swiper-hitos-btn .swiper-button-next",
            prevEl: ".swiper-hitos-btn .swiper-button-prev",
          },
          breakpoints: {
            0: {
              slidesPerView: 1,
            },
            768: {
              slidesPerView: 2,
            },
            1024: {
              slidesPerView: 3,
            },
            1280: {
              slidesPerView: 4,
            },
          },
        });
      },
    },
    swiperTypeOf: {
      init: function () {
        new Swiper(".swiperTypeOf", {
          slidesPerView: 6,
          spaceBetween: 0,
          navigation: {
            nextEl: ".swiper-Type-Of .swiper-button-next",
            prevEl: ".swiper-Type-Of .swiper-button-prev",
          },
          breakpoints: {
            0: {
              slidesPerView: 2,
            },
            768: {
              slidesPerView: 4,
            },
            1024: {
              slidesPerView: 5,
            },
            1280: {
              slidesPerView: 6,
            },
          },
        });
      },
    },
    swiperSocialProjects: {
      init: function () {
        new Swiper(".swiperSocialProjects", {
          slidesPerView: 1,
          spaceBetween: 40,
          navigation: {
            prevEl: ".swiper-Social-Projects .swiper-button-prev",
            nextEl: ".swiper-Social-Projects .swiper-button-next",
          },
          pagination: {
            el: ".swiper-pagination",
            type: "fraction",
          },
          allowTouchMove: true,
          breakpoints: {
            0: {
              spaceBetween: 40,
            },
            768: {
              spaceBetween: 0,
            },
          },

          autoplay: {
            delay: 8000,
          },
          speed: 800,
          loop: false,
        });
      },
    },

    swiperNews: {
      init: function () {
        new Swiper(".swiperNews", {
          slidesPerView: 3,
          spaceBetween: 30,
          navigation: {
            prevEl: ".more-news .swiper-button-prev",
            nextEl: ".more-news .swiper-button-next",
          },
          breakpoints: {
            0: {
              slidesPerView: 1,
            },
            768: {
              slidesPerView: 2,
            },
            1024: {
              slidesPerView: 3,
            },
          },
        });
      },
    },
  };

  if (document.querySelectorAll(".swiperImg").length > 0) {
    MyApp.swiperImg.init();
  }
  if (document.querySelectorAll(".swiperHitos").length > 0) {
    MyApp.swiperHitos.init();
  }
  if (document.querySelectorAll(".swiperTypeOf").length > 0) {
    MyApp.swiperTypeOf.init();
  }
  if (document.querySelectorAll(".swiperSocialProjects").length > 0) {
    MyApp.swiperSocialProjects.init();
  }
  if (document.querySelectorAll(".more-news").length > 0) {
    MyApp.swiperNews.init();
  }

  const header = document.getElementById("home-header");
  const borderLanguage = document.querySelectorAll(".language");
  const borderButtons = document.querySelectorAll(".lang-btn");
  const linkedinIconPaths = document.querySelectorAll(".linkedin-icon path");
  const btnSpans = document.querySelectorAll(".btn_menu .btn_span");

  if (header) {
    window.addEventListener("scroll", function () {
      if (window.scrollY > 700) {
        header.classList.add("!bg-white");
        header.classList.add("!shadow-md");
        header.classList.remove("bg-transparent");

        menuLinks.forEach((link) => link.classList.add("!text-black"));
        borderLanguage.forEach((element) =>
          element.classList.add("!text-black")
        );

        borderButtons.forEach((button) => {
          button.classList.add(
            "border-[#CCC]",
            "text-black",
            "hover:border-black"
          );
          button.classList.remove("border-[#FFFFFF4F]", "hover:border-white");
          // El hover no se maneja aquí para evitar conflictos
        });

        linkedinIconPaths.forEach((path) => path.setAttribute("fill", "black"));

        btnSpans.forEach((span) => span.classList.add("!bg-black"));
      } else {
        header.classList.add("!bg-transparent");
        header.classList.remove("!bg-white");
        header.classList.remove("!shadow-md");

        menuLinks.forEach((link) => link.classList.remove("!text-black"));
        borderLanguage.forEach((element) =>
          element.classList.remove("!text-black")
        );

        borderButtons.forEach((button) => {
          button.classList.remove(
            "border-[#CCC]",
            "text-black",
            "hover:border-black"
          );
          button.classList.add("border-[#FFFFFF4F]", "hover:border-white");
          // Aquí no alteramos el estado de hover
        });

        linkedinIconPaths.forEach((path) => path.setAttribute("fill", "white"));

        btnSpans.forEach((span) => span.classList.remove("!bg-black"));
      }
    });
  }

  const langButtons = document.querySelectorAll(".lang-btn");

  langButtons.forEach((button) => {
    button.addEventListener("click", function () {
      langButtons.forEach((btn) => {
        btn.classList.remove("border-black");
        btn.classList.add("border-[#CCC]");
      });

      this.classList.add("border-black");
      this.classList.remove("border-[#CCC]");
    });
  });

  const buttonsType = document.querySelectorAll(".button-style");

  if (buttonsType) {
    buttonsType.forEach((button) => {
      button.addEventListener("click", function () {
        buttonsType.forEach((btn) => {
          btn.classList.remove("!bg-white", "text-primaryBlue");
          btn.classList.add("text-white");
        });

        button.classList.add("!bg-white", "text-primaryBlue");
        button.classList.remove("text-white");
      });
    });
  }

  const buttonsTypeOrange = document.querySelectorAll(".button-style-orange");

  if (buttonsTypeOrange) {
    buttonsTypeOrange.forEach((button) => {
      button.addEventListener("click", function () {
        buttonsTypeOrange.forEach((btn) => {
          btn.classList.remove("!bg-white", "text-primaryOrange");
          btn.classList.add("text-white");
        });

        button.classList.add("!bg-white", "text-primaryOrange");
        button.classList.remove("text-white");
      });
    });
  }

  const marqueeElements = document.querySelectorAll(".marquee");
  if (typeof jQuery !== "undefined" && marqueeElements.length > 0) {
    $(document).ready(function () {
      $(".marquee").marquee({
        duration: 15000,
        gap: 0,
        delayBeforeStart: 0,
        direction: "left",
        duplicated: true,
        startVisible: true,
        pauseOnHover: true,
      });
    });
  }
});

document.querySelectorAll(".toggle-accordion").forEach((element) => {
  element.addEventListener("click", function () {
    const content = this.nextElementSibling;
    const chevron = this.querySelector(".chevron");

    if (content.classList.contains("max-h-0")) {
      content.classList.remove("max-h-0", "opacity-0");
      content.classList.add("max-h-96", "opacity-100");
    } else {
      content.classList.add("max-h-0", "opacity-0");
      content.classList.remove("max-h-96", "opacity-100");
    }

    chevron.classList.toggle("!rotate-[360deg]");
  });
});

// Seleccionamos los puntos del mapa


//animacion de dibujo de plantas y flores
document.addEventListener("DOMContentLoaded", () => {
  // Animación de arriba hacia abajo con delay
  function animateSVGOnScrollTopToBottom(
    svgId,
    startPercent,
    endPercent,
    delay
  ) {
    const svg = document.getElementById(svgId);

    if (svg) {
      svg.style.clipPath = `inset(0 0 100% 0)`;
      svg.style.transition = "clip-path 1.2s ease-out";

      let hasDelayPassed = false;

      function handleScroll() {
        if (!hasDelayPassed) return;

        const scrollPosition = window.scrollY;
        const windowHeight = window.innerHeight;

        const startScroll = windowHeight * startPercent;
        const endScroll = windowHeight * endPercent;

        if (scrollPosition >= startScroll && scrollPosition <= endScroll) {
          const scrollPercent =
            (scrollPosition - startScroll) / (endScroll - startScroll);

          const clipPathValue = scrollPercent * 100;
          svg.style.clipPath = `inset(0 0 ${100 - clipPathValue}% 0)`;
        } else if (scrollPosition < startScroll) {
          svg.style.clipPath = `inset(0 0 100% 0)`;
        } else if (scrollPosition > endScroll) {
          svg.style.clipPath = `inset(0 0 0% 0)`;
        }
      }

      setTimeout(() => {
        hasDelayPassed = true;
        handleScroll(); // Llamar al scroll inmediatamente después del delay
        document.addEventListener("scroll", handleScroll);
      }, delay);
    }
  }

  // Animación de izquierda a derecha con delay
  function animateSVGOnScrollLeftToRight(
    svgId,
    startPercent,
    endPercent,
    delay
  ) {
    const svg = document.getElementById(svgId);

    if (svg) {
      svg.style.clipPath = `inset(0 100% 0 0)`;
      svg.style.transition = "clip-path 5s ease-out";

      let hasDelayPassed = false;

      function handleScroll() {
        if (!hasDelayPassed) return;

        const scrollPosition = window.scrollY;
        const windowHeight = window.innerHeight;

        const startScroll = windowHeight * startPercent;
        const endScroll = windowHeight * endPercent;

        if (scrollPosition >= startScroll && scrollPosition <= endScroll) {
          const scrollPercent =
            (scrollPosition - startScroll) / (endScroll - startScroll);

          const clipPathValue = scrollPercent * 100;
          svg.style.clipPath = `inset(0 ${100 - clipPathValue}% 0 0)`;
        } else if (scrollPosition < startScroll) {
          svg.style.clipPath = `inset(0 100% 0 0)`;
        } else if (scrollPosition > endScroll) {
          svg.style.clipPath = `inset(0 0% 0 0)`;
        }
      }

      setTimeout(() => {
        hasDelayPassed = true;
        handleScroll();
        document.addEventListener("scroll", handleScroll);
      }, delay);
    }
  }

  animateSVGOnScrollTopToBottom("planta", 0.1, 0.8);
  animateSVGOnScrollTopToBottom("planta2", 0.1, 0.5, 500);
  animateSVGOnScrollLeftToRight("planta3", 0.1, 0, 500);
  animateSVGOnScrollTopToBottom("planta4", 0.5, 1.2, 1000);
  animateSVGOnScrollLeftToRight("planta5", 0.1, 0);
  animateSVGOnScrollTopToBottom("planta6", -1, 0, 500);
  animateSVGOnScrollTopToBottom("planta7", -1, 0, 500);
  animateSVGOnScrollLeftToRight("planta8", -1, 0);
});
