//import './bootstrap';
//omitted for scoped use
//import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap/dist/js/bootstrap.bundle.min.js';
import 'flowbite';
// ✅ Add Swiper
import Swiper from 'swiper';
import 'swiper/swiper-bundle.css';


import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();



// ✅ Optional: make Swiper globally available if you use it in inline scripts
window.Swiper = Swiper;
