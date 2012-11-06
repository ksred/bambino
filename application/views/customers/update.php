<?php $this->load->view("_template/header.php"); ?>

<h2>Update Customer</h2>

<form method="post" action="/customers/update_process/" class="form form-horizontal">
	<div class="control-group">
		<label class="control-label">Name</label>
		<input type="text" name="customer_name_add" value="<?= $customer[0]->name ?>" class="controls" />
	</div>
	<div class="control-group">
		<label class="control-label">Contact Number</label>
		<input type="number" name="customer_number"  value="<?= $customer[0]->contact_number ?>"  class="controls"/>
	</div>
	<div class="control-group">
		<label class="control-label">Contact Email</label>
		<input type="email" name="customer_email"  value="<?= $customer[0]->contact_email ?>"  class="controls"/>
	</div>
	<div class="control-group">
		<label class="control-label">Delivery Address</label>
		<textarea type="text" name="customer_address" rows="5"  class="controls"/><?= $customer[0]->delivery_address ?></textarea>
		<input type="hidden" value="<?= $customer[0]->id ?>" name="customer_id" />
	</div>
	<div class="control-group">
		<label class="control-label"></label>
		<input type="submit" class="btn btn-large controls" value="Update Customer">
		<a href="/customers/delete/<?= $customer[0]->id ?>" class="btn btn-danger btn-large">Delete</a>
	</div>
</form>

<?php $this->load->view("_template/footer.php"); ?>
