$(function (){

	$.ajax({
		type: 'GET',
		url: 'api.php',
		success: function(data) {
			$.each(data, function(i, order) {
				$table.append('<tr>
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

