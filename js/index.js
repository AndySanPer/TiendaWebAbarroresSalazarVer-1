document.addEventListener('DOMContentLoaded', function() {
    const carouselSlide = document.querySelector('.carousel-slide');
    const carouselImages = document.querySelectorAll('.carousel-slide img');
  
    // Configuración de variables
    let counter = 0;
    const slideWidth = carouselImages[0].clientWidth;
  
    // Función para mostrar el slide actual
    function moveToSlide() {
      carouselSlide.style.transition = "transform 0.5s ease-in-out";
      carouselSlide.style.transform = `translateX(${-slideWidth * counter}px)`;
    }
  
    // Botones de navegación
    const nextBtn = document.querySelector('.next-btn');
    const prevBtn = document.querySelector('.prev-btn');
  
    // Eventos para los botones de navegación
    nextBtn.addEventListener('click', function() {
      if (counter >= carouselImages.length - 1) return;
      counter++;
      moveToSlide();
    });
  
    prevBtn.addEventListener('click', function() {
      if (counter <= 0) return;
      counter--;
      moveToSlide();
    });
  });
  