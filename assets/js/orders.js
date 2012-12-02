$(document).ready( function() {

	var item_id = $('.order_item').attr('data-itemid');
	$('#add_item').click( function() {
		item_id = parseInt(item_id) + 1;
		$('.order_item').append(
			'<div class="span3 pull-left"><label>Item '+item_id+':</label><input name="item'+item_id+'[code]" type="text" class="item_code input-small" data-provide="typeahead" placeholder="Code" data-itemid="' + item_id + '"/><input name="item'+item_id+'[quantity]" type="number" class="item_quantity input-small" placeholder="Quantity" data-itemid="'+item_id+'"/></div>'	
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
		var item_status;
		if ($(this).parent().parent().find('[name="item_status"]').is(':checked')) {
			item_status = 1;
		} else {
			item_status = 0;
		}
		$.ajax({
			url: '/orders/update_item_process',
			type: 'POST',
			data: 'cost=' + cost + '&retail=' + retail + '&quantity=' + quantity + '&details=' + details + '&order_item_id=' + order_item_id + '&item_status=' + item_status,
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

	//Delete order
	$('#delete_order_submit').click(function () {
		var order_id = $(this).attr('data-orderid');
		$.ajax({
			url: '/orders/delete_process',
			type: 'POST',
			data: 'orderid=' + order_id,
			dataType: 'JSON',
			async: false,
			success: function(data) {
				if (data == 1) {
					window.location.replace("/orders/view");
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

	$('.delete_item_button').click( function() {
		var item_id = $(this).attr('data-itemid');
		$('#delete_order_item_submit').attr('data-itemid', item_id);
		var order_item_id = $(this).attr('data-order-itemid');
		$('#delete_order_item_submit').attr('data-order-itemid', order_item_id);
	});
	$('#delete_order_item_submit').click(function () {
		var order_id = $(this).attr('data-orderid');
		var item_id = $(this).attr('data-itemid');
		var order_item_id = $(this).attr('data-order-itemid');
		$.ajax({
			url: '/orders/delete_item_process',
			type: 'POST',
			data: 'orderid=' + order_id + '&itemid=' + item_id + '&orderitemid=' + order_item_id,
			dataType: 'JSON',
			async: false,
			success: function(data) {
				if (data == 1) {
					$('#delete_order_item').modal('hide');
					$('[data-row-order-itemid="'+order_item_id+'"]').fadeOut(1000);
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

	//Modals
	$("#add_user").modal({ keyboard: true, show: false});
	$("#delete_order").modal({ keyboard: true, show: false});
	$("#delete_order_item").modal({ keyboard: true, show: false});
});
