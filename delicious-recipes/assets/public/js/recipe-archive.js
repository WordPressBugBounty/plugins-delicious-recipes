import Splide from '@splidejs/splide';
import "@splidejs/splide/dist/css/splide.min.css";

document.addEventListener('DOMContentLoaded', function () {
    const splides = document.querySelectorAll('.dr-cuisines-carousel');

    splides.forEach(splide => {
        let splidesCount = splide ? parseInt(splide.getAttribute('data-splide-count')) : 0;
        // Default Splide options
        let options = {
			gap: '30px',
			pagination: false,
			perPage: 3,
			arrows: splidesCount > 3,
			type: splidesCount > 3 ? 'loop' : 'slide',
			breakpoints: {
				1024: {
                    perPage: 2,
                    arrows: splidesCount > 2,
                    type: splidesCount > 2 ? 'loop' : 'slide', // Conditional loop
                },
                640: {
                    perPage: 1,
                    arrows: splidesCount > 1,
                    type: splidesCount > 1 ? 'loop' : 'slide', // Conditional loop
                }
			},
		};

        new Splide(splide, options).mount();
    });
});



