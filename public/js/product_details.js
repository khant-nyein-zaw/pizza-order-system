$(document).ready(function () {
	// view count increase
	var productId = $("#addToCartBtn").data("productid");
	$.ajax({
		type: "get",
		url: "http://127.0.0.1:8000/ajax/view_count/increase",
		dataType: "json",
		data: {
			productId,
		},
	});

	$("#addToCartBtn").on("click", function () {
		var data = {
			orderCount: $("#orderCount").val(),
			userId: $(this).data("userid"),
			productId: $(this).data("productid"),
		};
		$.ajax({
			type: "get",
			url: "http://127.0.0.1:8000/ajax/cart",
			dataType: "json",
			data: data,
			success: function (response) {
				if (response.status == "success") {
					window.location.href = "http://127.0.0.1:8000/user/home";
				}
			},
		});
	});
});
