import { parseQuantity, formatQuantity } from "./quantities";
import get_ingredient_unit from "./ingredient-units";

var print_options = document.getElementsByTagName("input");
for (var i = 0, len = print_options.length; i < len; i++) {
	if (print_options[i].getAttribute("name") == "print_options") {
		update_print_options(print_options[i]);
	}
}

document.addEventListener("click", function (e) {
	update_print_options(e.target);
});

function update_print_options(printOpt) {
	if (
		printOpt.id == "print_options_0" &&
		typeof document.getElementById("dr-print-title") != "undefined"
	) {
		if (printOpt.checked) {
			document.getElementById("dr-print-title").style.display = "block";
		} else {
			document.getElementById("dr-print-title").style.display = "none";
		}
	}

	if (
		printOpt.id == "print_options_6" &&
		typeof document.getElementsByClassName("dr-wrp-only-nut")[0] !=
			"undefined"
	) {
		if (printOpt.checked) {
			document.getElementsByClassName(
				"dr-wrp-only-nut",
			)[0].style.display = "block";
		} else {
			document.getElementsByClassName(
				"dr-wrp-only-nut",
			)[0].style.display = "none";
		}
	}

	if (
		printOpt.id == "print_options_1" &&
		typeof document.getElementsByClassName("dr-ingredient-meta-wrap")[0] !=
			"undefined"
	) {
		if (printOpt.checked) {
			document.getElementsByClassName(
				"dr-ingredient-meta-wrap",
			)[0].style.display = "block";
		} else {
			document.getElementsByClassName(
				"dr-ingredient-meta-wrap",
			)[0].style.display = "none";
		}
	}

	if (
		printOpt.id == "print_options_2" &&
		typeof document.getElementsByClassName("dr-description-wrap")[0] !=
			"undefined"
	) {
		if (printOpt.checked) {
			document.getElementsByClassName(
				"dr-description-wrap",
			)[0].style.display = "block";
		} else {
			document.getElementsByClassName(
				"dr-description-wrap",
			)[0].style.display = "none";
		}
	}

	if (
		printOpt.id == "print_options_3" &&
		typeof document.getElementsByClassName("dr-print-img")[0] != "undefined"
	) {
		if (printOpt.checked) {
			document.getElementsByClassName("dr-print-img")[0].style.display =
				"flex";
			var print_images = document.getElementsByTagName("img");
			for (var i = 0, len = print_images.length; i < len; i++) {
				print_images[i].style.display = "inline-block";
			}
		} else {
			document.getElementsByClassName("dr-print-img")[0].style.display =
				"none";
			var print_images = document.getElementsByTagName("img");
			for (var i = 0, len = print_images.length; i < len; i++) {
				print_images[i].style.display = "none";
			}
		}
	}

	if (
		printOpt.id == "print_options_4" &&
		typeof document.getElementsByClassName("dr-ingredients-wrap")[0] !=
			"undefined"
	) {
		if (printOpt.checked) {
			document.getElementsByClassName(
				"dr-ingredients-wrap",
			)[0].style.display = "block";
		} else {
			document.getElementsByClassName(
				"dr-ingredients-wrap",
			)[0].style.display = "none";
		}
	}

	if (
		printOpt.id == "print_options_5" &&
		typeof document.getElementsByClassName("dr-print-instructions")[0] !=
			"undefined"
	) {
		if (printOpt.checked) {
			document.getElementsByClassName(
				"dr-print-instructions",
			)[0].style.display = "block";
		} else {
			document.getElementsByClassName(
				"dr-print-instructions",
			)[0].style.display = "none";
		}
	}

	if (
		printOpt.id == "print_options_7" &&
		typeof document.getElementsByClassName("dr-wrap-notes-keywords")[0] !=
			"undefined"
	) {
		if (printOpt.checked) {
			document.getElementsByClassName(
				"dr-wrap-notes-keywords",
			)[0].style.display = "block";
		} else {
			document.getElementsByClassName(
				"dr-wrap-notes-keywords",
			)[0].style.display = "none";
		}
	}

	if (
		printOpt.id == "print_options_8" &&
		typeof document.getElementsByClassName("dr-wrap-social-share")[0] !=
			"undefined"
	) {
		if (printOpt.checked) {
			document.getElementsByClassName(
				"dr-wrap-social-share",
			)[0].style.display = "block";
		} else {
			document.getElementsByClassName(
				"dr-wrap-social-share",
			)[0].style.display = "none";
		}
	}

	if (
		printOpt.id == "print_options_9" &&
		typeof document.getElementsByClassName("dr-wrap-author-profile")[0] !=
			"undefined"
	) {
		if (printOpt.checked) {
			document.getElementsByClassName(
				"dr-wrap-author-profile",
			)[0].style.display = "block";
		} else {
			document.getElementsByClassName(
				"dr-wrap-author-profile",
			)[0].style.display = "none";
		}
	}

	if (
		printOpt.id == "print_options_10" &&
		typeof document.getElementsByClassName("dr-wrap-thankyou")[0] !=
			"undefined"
	) {
		if (printOpt.checked) {
			document.getElementsByClassName(
				"dr-wrap-thankyou",
			)[0].style.display = "block";
		} else {
			document.getElementsByClassName(
				"dr-wrap-thankyou",
			)[0].style.display = "none";
		}
	}

	if (
		printOpt.id == "print_options_11" &&
		typeof document.getElementsByClassName("dr-content-wrap")[0] !=
			"undefined"
	) {
		if (printOpt.checked) {
			document.getElementsByClassName(
				"dr-content-wrap",
			)[0].style.display = "block";
		} else {
			document.getElementsByClassName(
				"dr-content-wrap",
			)[0].style.display = "none";
		}
	}

	if (
		printOpt.id == "print_options_12" &&
		typeof document.getElementsByClassName(
			"dr-extended-content-content",
		)[0] != "undefined"
	) {
		if (printOpt.checked) {
			document.getElementsByClassName(
				"dr-extended-content-content",
			)[0].style.display = "block";
		} else {
			document.getElementsByClassName(
				"dr-extended-content-content",
			)[0].style.display = "none";
		}
	}
}
const print_props = {
	original_servings:
		"<?php echo ! empty( $recipe->no_of_servings ) ? esc_attr( $recipe->no_of_servings ) : 1; ?>",
	recipe: "<?php echo esc_attr( $recipe->ID ); ?>",
};

