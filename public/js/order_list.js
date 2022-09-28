$(document).ready(function () {
	// $('#filterOrder').on('change', function() {
	//     var orderStatus = $(this).val();
	//     // console.log(orderStatus);

	//     $.ajax({
	//         type: 'get',
	//         url: 'http://127.0.0.1:8000/order/filter',
	//         dataType: 'json',
	//         data: {
	//             'orderStatus': orderStatus,
	//         },
	//         success: function(response) {
	//             var list = '';
	//             for (let i = 0; i < response.length; i++) {
	//                 const order = response[i];
	//                 const date = new Date(order.created_at);
	//                 var day = date.getDate();
	//                 var month = date.getMonth();
	//                 var year = date.getFullYear();
	//                 var monthNames = ["January", "February", "March", "April", "May",
	//                     "June",
	//                     "July", "August", "September", "October", "November",
	//                     "December"
	//                 ];
	//                 var orderDate = day + ' ' + monthNames[month] + ' ' + year;
	//                 list += `
	//                 <tr class="tr-shadow">
	//                     <td>${order.user_id}</td>
	//                     <td class="desc">${order.user_name}</td>
	//                     <td>${orderDate}</td>
	//                     <td>${order.order_code}</td>
	//                     <td>${order.total_price} mmk</td>
	//                     <td>
	//                         <select class="form-select orderStatus">
	//                             <option value="">Confirm Order!</option>
	//                             <option value="0">Pending</option>
	//                             <option value="1">Accept</option>
	//                             <option value="2">Reject</option>
	//                         </select>
	//                     </td>
	//                 </tr>
	//                 <tr class="spacer"></tr>`;
	//             }
	//             $('table tbody').html(list);
	//         }
	//     });
	// });

	$(".orderStatus").on("change", function () {
		var status = $(this).val();
		var orderId = $(this).parent().parent().data("orderid");
		$.ajax({
			type: "get",
			url: "http://127.0.0.1:8000/order/change/status",
			dataType: "json",
			data: {
				status: status,
				orderId: orderId,
			},
			success: function (response) {
				if (response == 200) {
					location.reload();
				}
			},
		});
	});
});
