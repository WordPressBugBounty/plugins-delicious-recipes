import Splide from '@splidejs/splide';
import { initWishlist } from './wishlist';
import { initRecipeLike } from './recipe-like';

document.addEventListener('DOMContentLoaded', function () {
    initWishlist();
    initRecipeLike();

    const socialShare = document.querySelectorAll('.post-share a.meta-title');

	socialShare.forEach(function(metaTitle) {
		metaTitle.addEventListener('click', function(e) {
			e.stopPropagation();
			const socialNetworks = this.parentElement.querySelector('.social-networks');
			if (socialNetworks) {
                const li = socialNetworks.querySelector('li');
                if (li.classList.contains('active')) {
                    li.classList.remove('active');
                } else {
                    li.classList.add('active');
                }
			}
		});
	});

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