window.PrintScripts = {
	init() {
		var recipe = "",
			original_servings = "",
			new_servings = "";

		var searchParams = new URLSearchParams(window.location.search);
		if (searchParams.has("recipe_servings")) {
			new_servings = searchParams.get("recipe_servings");
			new_servings = this.parse(new_servings);
		}

		recipe = parseInt(print_props.recipe);
		original_servings = print_props.original_servings;
		original_servings = this.parse(original_servings);

		if (new_servings != "" && new_servings != original_servings) {
			this.updateServings(recipe, original_servings, new_servings);
		}
	},
	updateServings(recipe, original_servings, new_servings) {
		const ingredients = document.querySelectorAll(
			'.ingredient_quantity[data-recipe="' + recipe + '"]',
		);
		let units = document.querySelectorAll(".ingredient_unit");
		let index = 0;
		for (let ingredient of ingredients) {
			let quantity = ingredient.dataset.original;
			if (quantity != "") {
				quantity = this.parse(quantity);

				let newQuantity = (quantity / original_servings) * new_servings;
				if (!isNaN(newQuantity)) {
					newQuantity = this.format(newQuantity);
				}
				get_ingredient_unit(newQuantity, units, index);
				ingredient.innerHTML = newQuantity;
			}
			index++;
		}
	},
	parse(quantity) {
		return parseQuantity(quantity);
	},
	format(quantity) {
		return formatQuantity(quantity, 2, true);
	},
};

function adjustFontSize(increase = true) {
	const content = document.querySelector(".print-page");
	if (!content) return;

	const fontSizeValue = window
		.getComputedStyle(content)
		.getPropertyValue("font-size");
	const currentFontSize = parseFloat(fontSizeValue);
	const newFontSize = increase ? currentFontSize + 1 : currentFontSize - 1;
	content.style.fontSize = `${newFontSize}px`;
}

document
	.getElementById("dr-increase-font-size")
	?.addEventListener("click", () => adjustFontSize(true));
document
	.getElementById("dr-decrease-font-size")
	?.addEventListener("click", () => adjustFontSize(false));

document.addEventListener("DOMContentLoaded", () => {
	window.PrintScripts.init();
	adjustFontSize();
});
