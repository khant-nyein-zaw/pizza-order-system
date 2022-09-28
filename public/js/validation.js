$(document).ready(function () {
	$("#floatingMessage").on("input", function () {
		var inputVal = $(this).val();
		var validateMsg = $(this)
			.parent()
			.parent()
			.find(".is-validated")
			.first();
		if (inputVal.length >= 20) {
			validateMsg.removeClass("d-none");
		} else if (inputVal.length < 20) {
			validateMsg.addClass("d-none");
		}
	});
	$("#floatingMessage").on("focusout", function () {
		$(this)
			.parent()
			.parent()
			.find(".is-validated")
			.first()
			.addClass("d-none");
	});
});
