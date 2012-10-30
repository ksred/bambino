<form method="post" action="/customers/add_post/" class="form">
	<label>Name</label>
	<input type="text" name="customer_name_add" />
	<label>Contact Number</label>
	<input type="number" name="customer_number" />
	<label>Contact Email</label>
	<input type="email" name="customer_email" />
	<label>Delivery Address</label>
	<textarea type="text" name="customer_address" rows="5" /></textarea>
	<br />
	<a href="javascript:void(0)" class="btn" id="add_customer" onclick="add_customer_js()">Add customer</a>
</form>

<script>
	function add_customer_js () {
		var name_customer = $('[name="customer_name_add"]').val();
		var number_customer = $('[name="customer_number"]').val();
		var email = $('[name="customer_email"]').val();
		var address = $('[name="customer_address"]').val();
		$.ajax({
			url: '/customers/add_post',
			type: 'POST',
			data: 'name=' + name_customer + '&number=' + number_customer + '&email=' + email + '&address=' + address,
			dataType: 'JSON',
			async: false,
			success: function(data) {
				$("#add_user").modal('hide');
				$('[name="customer_name"]').val(data.name);
				$('[name="customer_details"]').val(data.address);
			}
		})
		return;
	}
</script>
