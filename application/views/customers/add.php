<?php $this->load->view("_template/header.php"); ?>

<h3>Add Customer</h3>

<form method="post" action="/customers/add_process/" class="form form-horizontal">
	<div class="control-group">
		<label class="control-label">Name</label>
		<input type="text" name="customer_name_add" class="controls" />
	</div>
	<div class="control-group">
		<label class="control-label">Contact Number</label>
		<input type="number" name="customer_number"  class="controls" />
	</div>
	<div class="control-group">
		<label class="control-label">Contact Email</label>
		<input type="email" name="customer_email"  class="controls" />
	</div>
	<div class="control-group">
		<label class="control-label">Delivery Address</label>
		<textarea type="text" name="customer_address" rows="5"  class="controls" /></textarea>
	</div>
	<div class="control-group">
		<label class="control-label"></label>
		<input type="submit" class="btn btn-large controls" value="Add Customer">
	</div>
</form>

<?php $this->load->view("_template/footer.php"); ?>
