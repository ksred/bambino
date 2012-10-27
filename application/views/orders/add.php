<?php $this->load->view("_template/header.php"); ?>

<h2>Add an order</h2>

<form method="post" action="/orders/add_process">
	<label>Customer name</label>
	<input name="customer_name" type="text"/>
	<label>Customer delivery details</label>
	<input type="text" name="customer_details"/>

	<label>Notes</label>
	<input type="text" name="note"/>
	<label>Order status</label>
	<select name="status">
	<?php foreach ($status as $s) : ?>
		<option value="<?= $s->id ?>"><?= $s->status ?></option>
	<?php endforeach; ?>
	</select>
	<div class="order_item" data-itemid="1">
		<h3>Item 1:</h3>
		<label>Code</label>
		<input name="item1[code]" type="text"/>
		<label>Description</label>
		<input name="item1[desc]" type="text"/>
		<label>Quantity</label>
		<input type="number" name="item1[quantity]"/>
		<label>Cost</label>
		<input type="number" name="item1[cost]"/>
		<label>Retail</label>
		<input type="number" name="item1[retail]"/>
	</div>
	<div id="add_item" class="btn">Add item</div>

	<input type="hidden" value="1" name="item_total" id="item_total">
	<br /><br />
	<input type="submit" class="btn-primary btn-large" value="Add order"/>
</form>

<?php $this->load->view("_template/footer.php"); ?>
