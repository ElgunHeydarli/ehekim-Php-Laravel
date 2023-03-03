var swiper = new Swiper(".slide-content", {
    slidesPerView: 3,
    spaceBetween: 15,
    loop: true,
    centerSlide: 'true',
    fade: 'true',
    grabCursor: 'true',
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
      dynamicBullets: true,
    },
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },

    breakpoints:{
        0: {
            slidesPerView: 2,
        },
        520: {
            slidesPerView: 2,
        },
        950: {
            slidesPerView: 4,
        },
        1280:{
            slidesPerView: 5,

        }
    },
  });
  
  let buttons = document.querySelectorAll('[type="submit"]');
  let counter = 0;
  
  buttons.forEach(button=>{
      console.log(button);
      button.addEventListener('click',function(){
         counter++;
         if(counter>1){
            button.disabled = true;
         }
      });
  })


