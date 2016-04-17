$(function (){

	var $orders = $('#table table-striped');

	$.ajax({
		type: 'GET',
		url: 'data.php',
		success: function(data) {
			$.each(data, function(i, order) {
				$orders.append('<tr>
									<td>'+order.table+'</td>
									<td>'+order.name+'</td>
									<td>'+order.drinkOrder+'</td>
									<td>'+order.status+'</td>
									<td>'+order.timeIn+'</td>
									<td>'+order.pickDrop+'</td>
									</tr>');

			});
		}
	});
});

