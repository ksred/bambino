<?php $this->load->view("_template/header.php"); ?>

<h3>Add Item</h3>

<form method="post" action="/items/add_process/" class="form form-horizontal">
	<div class="control-group">
		<label class="control-label">Stock ID</label>
		<input type="text" name="stock_id" class="controls" />
	</div>
	<div class="control-group">
		<label class="control-label">Description</label>
		<input type="text" name="stock_desc"  class="controls"/>
	</div>
	<div class="control-group">
		<label class="control-label">Cost</label>
		<input type="number" name="stock_cost" class="controls" />
	</div>
	<div class="control-group">
		<label class="control-label">Retail</label>
		<input type="number" name="stock_retail" class="controls" />
	</div>
	<div class="control-group">
		<label class="control-label">Supplier</label>
		<select name="stock_supplier" class="controls">
			<?php foreach ($suppliers as $s) : ?>
				<option value="<?= $s->id ?>"><?= $s->name ?></option>
			<?php endforeach; ?>
		</select>
	</div>
	<div class="control-group">
		<label class="control-label"></label>
		<input type="submit" class="btn btn-large controls" value="Add Item">
	</div>
</form>

<?php $this->load->view("_template/footer.php"); ?>
