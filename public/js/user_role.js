$(document).ready(function () {
	$(".table-data-feature .form-select").on("change", function () {
		var userId = $(this).parent().parent().data("userid");
		var role = $(this).val();

		$.ajax({
			type: "get",
			url: "http://127.0.0.1:8000/admin/change/role",
			dataType: "json",
			data: {
				userId: userId,
				role: role,
			},
			success: function (response) {
				if (response == 200) {
					location.reload();
				}
			},
		});
	});

	$("td .form-select").on("change", function () {
		var userId = $(this).parent().parent().data("userid");
		var role = $(this).val();
		$.ajax({
			type: "get",
			url: "http://127.0.0.1:8000/users/change/role",
			dataType: "json",
			data: {
				userId: userId,
				role: role,
			},
			success: function (response) {
				if (response == 200) {
					location.reload();
				}
			},
		});
	});
});
