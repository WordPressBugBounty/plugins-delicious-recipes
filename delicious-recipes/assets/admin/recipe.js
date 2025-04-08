document.addEventListener("DOMContentLoaded", function () {
    document.addEventListener("click", function (event) {
        if (event.target.classList.contains("dr-tab")) {
            var drTab = event.target;
            var drTabWrap = drTab.closest(".dr-tab-wrap");
            var drTabContentWrap = drTabWrap.nextElementSibling;
            var drUniqueClass = drTab.classList[1];

            // Remove 'current' class from siblings
            drTabWrap.querySelectorAll(".dr-tab").forEach(tab => tab.classList.remove("current"));
            drTab.classList.add("current");
            
            // Update content visibility
            drTabContentWrap.querySelectorAll(".dr-tab-content").forEach(content => content.classList.remove("current"));
            var targetContent = drTabContentWrap.querySelector("." + drUniqueClass + "-content");
            if (targetContent) {
                targetContent.classList.add("current");
            }
            
            var DataTable = initTable();
            DataTable.destroy();
            initTable();
            delrecipe_tab_scrolltop(drUniqueClass);
        }
    });

    /**
     * Get additional data related to the current post. This data will be submitted by the character count calculation ajax call.
     * 
     * @returns object An custom object.
     */
    window.wpvgw_post_get_custom_object = function() {
		let postMeta = DeliciousRecipes.postMeta;
		let meta_to_count = {};
		
		let valuesToCount = [
			'recipeSubtitle',
			'recipeDescription',
			'recipeKeywords',
			'recipeIngredients',
			'recipeInstructions',
			'recipeNotes',
			'extendedContent',
			'recipeFAQs',
		];

		valuesToCount = valuesToCount.map(value => {
			meta_to_count[value] = postMeta[value];
		});

		return meta_to_count;
    };
});
