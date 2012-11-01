$(document).ready( function() {

	var item_id = $('.order_item').attr('data-itemid');
	$('#add_item').click( function() {
		item_id = parseInt(item_id) + 1;
		$('.order_item').append(
			'<label>Item '+item_id+': Code</label><input name="item'+item_id+'[code]" type="text" class="item_code"/>'	
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

	$('[name="item[code]"]').typeahead({
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

	//Modal for adding user
	$("#add_user").modal({ keyboard: true, show: false});
});
