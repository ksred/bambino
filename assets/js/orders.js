$(document).ready( function() {

	var item_id = $('.order_item').attr('data-itemid');
	$('#add_item').click( function() {
		item_id = parseInt(item_id) + 1;
		$('.order_item').append(
			'<label>Item '+item_id+':</label><input name="item'+item_id+'[code]" type="text" class="item_code" data-provide="typeahead" placeholder="Code" data-itemid="' + item_id + '"/><input name="item'+item_id+'[quantity]" type="number" class="item_quantity" placeholder="Quantity" data-itemid="'+item_id+'"/>'	
		);
		$('#item_total').val(item_id);
	});
	
	$('#customer_name').typeahead({
		source : function(typeahead, query) {
			$.ajax({
				url: '/customers/search_name',
				type: 'POST',
				data: 'query=' + query,
				dataType: 'JSON',
				async: false,
				success: function(data) {
					typeahead.process(data);
				}
			})
		}
	});

	$('#customer_details').typeahead({
		source : function(typeahead, query) {
			$.ajax({
				url: '/customers/search_details',
				type: 'POST',
				data: 'query=' + query,
				dataType: 'JSON',
				async: false,
				success: function(data) {
					typeahead.process(data);
				}
			})
		}
	});

	$('[name*="[code]"]').livequery( function() {
		$(this).typeahead({
			source : function(typeahead, query) {
				$.ajax({
					url: '/items/search_code',
					type: 'POST',
					data: 'query=' + query,
					dataType: 'JSON',
					async: false,
					success: function(data) {
						typeahead.process(data);
					}
				})
			}
		})
	});


/*	$('#order_id').typeahead({
		source : function(typeahead, query) {
			$.ajax({
				url: '/orders/search_id',
				type: 'POST',
				data: 'query=' + query,
				dataType: 'JSON',
				async: false,
				success: function(data) {
					typeahead.process(data);
				}
			})
		}
	});
*/
	//Updating orders
	$('.update_order').click(function () {
		var status = $(this).parent().parent().find('.order_status').val();
		var order_id = $(this).attr('data-orderid');
		$.ajax({
			url: '/orders/update_process',
			type: 'POST',
			data: 'status=' + status + '&order_id=' + order_id,
			dataType: 'JSON',
			async: false,
			success: function(data) {
				if (data == 1) {
					$("#success").fadeIn();
					setTimeout(function() {
						$("#success").fadeOut();
						}, 10000);
				} else {
					$("#failure").fadeIn();
					setTimeout(function() {
						$("#failure").fadeOut();
						}, 10000);
				}
			}
		})
	});

	//Updating order item
	$('.update_order_item').click(function () {
		var cost = $(this).parent().parent().find('[name="item_cost"]').val();
		var retail = $(this).parent().parent().find('[name="item_retail"]').val();
		var quantity = $(this).parent().parent().find('[name="item_quantity"]').val();
		var details = $(this).parent().parent().find('[name="item_details"]').val();
		var order_item_id = $(this).attr('data-order-itemid');
		$.ajax({
			url: '/orders/update_item_process',
			type: 'POST',
			data: 'cost=' + cost + '&retail=' + retail + '&quantity=' + quantity + '&details=' + details + '&order_item_id=' + order_item_id,
			dataType: 'JSON',
			async: false,
			success: function(data) {
				if (data == 1) {
					$("#success").fadeIn();
					setTimeout(function() {
						$("#success").fadeOut();
						}, 10000);
				} else {
					$("#failure").fadeIn();
					setTimeout(function() {
						$("#failure").fadeOut();
						}, 10000);
				}
			}
		})
	});

	//Modal for adding user
	$("#add_user").modal({ keyboard: true, show: false});
});
