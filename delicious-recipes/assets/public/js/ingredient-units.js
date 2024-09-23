function get_ingredient_unit(newIngredientQty, ingredientUnits, i) {
	jQuery.ajax({
		url: '/wp-admin/admin-ajax.php',
		data: {
			action: "get_ingredients_unit",
			newQty: newIngredientQty,
			unit: ingredientUnits[i].innerText
		},
		dataType: "json",
		type: "POST",
		success: function (response) {
			if (response.success) {
                let newUnit = response.data
				ingredientUnits[i].innerText = Object.values(newUnit)
			} else {
				console.log('response.data.error')
			}
		}
	})
}

export default get_ingredient_unit;