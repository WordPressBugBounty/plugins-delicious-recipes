import { formatQuantity, parseQuantity, decimalToFraction } from "./quantities";

// Cache DOM elements
const printElements = {
	title: document.getElementById("dr-print-title"),
	nutrition: document.getElementsByClassName("dr-wrp-only-nut")[0],
	ingredientMeta: document.getElementsByClassName("dr-ingredient-meta-wrap")[0],
	description: document.getElementsByClassName("dr-description-wrap")[0],
	images: document.getElementsByClassName("dr-print-img")[0],
	ingredients: document.getElementsByClassName("dr-ingredients-wrap")[0],
	instructions: document.getElementsByClassName("dr-print-instructions")[0],
	notes: document.getElementsByClassName("dr-wrap-notes-keywords")[0],
	social: document.getElementsByClassName("dr-wrap-social-share")[0],
	author: document.getElementsByClassName("dr-wrap-author-profile")[0],
	thankyou: document.getElementsByClassName("dr-wrap-thankyou")[0],
	content: document.getElementsByClassName("dr-content-wrap")[0],
	extendedContent: document.getElementsByClassName("dr-extended-content-content")[0]
};

// Print options mapping
const printOptionsMap = {
	"print_options_0": "title",
	"print_options_1": "ingredientMeta",
	"print_options_2": "description",
	"print_options_3": "images",
	"print_options_4": "ingredients",
	"print_options_5": "instructions",
	"print_options_6": "nutrition",
	"print_options_7": "notes",
	"print_options_8": "social",
	"print_options_9": "author",
	"print_options_10": "thankyou",
	"print_options_11": "content",
	"print_options_12": "extendedContent"
};

// Initialize print options
function initializePrintOptions() {
	const printOptions = document.getElementsByTagName("input");
	Array.from(printOptions).forEach(option => {
		if (option.getAttribute("name") === "print_options") {
			updatePrintOptions(option);
		}
	});
}

// Update print options visibility
function updatePrintOptions(printOpt) {
	try {
		const elementKey = printOptionsMap[printOpt.id];
		if (!elementKey) return;

		const element = printElements[elementKey];
		if (!element) return;

		const display = printOpt.checked ? (elementKey === "images" ? "flex" : "block") : "none";
		element.style.display = display;

		// Special handling for images
		if (elementKey === "images") {
			const images = document.getElementsByTagName("img");
			Array.from(images).forEach(img => {
				img.style.display = printOpt.checked ? "inline-block" : "none";
			});
		}
	} catch (error) {
		console.error("Error updating print options:", error);
	}
}

// Recipe print functionality.
const printProps = {
	original_servings: "<?php echo ! empty( $recipe->no_of_servings ) ? esc_attr( $recipe->no_of_servings ) : 1; ?>",
	recipe: "<?php echo esc_attr( $recipe->ID ); ?>"
};

window.PrintScripts = {
	init() {
		try {
			const searchParams = new URLSearchParams(window.location.search);
			const newServings = searchParams.has("recipe_servings") 
				? this.parse(searchParams.get("recipe_servings"))
				: null;

			const recipe = parseInt(printProps.recipe);
			// const originalServings = this.parse(printProps.original_servings);
			const originalServings = deliciousRecipesPrint.defaultServings;

			if (newServings && newServings !== originalServings) {
				this.updateServings(recipe, originalServings, newServings);
			}
		} catch (error) {
			console.error("Error initializing print scripts:", error);
		}
	},

	updateServings(recipe, originalServings, newServings) {
		try {
			const ingredients = document.querySelectorAll('.ingredient_quantity');
			const multiplier = newServings / originalServings;

			ingredients.forEach(ingredient => {
				const quantity = this.parse(ingredient.textContent);
				if (quantity) {
					const newQuantity = quantity * multiplier;
					ingredient.textContent = this.format(newQuantity);
				}
			});
		} catch (error) {
			console.error("Error updating servings:", error);
		}
	},

	shouldUseFraction() {
		return deliciousRecipesPrint.useFraction.length > 1;
	},

	parse(quantity) {
		return parseQuantity(quantity);
	},

	format(quantity) {
		if (this.shouldUseFraction()) {
			return decimalToFraction(quantity);
		} else {
			return formatQuantity(quantity, 2, false);
		}
	}
};

// Font size adjustment with debouncing
let fontSizeTimeout;
function adjustFontSize(increase = true) {
	const content = document.querySelector(".print-page");
	if (!content) return;

	clearTimeout(fontSizeTimeout);
	fontSizeTimeout = setTimeout(() => {
		try {
			const fontSizeValue = window.getComputedStyle(content).getPropertyValue("font-size");
			const currentFontSize = parseFloat(fontSizeValue);
			const newFontSize = increase ? currentFontSize + 1 : currentFontSize - 1;
			content.style.fontSize = `${newFontSize}px`;
		} catch (error) {
			console.error("Error adjusting font size:", error);
		}
	}, 100); // Debounce for 100ms
}

// Event Listeners
document.addEventListener("click", function(e) {
	if (e.target.getAttribute("name") === "print_options") {
		updatePrintOptions(e.target);
	}
});

document.getElementById("dr-increase-font-size")?.addEventListener("click", () => adjustFontSize(true));
document.getElementById("dr-decrease-font-size")?.addEventListener("click", () => adjustFontSize(false));

// Initialize on DOM content loaded
document.addEventListener("DOMContentLoaded", () => {
	window.PrintScripts.init();
	initializePrintOptions();
	adjustFontSize();
});
