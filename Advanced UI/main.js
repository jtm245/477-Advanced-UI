$(function (){

	$.ajax({
		type: 'GET',
		url: 'api.php',
		success: function(orders) {
			$.each(orders, function(i, order) {
				$table-striped.append('<tr>
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

