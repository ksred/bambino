<h2>Add a supplier</h2>

<form method="post" action="/suppliers/add_process">
	<label>Supplier name</label>
	<input name="supplier" type="text" id="supplier"/>
	<label>Supplier Contact Name</label>
	<input type="text" name="contact_name" data-provide="typeahead" id="contact_name"/>
	<label>Supplier Contact Email</label>
	<input type="text" name="contact_email" data-provide="typeahead" id="contact_email"/>
	<br /><br />
	<a href="javascript:void(0)" class="btn btn-primary" onclick="supplier_submit()" />Add supplier</a>
</form>

<script>
	function supplier_submit () {
		var supplier = $('[name="supplier"]').val();
		var contact_name = $('[name="contact_name"]').val();
		var contact_email = $('[name="contact_email"]').val();
		$.ajax({
			url: '/suppliers/add_post',
			type: 'POST',
			data: 'supplier=' + supplier + '&contact_name=' + contact_name + '&contact_email=' + contact_email,
			dataType: 'JSON',
			async: false,
			success: function(data) {
			}
		})
		return;
	}
</script>
