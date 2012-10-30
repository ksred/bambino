<?php $this->load->view("_template/header.php"); ?>

<h2>Update a supplier</h2>

<form method="post" action="/suppliers/update_process">
	<label>Supplier name</label>
	<input name="supplier" type="text" id="supplier" value="<?= $supplier[0]->name ?>"/>
	<label>Supplier Contact Name</label>
	<input type="text" name="contact_name" value="<?= $supplier[0]->contact_name ?>" id="contact_name"/>
	<label>Supplier Contact Email</label>
	<input type="text" name="contact_email" value="<?= $supplier[0]->contact_email ?>" id="contact_email"/>
	<br /><br />
	<input type="submit" class="btn" value="Update supplier">
	<a href="/suppliers/delete/<?= $supplier[0]->id ?>" class="btn btn-danger">Delete</a>
</form>

<?php $this->load->view("_template/footer.php"); ?>
