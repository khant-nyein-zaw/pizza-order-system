$(document).ready(function () {
	// cart total price evaluate
	$(".quantity button").on("click", function () {
		var parents = $(this).parentsUntil("tbody");
		var price = parents.find("td.price").text();
		var qty = parents.find("input#qty").val();
		var multipliedResult = parseInt(price) * parseInt(qty);
		if (multipliedResult != undefined || multipliedResult != NaN) {
			parents.find(".multipliedResult").text(multipliedResult + " mmk");
		}
		totalPrice();
	});

	// table row delete
	$("td .btn-danger").on("click", function () {
		var row = $(this).parent().parent();
		var userId = row.data("userid");
		var productId = row.data("productid");
		var cartId = row.data("cartid");
		row.remove();
		$.ajax({
			type: "get",
			url: "http://127.0.0.1:8000/ajax/delete/row",
			dataType: "json",
			data: {
				userId: userId,
				productId: productId,
				cartId: cartId,
			},
		});
		totalPrice();
	});

	// clear cart
	$("#clearCartBtn").on("click", function () {
		$("tbody").empty();
		$.ajax({
			type: "get",
			url: "http://127.0.0.1:8000/ajax/clear/cart",
		});
		totalPrice();
	});

	// clear cart and order
	$("#checkOutBtn").on("click", function () {
		if ($("tbody").children().length != 0) {
			var orderInfo = [];
			var randomNum = Math.floor(Math.random() * 10000001);
			$("table tbody tr.item").each(function () {
				var userId = $(this).data("userid");
				var productId = $(this).data("productid");
				var qty = $(this).find("input#qty").val();
				var totalPrice = parseInt(
					$(this).find(".multipliedResult").text(),
				);
				orderInfo.push({
					user_id: userId,
					product_id: productId,
					quantity: qty,
					total_price: totalPrice,
					order_code: "POS" + randomNum,
				});
			});
			$.ajax({
				type: "get",
				url: "http://127.0.0.1:8000/ajax/order",
				dataType: "json",
				data: Object.assign({}, orderInfo),
				success: function (response) {
					if (response.status == "success") {
						window.location.href =
							"http://127.0.0.1:8000/user/home";
					}
				},
			});
		}
	});

	// looping table row and get tatal price
	function totalPrice() {
		var subTotal = 0;
		$("table tbody tr.item").each(function () {
			var multipliedResult = $(this).find(".multipliedResult").text();
			subTotal += parseInt(multipliedResult);
		});
		$("h6#subTotal").text(subTotal + " mmk");
		var total = subTotal + 500;
		$("h5#total").text(total + " mmk");
	}
});
