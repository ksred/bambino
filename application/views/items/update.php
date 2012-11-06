<?php $this->load->view("_template/header.php"); ?>

<h3>Update Item</h3>

<form method="post" action="/items/update_process/" class="form form-horizontal">
	<div class="control-group">
		<label class="control-label">Stock ID</label>
		<input type="text" name="stock_id" value="<?= $item[0]->stock_id ?>" class="controls"/>
	</div>
	<div class="control-group">
		<label class="control-label">Description</label>
		<input type="number" name="stock_desc" value="<?= $item[0]->description ?>" class="controls" />
	</div>
	<div class="control-group">
		<label class="control-label">Supplier</label>
		<select name="stock_supplier" class="controls">
			<?php foreach ($suppliers as $s) : ?>
				<option value="<?= $s->id ?>" <?= ($s->id == $item[0]->supplier_id) ? "selected:selected" : "" ?>><?= $s->name ?></option>
			<?php endforeach; ?>
		</select>
	</div>
	<div class="control-group">
		<label class="control-label"></label>
		<input type="hidden" name="item_id" value="<?= $item[0]->id ?>" />
		<input type="submit" class="btn btn-large controls" value="Update Item">
		<a href="/items/delete/<?= $item[0]->id ?>" class="btn btn-danger btn-large">Delete</a>
	</div>
</form>

<?php $this->load->view("_template/footer.php"); ?>
