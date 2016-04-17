$(function (){

	$.ajax({
		type: 'GET',
		url: '/orders/orders.json',
		success: function(data) {
			$.each(orders, function(i, order) {
				$orders.append('<li>name: '+order.name+', drink: '+order.drink+'</li>');

			});
		}
	});
});