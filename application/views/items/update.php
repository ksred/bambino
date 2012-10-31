<?php $this->load->view("_template/header.php"); ?>

<h3>Update Item</h3>

<form method="post" action="/items/update_process/" class="form">
	<label>Stock ID</label>
	<input type="text" name="stock_id" value="<?= $item[0]->stock_id ?>"/>
	<label>Description</label>
	<input type="number" name="stock_desc" value="<?= $item[0]->description ?>" />
	<label>Supplier</label>
	<select name="stock_supplier">
		<?php foreach ($suppliers as $s) : ?>
			<option value="<?= $s->id ?>" <?= ($s->id == $item[0]->supplier_id) ? "selected:selected" : "" ?>><?= $s->name ?></option>
		<?php endforeach; ?>
	</select>
	<input type="hidden" name="item_id" value="<?= $item[0]->id ?>" />
	<br />
	<input type="submit" class="btn" value="Update Item">
	<a href="/items/delete/<?= $item[0]->id ?>" class="btn btn-danger">Delete</a>
</form>

<?php $this->load->view("_template/footer.php"); ?>
