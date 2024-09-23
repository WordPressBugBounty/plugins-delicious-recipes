jQuery(document).ready(function($) {
    //main tab js
	$(document).on("click", ".dr-tab-wrap .dr-tab", function () {
		var drUniqueClass = $(this).attr("class").split(" ")[1];
		$(this).siblings(".dr-tab").removeClass("current");
		$(this).addClass("current");
		$(this)
			.parents(".dr-tab-wrap")
			.siblings(".dr-tab-content-wrap")
			.find(".dr-tab-content")
			.removeClass("current");
		$(this)
			.parents(".dr-tab-wrap")
			.siblings(".dr-tab-content-wrap")
			.find("." + drUniqueClass + "-content")
			.addClass("current");

		var DataTable = initTable();
		DataTable.destroy();
		initTable();
		delrecipe_tab_scrolltop(drUniqueClass);
	});
});