import LazyLoad from "vanilla-lazyload";
import Splide from '@splidejs/splide';
import { initWishlist } from './wishlist';
import { initRecipeLike } from './recipe-like';
import { initRecipeSocialShare } from './recipe-social-share';

class recipeGlobal {
	constructor() { }
}
window["recipe_global"] = recipeGlobal;

// Initialize LazyLoad
const lazyLoadInstance = new LazyLoad({
	elements_selector: ".dr-lazy", // Apply to elements with the class 'lazy'
});
lazyLoadInstance.update();


document.addEventListener('DOMContentLoaded', function () {
	initWishlist();
	initRecipeLike();
	//show/hide social share (vanilla JS)
	initRecipeSocialShare();

	//pull recipe category title left
	document.querySelectorAll('.dr-category a, .post-navigation article .dr-category > span').forEach(function(el) {
		var recipeCatWidth = el.offsetWidth;
		var catName = el.querySelector('.cat-name');
		if (!catName) return;
		var recipeCatTitleWidth = catName.offsetWidth;
		var catPullValue = (parseInt(recipeCatTitleWidth) - parseInt(recipeCatWidth)) / 2;
		if (document.body.classList.contains('rtl')) {
			catName.style.left = 'auto';
			catName.style.right = -catPullValue + 'px';
		} else {
			catName.style.left = -catPullValue + 'px';
		}
	});
	
	// creating utils
	var Util = {};
	Util.on = function (eventName, selector, callback) {
		document.addEventListener(
			eventName,
			function (event) {
				for (
					var elTarget = event.target;
					elTarget && elTarget != this;
					elTarget = elTarget.parentNode
				) {
					// Check if elTarget is an Element before calling matches
					if (elTarget instanceof Element && elTarget.matches(selector)) {
						callback.call(elTarget, event);
						break;
					}
				}
			},
			false
		);
	};
	
	window["delicious_recipes"]["utilities"] = Util;
});

