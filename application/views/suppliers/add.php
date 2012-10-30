<?php $this->load->view("_template/header.php"); ?>

<h2>Add a supplier</h2>

<form method="post" action="/suppliers/add_process">
	<label>Supplier name</label>
	<input name="supplier" type="text" id="supplier"/>
	<label>Supplier Contact Name</label>
	<input type="text" name="contact_name" data-provide="typeahead" id="contact_name"/>
	<label>Supplier Contact Email</label>
	<input type="text" name="contact_email" data-provide="typeahead" id="contact_email"/>
	<br /><br />
	<input type="submit" class="btn" value="Add supplier">
</form>

<?php $this->load->view("_template/footer.php"); ?>
