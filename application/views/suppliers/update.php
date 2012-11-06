<?php $this->load->view("_template/header.php"); ?>

<h2>Update a supplier</h2>

<form method="post" action="/suppliers/update_process" class="form form-horizontal">
	<div class="control-group">
		<label class="control-label">Supplier name</label>
		<input name="supplier" type="text" id="supplier" value="<?= $supplier[0]->name ?>" class="controls" />
	</div>
	<div class="control-group">
		<label class="control-label">Supplier Contact Name</label>
		<input type="text" name="contact_name" value="<?= $supplier[0]->contact_name ?>" id="contact_name" class="controls" />
	</div>
	<div class="control-group">
		<label class="control-label">Supplier Contact Email</label>
		<input type="text" name="contact_email" value="<?= $supplier[0]->contact_email ?>" id="contact_email" class="controls" />
	</div>
	<div class="control-group">
		<label class="control-label"></label>
		<input type="submit" class="btn btn-large controls" value="Update supplier">
		<a href="/suppliers/delete/<?= $supplier[0]->id ?>" class="btn btn-danger btn-large">Delete</a>
	</div>
</form>

<?php $this->load->view("_template/footer.php"); ?>
