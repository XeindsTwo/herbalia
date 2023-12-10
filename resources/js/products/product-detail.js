import Swiper from 'swiper';
import {Navigation, Pagination, Thumbs} from 'swiper/modules';

Swiper.use([Navigation, Pagination, Thumbs]);

const thumbsSwiper = new Swiper('.product-detail__thumbs', {
    slidesPerView: 4,
    watchSlidesVisibility: true,
    watchSlidesProgress: true,
    slideToClickedSlide: true,
});

const mainSwiper = new Swiper('.product-detail__images', {
    loop: true,
    slidesPerView: 1,
    spaceBetween: 20,
    navigation: {
        nextEl: '.product-detail__navigation-btn--next',
        prevEl: '.product-detail__navigation-btn--prev',
    },
    thumbs: {
        swiper: thumbsSwiper
    }
});

document.addEventListener("DOMContentLoaded", function () {
    const buttons = document.querySelectorAll('.product-detail__button');
    const tabs = document.querySelectorAll('.product-detail__tab');

    buttons.forEach((button, index) => {
        button.addEventListener('click', () => {
            const target = button.getAttribute('data-target');
            buttons.forEach(btn => btn.classList.remove('active'));
            tabs.forEach(tab => tab.classList.remove('active'));

            button.classList.add('active');
            const tabIndex = Array.from(tabs).findIndex(tab => tab.getAttribute('data-tab') === target);

            if (tabIndex !== -1) {
                tabs[tabIndex].classList.add('active');
            }
        });
    });

    buttons[0].classList.add('active');
    tabs[0].classList.add('active');
});