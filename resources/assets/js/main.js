"use strict";
const menuBtn = document.querySelector('.menu-btn');
const nav = document.querySelector('.nav');
menuBtn.addEventListener('click', () => {
  nav.classList.toggle('show');
  menuBtn.classList.toggle('active');
  document.body.classList.toggle('overflow-hidden')
})
// products-swiper
const swiper = new Swiper('.products-swiper', {
  slidesPerView: 4,
  spaceBetween: 95,
  navigation: {
    nextEl: '.products-swiper__next',
    prevEl: '.products-swiper__prev',
  },
  speed: 700,
  loop: true,
  breakpoints: {
    1200: {
      slidesPerView: 4,
      spaceBetween: 95,
    },
    992: {
      slidesPerView: 4,
      spaceBetween: 10,
    },
    768: {
      slidesPerView: 3,
      spaceBetween: 10,
    },
    550: {
      slidesPerView: 2,
      spaceBetween: 10,
    },
    0: {
      slidesPerView: 1,
      spaceBetween: 10,
    },
  }
});

document.querySelectorAll('.business-class__products-block').forEach((block) => {
  const swiperElement = block.querySelector('.business-class__swiper');
  const nextButton = block.querySelector('.business-class__swiper-next');
  const prevButton = block.querySelector('.business-class__swiper-prev');

  new Swiper(swiperElement, {
    slidesPerView: 4,
    spaceBetween: 88,
    navigation: {
      nextEl: nextButton,
      prevEl: prevButton,
    },
    speed: 700,
    loop: true,
    breakpoints: {
      1200: {
        slidesPerView: 4,
        spaceBetween: 88,
      },
      992: {
        slidesPerView: 3,
        spaceBetween: 30,
      },
      768: {
        slidesPerView: 2,
        spaceBetween: 30,
      },
      0: {
        slidesPerView: 1,
        spaceBetween: 30,
      },
    }
  });
});

const customSelect = document.querySelector('.selected-box');
if (customSelect) {
  const options = document.querySelector('.options');
  const option = document.querySelectorAll('.option');
  const selectedText = document.querySelector('.selected-text');
  const selectedBox = document.querySelector('.selected-box')
  // Click event to toggle the options display
  customSelect.addEventListener('click', (e) => {
    e.stopPropagation();
    options.classList.toggle('show');
    selectedBox.classList.toggle('active')
  })

  // Set selected option text and close options on click
  option.forEach(item => {
    item.addEventListener('click', (e) => {
      e.stopPropagation();
      selectedText.textContent = item.textContent;
      options.classList.remove('show');
      selectedBox.classList.remove('active')
    })
  })
  window.addEventListener('click', () => {
    options.classList.remove('show');
    selectedBox.classList.remove('active')
  });
}

if(document.getElementById('phone-mask')) {
  try {
    IMask(document.getElementById('phone-mask'), {
      mask: '+{7}(000)000-00-00'
    })
  } catch (error) {console.error(error.message)}
}

const sections = document.querySelectorAll('.section');
const dynamicTitle = document.getElementById('dynamic-title');
let observer; // Global observer o'zgaruvchi

// IntersectionObserver ni yaratish funksiyasi
function createObserver() {
  observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        // Sectionning data-title atributidan sarlavha matnini olish
        const newTitle = entry.target.getAttribute('data-title');
        dynamicTitle.textContent = newTitle;
      }
    });
  }, {
    threshold: 0,
    rootMargin: "-50% 0px -50% 0px"
  });

  // Har bir section uchun kuzatuv boshlash
  sections.forEach(section => observer.observe(section));
}

// Observerni ishga tushirish va to'xtatish shartlarini tekshirish
function checkScreenSize() {
  // 768px dan katta bo'lsa, observer yaratamiz
  if (window.innerWidth > 768) {
    if (!observer) {
      createObserver();
    }
  } else {
    // 768px dan kichik bo'lsa, observerni to'xtatamiz
    if (observer) {
      observer.disconnect();
      observer = null;
    }
  }
}

// Dastlab tekshirish va ishga tushirish
checkScreenSize();

// Ekran o'lchami o'zgarganda qayta tekshirish
window.addEventListener('resize', checkScreenSize);
