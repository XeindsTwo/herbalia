import Swiper from 'swiper';
import {Navigation, Pagination} from "swiper/modules";

Swiper.use([Pagination, Navigation]);

const swiper = new Swiper('.swiper', {
    loop: true,
    slidesPerView: 1,
    autoHeight: true,
    navigation: {
        nextEl: '.top-reviews__btn--next',
        prevEl: '.top-reviews__btn--prev',
    },
    breakpoints: {
        600: {
            pagination: {
                el: '.top-reviews__digital',
                type: 'custom',
                renderCustom: function (swiper, current, total) {
                    return current.toString() + "/" + total.toString();
                },
            },
        },
        320: {
            pagination: {
                el: '.top-reviews__pagination',
                type: 'bullets',
            },
        },
    },
});