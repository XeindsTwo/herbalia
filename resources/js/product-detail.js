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