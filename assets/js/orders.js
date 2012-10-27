$(document).ready( function() {

	var item_id = $('.order_item').attr('data-itemid');
	$('#add_item').click( function() {
		item_id = parseInt(item_id) + 1;
		$('.order_item').append(
			'<h3>Item '+item_id+':</h3><label>Code</label><input name="item'+item_id+'[code]" type="text"/><label>Description</label><input name="item'+item_id+'[desc]" type="text"/><label>Quantity</label><input type="number" name="item'+item_id+'[quantity]"/><label>Cost</label><input type="number" name="item'+item_id+'[cost]"/><label>Retail</label><input type="number" name="item'+item_id+'[retail]"/>'	
		);
		$('#item_total').val(item_id);
	});
});
