//import './bootstrap';
//omitted for scoped use
//import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap/dist/js/bootstrap.bundle.min.js';
import 'flowbite';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// ✅ Add Swiper
import Swiper from 'swiper';
import 'swiper/swiper-bundle.css';
// ✅ Optional: make Swiper globally available if you use it in inline scripts
window.Swiper = Swiper;

document.addEventListener('DOMContentLoaded', () => {
    const swipers = document.querySelectorAll('.mySwiper');
    swipers.forEach(swiperContainer => {
        new Swiper(swiperContainer, {
            loop: true,
            slidesPerView: 1,
            spaceBetween: 10,
            navigation: {
                nextEl: swiperContainer.querySelector('.swiper-button-next'),
                prevEl: swiperContainer.querySelector('.swiper-button-prev'),
            },
            pagination: {
                el: swiperContainer.querySelector('.swiper-pagination'),
                clickable: true,
            },
        });
    });
});


