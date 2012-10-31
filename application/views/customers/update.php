<?php $this->load->view("_template/header.php"); ?>

<h2>Update Customer</h2>

<form method="post" action="/customers/update_process/" class="form">
	<label>Name</label>
	<input type="text" name="customer_name_add" value="<?= $customer[0]->name ?>" />
	<label>Contact Number</label>
	<input type="number" name="customer_number"  value="<?= $customer[0]->contact_number ?>" />
	<label>Contact Email</label>
	<input type="email" name="customer_email"  value="<?= $customer[0]->contact_email ?>" />
	<label>Delivery Address</label>
	<textarea type="text" name="customer_address" rows="5" /><?= $customer[0]->delivery_address ?></textarea>
	<input type="hidden" value="<?= $customer[0]->id ?>" name="customer_id" />
	<br />
	<input type="submit" class="btn" value="Update Customer">
	<a href="/customers/delete/<?= $customer[0]->id ?>" class="btn btn-danger">Delete</a>
</form>

<?php $this->load->view("_template/footer.php"); ?>
