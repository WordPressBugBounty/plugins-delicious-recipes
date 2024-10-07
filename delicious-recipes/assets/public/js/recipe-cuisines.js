import Splide from '@splidejs/splide';
import "@splidejs/splide/dist/css/splide.min.css";

document.addEventListener('DOMContentLoaded', function () {
    const splides = document.querySelectorAll('.dr-cuisines-carousel');

    splides.forEach(splide => {
        const splidesCount = splide.querySelectorAll('.splide__slide').length;
        let options = {
            gap: '30px',
            perPage: 3,
            pagination: false,
            breakpoints: {
                767: {
                    perPage: 2,
                },
            },
        };
        if (splidesCount < 4) {
            options.type = 'slide';
            options.arrows = false;
        } else {
            options.type = 'loop';
        }
        new Splide(splide, options).mount();
    });
    
});



