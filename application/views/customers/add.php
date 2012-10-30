<?php $this->load->view("_template/header.php"); ?>

<h3>Add Customer</h3>

<form method="post" action="/customers/add_process/" class="form">
	<label>Name</label>
	<input type="text" name="customer_name_add" />
	<label>Contact Number</label>
	<input type="number" name="customer_number" />
	<label>Contact Email</label>
	<input type="email" name="customer_email" />
	<label>Delivery Address</label>
	<textarea type="text" name="customer_address" rows="5" /></textarea>
	<br />
	<input type="submit" class="btn" value="Add Customer">
</form>

<?php $this->load->view("_template/footer.php"); ?>
