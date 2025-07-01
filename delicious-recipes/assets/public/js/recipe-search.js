import { __ } from "@wordpress/i18n";
import { initWishlist } from './wishlist';

(function ($) {
	// Search Filters
	$(".js-select2").select2({
		closeOnSelect: false,
		placeholder: delicious_recipes.search_placeholder,
		allowClear: true,
	});

	var searchAjaxRunning = null;;
	$("body").on("change", ".dr-search-field select", function () {
		var choices = {};
		$(".dr-search-field select option").each(function () {
			if ($(this).is(":selected")) {
				if (!choices.hasOwnProperty($(this).attr("name"))) {
					choices[$(this).attr("name")] = [];
				}
				var idx = $.inArray(this.value, choices[$(this).attr("name")]);
				if (idx == -1) {
					choices[$(this).attr("name")].push(this.value);
				}
			}
		});

		var nonce = $("#dr-search-nonce").val();

		// Disable previous AJAX call if new AJAX call is to be made.
		// This will prevent calling multiple AJAX call response.
		if (null !== searchAjaxRunning) {
			searchAjaxRunning.abort();
		}

		searchAjaxRunning = jQuery.ajax({
			url: delicious_recipes.ajax_url,
			data: {
				action: "recipe_search_results",
				search: choices,
				nonce: nonce,
			},
			dataType: "json",
			type: "post",
			beforeSend: function () {
				$(".dr-search-item-wrap").addClass("dr-loading");
			},
			success: function (response) {
				if (response.success) {
					var template = wp.template("search-block-tmp");
					$(".dr-search-item-wrap").html(
						template(response.data.results)
					);
					$(".navigation.pagination .nav-links")
						.addClass("dr-ajax-paginate")
						.html(response.data.pagination);

					if ("AND" === response.data?.logic) {
						$(
							'.advance-search-options select.js-select2:not([name="sorting"]) option'
						).each(function (i, e) {
							$(this).text($(e).data("title") + " (0)");
						});
						if (response.data?.terms) {
							var terms = response.data.terms;
							if ("object" === typeof terms) {
								for (var tax in terms) {
									if ("object" === typeof terms[tax]) {
										for (var _tax in terms[tax]) {
											var tax_term = terms[tax][_tax];
											$(
												`select[name="${tax}"] option[value="${tax_term.term_id}"]`
											).text(
												`${tax_term.name} (${tax_term.count})`
											);
										}
									}
								}
							}
						}
						if (response.data?.metas) {
							var metas = response.data.metas;
							if ("object" === typeof metas) {
								for (var meta_name in metas) {
									for (var meta_value in metas[meta_name]) {
										var meta = metas[meta_name][meta_value];
										var $option = $(
											`select[name="${meta_name}"] option[value="${meta_value}"]`
										);
										var title = $option.data("title");
										$option.text(`${title} (${meta})`);
									}
								}
							}
						}
						$(".advance-search-options select.js-select2").select2({
							closeOnSelect: false,
							placeholder: delicious_recipes.search_placeholder,
							allowClear: true,
						});
					}
				}
			},
			complete: function () {
				$(".dr-search-item-wrap").removeClass("dr-loading");
				searchAjaxRunning = null;
			},
		});
	});

	$(document).on("click", ".dr-ajax-paginate a.page-numbers", function (e) {
		e.preventDefault();
		var choices = {};
		$(".dr-search-field select option").each(function () {
			if ($(this).is(":selected")) {
				if (!choices.hasOwnProperty($(this).attr("name"))) {
					choices[$(this).attr("name")] = [];
				}
				var idx = $.inArray(this.value, choices[$(this).attr("name")]);
				if (idx == -1) {
					choices[$(this).attr("name")].push(this.value);
				}
			}
		});

		var nonce = $("#dr-search-nonce").val();

		jQuery.ajax({
			url: delicious_recipes.ajax_url,
			data: {
				action: "recipe_search_results",
				search: choices,
				nonce: nonce,
				paged: $(this).attr("href").split("=")[1],
			},
			dataType: "json",
			type: "post",
			beforeSend: function () {
				$(".dr-search-item-wrap").addClass("dr-loading");
			},
			success: function (response) {
				if (response.success) {
					var template = wp.template("search-block-tmp");
					$(".dr-search-item-wrap").html(
						template(response.data.results)
					);
					$(".navigation.pagination .nav-links")
						.addClass("dr-ajax-paginate")
						.html(response.data.pagination);
				}
			},
			complete: function () {
				$(".dr-search-item-wrap").removeClass("dr-loading");
			},
		});
	});

	$("#dr-recipes-clear-filters").on("click", function (e) {
		e.preventDefault();
		$(".dr-advance-search .advance-search-options select").each(
			function () {
				$(this).val(null).trigger("change");
			}
		);
	});

	$(document).ready(function () {
		initWishlist();
	});

})(jQuery);