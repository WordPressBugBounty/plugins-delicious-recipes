; (function () {
    // star
    const star = document.createElement('span');
    star.innerHTML = "<svg class='star' width='18' height='19' viewBox='0 0 18 19' fill='none' xmlns='http://www.w3.org/2000/svg'><path d='M9 0.94043L11.751 6.61643L18 7.47968L13.452 11.8507L14.562 18.0599L9 15.0847L3.43725 18.0599L4.548 11.8507L0 7.47968L6.249 6.61643L9 0.94043Z' /></svg>";
    const ratingInput = document.createElement('input');
    ratingInput.name = 'rating';
    ratingInput.type = 'hidden';
    ratingInput.value = 0;

    function createRatingSystem(element = null, ratingContainer) {
        const root = element || document;
        if (ratingContainer === null) {
            return;
        }
        const ratingContainers = root.querySelectorAll(ratingContainer);

        ratingContainers.forEach(ratingContainer => {
            const dynamicRating = ratingContainer.dataset.dynamicRating;
            const readOnly = ratingContainer.dataset.readOnly;

            const placeholder = document.createElement('div');
            placeholder.classList.add('wpd-rating-placeholder');
            placeholder.innerHTML = star.outerHTML.repeat(5);
            ratingContainer.innerHTML = placeholder.outerHTML;

            const stars = ratingContainer.querySelectorAll('.star');

            const fillStar = (rating) => {
                for (let i = 1; i <= rating; i++) {
                    stars[i - 1].querySelector('path').setAttribute('fill', '#FFAE34');
                }
            }

            if (readOnly === 'true' && dynamicRating != 'null') {
                const ratedStars = document.createElement('div');
                ratedStars.classList.add('wpd-rated-stars');
                ratedStars.innerHTML = star.outerHTML.repeat(5);
                ratedStars.style.width = `${(dynamicRating / 5) * 100}%`
                ratingContainer.appendChild(ratedStars)
                return;
            }
            ratingContainer.parentNode.appendChild(ratingInput);
            let selectedRating = dynamicRating || 0;
            fillStar(selectedRating);
            stars.forEach((star, index) => {
                const rating = index + 1;
                star.addEventListener('mouseover', () => {
                    stars.forEach(star => star.querySelector('path').setAttribute('fill', 'none'));
                    ratingContainer.setAttribute('data-dynamic-rating', rating);
                    ratingInput.setAttribute('value', rating)
                    fillStar(rating);
                });

                star.addEventListener('mouseout', () => {
                    stars.forEach(star => star.querySelector('path').setAttribute('fill', 'none'));
                    fillStar(selectedRating > 0 ? selectedRating : rating)
                });

                star.addEventListener('click', () => {
                    selectedRating = rating;
                    fillStar(selectedRating);
                    if (ratingInput) {
                        ratingContainer.setAttribute('data-dynamic-rating', selectedRating);
                        ratingInput.setAttribute('value', selectedRating)
                    }
                });
            });
        });
    }
    // Export the function to the global scope for use in the pro version
    window.createRatingSystem = createRatingSystem;
})();