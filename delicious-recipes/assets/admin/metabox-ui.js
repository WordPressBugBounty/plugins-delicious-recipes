/**
 * Recipe Settings metabox behaviour on the block editor screen.
 *
 * 1. Seeds the "Meta Boxes" drawer preferences once per user, so the drawer
 *    starts open at a usable height instead of collapsed.
 * 2. Stops the move-down/move-up buttons from relocating Recipe Settings into
 *    the right sidebar, where it is unusably narrow.
 */
(function (wp) {
	var METABOX_ID = "delicious_recipes_metabox";
	var SIDE_SORTABLES_ID = "side-sortables";

	/**
	 * Open the Meta Boxes drawer the first time this user edits a recipe.
	 *
	 * Only runs while the server reports `seed`, which it does exactly once per
	 * user, and only writes preferences the user has never set. Any later change
	 * the user makes — collapsing it, or dragging it to a new height — sticks.
	 */
	function seedDrawerPreferences() {
		var config = window.DeliciousRecipesMetaBoxPrefs || {};

		if (!config.seed || !wp || !wp.data || !wp.domReady) {
			return;
		}

		wp.domReady(function () {
			var preferences = wp.data.select("core/preferences");

			// Classic editor screens have no preferences store.
			if (!preferences || !wp.data.dispatch("core/preferences")) {
				return;
			}

			var setPreference = wp.data.dispatch("core/preferences").set;

			// `undefined` means the user has never touched the control. An
			// explicit `false` is a deliberate collapse and must be left alone.
			if (
				undefined === preferences.get("core/edit-post", "metaBoxesMainIsOpen")
			) {
				setPreference("core/edit-post", "metaBoxesMainIsOpen", true);
			}

			if (
				config.height &&
				undefined ===
					preferences.get("core/edit-post", "metaBoxesMainOpenHeight")
			) {
				setPreference(
					"core/edit-post",
					"metaBoxesMainOpenHeight",
					parseInt(config.height, 10)
				);
			}
		});
	}

	function isVisible(element) {
		return null !== element.offsetParent;
	}

	function visibleSortables() {
		return Array.prototype.filter.call(
			document.querySelectorAll(".meta-box-sortables"),
			isVisible
		);
	}

	/**
	 * Block the move buttons when they would push Recipe Settings into the sidebar.
	 *
	 * Core's `handleOrder` walks a postbox to the adjacent `.meta-box-sortables`
	 * area once it reaches the edge of its own. In the block editor `normal` and
	 * `advanced` both render in the bottom drawer, but `side` renders in the
	 * document sidebar. We allow every move except the hop into `#side-sortables`.
	 *
	 * Bound in the capture phase so it runs before core's own click handler.
	 */
	function guardMetaboxPlacement() {
		document.addEventListener(
			"click",
			function (event) {
				if (!event.target || !event.target.closest) {
					return;
				}

				var button = event.target.closest(
					".handle-order-lower, .handle-order-higher"
				);

				if (!button || !button.closest("#" + METABOX_ID)) {
					return;
				}

				var postbox = button.closest("#" + METABOX_ID);
				var area = postbox.closest(".meta-box-sortables");

				if (!area) {
					return;
				}

				var boxes = Array.prototype.filter.call(
					area.querySelectorAll(".postbox"),
					isVisible
				);
				var movingDown = button.classList.contains("handle-order-lower");
				var index = boxes.indexOf(postbox);

				// Still room to move within this area: let core handle it.
				var atEdge = movingDown ? index === boxes.length - 1 : 0 === index;

				if (!atEdge) {
					return;
				}

				var areas = visibleSortables();
				var target = areas[areas.indexOf(area) + (movingDown ? 1 : -1)];

				if (target && SIDE_SORTABLES_ID === target.id) {
					event.stopPropagation();
					event.preventDefault();
				}
			},
			true
		);
	}

	seedDrawerPreferences();
	guardMetaboxPlacement();
})(window.wp);
