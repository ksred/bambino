$(document).ready( function() {

	$('#order_add').click( function () {
		$('#order_error').addClass('hidden').html();
		var customer_name = $('#customer_name').val();
		var site_order_id = $('#order_id').val();
		var item_total = $('#item_total').val();
		var query = "";
		for (var i = 1; i <= item_total; i = i + 1) {
			query = query + '&item' + i + '=' + $('[name="item'+i+'[code]"]').val();	
		}
		$.ajax({
			url: '/orders/check_order_fields',
			type: 'POST',
			data: 'customer_name=' + customer_name + '&site_order_id=' + site_order_id + '&item_total=' + item_total + query,
			dataType: 'JSON',
			async: false,
			success: function(data) {
				if (data != 0) {
					$('#order_error').removeClass('hidden').html(data).fadeIn();
					return;
				} else {
					$('#order_add_form').submit();
				}
			}
		})
	});

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
	$('.update_order_item').live('click', function () {
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

	$('.delete_item_button').live('click', function() {
		var item_id = $(this).attr('data-itemid');
		$('#delete_order_item_submit').attr('data-itemid', item_id);
		var order_item_id = $(this).attr('data-order-itemid');
		$('#delete_order_item_submit').attr('data-order-itemid', order_item_id);
	});
	$('#delete_order_item_submit').live('click', function () {
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

	$('#add_item_order_submit').click(function () {
		var item_code = $(this).parent().parent().find('[name="itemadd[code]"]').val();
		var item_quantity = $(this).parent().parent().find('[name="itemadd[quantity]"]').val();
		var order_id = $(this).attr('data-orderid');
		if (item_quantity == '') {
			$('.error-fill-in-fields').fadeIn();
		}
		$.ajax({
			url: '/orders/add_item_order_process',
			type: 'POST',
			data: 'orderid=' + order_id + '&itemcode=' + item_code + '&itemquantity=' + item_quantity,
			dataType: 'JSON',
			async: false,
			success: function(data) {
				if (data.item_id != '') {
					$('#add_item_order').modal('hide');
					$("#success").fadeIn();
					setTimeout(function() {
						$("#success").fadeOut();
						}, 10000);
					$('tbody').append('<tr data-row-order-itemid="'+data.order_item_id+'"><td>'+data.stock_id+'</td><td>'+data.item_desc+'</td><td><input class="input-small" type="text" value="'+data.cost+'" name="item_cost"></td><td><input class="input-small" type="text" value="'+data.retail+'" name="item_retail"></td><td><input class="input-small" type="text" value="'+data.quantity+'" name="item_quantity"></td><td><input class="input-small" type="text" value="'+((data.retail-data.cost)*data.quantity)+'" readonly=""></td><td><input type="text" value="'+data.details+'" name="item_details"></td><td><input type="checkbox" name="item_status"></td><td><span class="btn btn-primary update_order_item" data-order-itemid="'+data.order_id+'"><i class="icon-ok"></i></span></td><td><a class="btn btn-danger delete_order_item delete_item_button" data-order-itemid="'+data.order_id+'" data-itemid="1" data-toggle="modal" href="#delete_order_item"><i class="icon-remove"></i></a></td>');
				} else {
					$('#delete_order_item').modal('hide');
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
	$("#create_item").modal({ keyboard: true, show: false});
	$("#delete_order").modal({ keyboard: true, show: false});
	$("#delete_order_item").modal({ keyboard: true, show: false});
	$("#add_item_order").modal({ keyboard: true, show: false});
});
