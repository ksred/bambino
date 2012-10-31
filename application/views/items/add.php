<?php $this->load->view("_template/header.php"); ?>

<h3>Add Item</h3>

<form method="post" action="/items/add_process/" class="form">
	<label>Stock ID</label>
	<input type="text" name="stock_id" />
	<label>Description</label>
	<input type="number" name="stock_desc" />
	<label>Supplier</label>
	<select name="stock_supplier">
		<?php foreach ($suppliers as $s) : ?>
			<option value="<?= $s->id ?>"><?= $s->name ?></option>
		<?php endforeach; ?>
	</select>
	<br />
	<input type="submit" class="btn" value="Add Item">
</form>

<?php $this->load->view("_template/footer.php"); ?>
