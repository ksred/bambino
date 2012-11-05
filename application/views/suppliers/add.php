<?php $this->load->view("_template/header.php"); ?>

<h2>Add a supplier</h2>

<form method="post" action="/suppliers/add_process" class="form form-horizontal">
	<div class="control-group">
		<label class="control-label">Supplier name</label>
		<input name="supplier" type="text" id="supplier" class="controls"/>
	</div>
	<div class="control-group">
		<label class="control-label">Supplier Contact Name</label>
		<input type="text" name="contact_name" data-provide="typeahead" id="contact_name" class="controls"/>
	</div>
	<div class="control-group">
		<label class="control-label">Supplier Contact Email</label>
		<input type="text" name="contact_email" data-provide="typeahead" id="contact_email" class="controls"/>
	</div>
	<div class="control-group">
		<label  class="control-label"></label>
		<input type="submit" class="btn btn-large controls" value="Add supplier">
	</div>
</form>

<?php $this->load->view("_template/footer.php"); ?>
