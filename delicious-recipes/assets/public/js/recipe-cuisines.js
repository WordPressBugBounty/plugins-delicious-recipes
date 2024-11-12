import Splide from '@splidejs/splide';
import "@splidejs/splide/dist/css/splide.min.css";

document.addEventListener('DOMContentLoaded', function () {
    const splides = document.querySelectorAll('.dr-cuisines-carousel');
    const splidesCount = splides[0].querySelectorAll('.splide__slide').length;

    let options = {
        gap: '30px',
        perPage: 3,
        pagination: false,
        breakpoints: {
            1024: {
                perPage: 2,
            },
            640: {
                perPage: 1,
            }
        },
    };
    if (splidesCount < 4) {
        options.type = 'slide';
        if (splidesCount === 1) {
            options.arrow = false;
        }
    } else {
        options.type = 'loop';
    }

    splides.forEach(splide => {
        new Splide(splide, options).mount();
    });
    
});



