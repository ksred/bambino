<?php $this->load->view("_template/header.php"); ?>

<h2>Add an order</h2>

<form method="post" action="/orders/add_process">
	<label>Customer name</label>
	<input name="customer_name" type="text" data-provide="typeahead" id="customer_name"/>
	<label>Customer delivery details</label>
	<input type="text" name="customer_details" id="customer_details"/>
	<a href="#add_user" role="button" class="btn" data-toggle="modal">Add user</a>

	<label>Order ID (from site)</label>
	<input type="text" name="site_order_id" id="order_id"/>
	<label>Notes</label>
	<input type="text" name="note"/>
	<label>Order status</label>
	<select name="status">
	<?php foreach ($status as $s) : ?>
		<option value="<?= $s->id ?>"><?= $s->status ?></option>
	<?php endforeach; ?>
	</select>
	<div class="order_item form-horizontal" data-itemid="1">
		<h3>Item 1:</h3>
		<label>Code</label>
		<input name="item1[code]" type="text" class="item_code"/>
		<label>Description</label>
		<input name="item1[desc]" type="text" class="item+desc"/>
		<label>Quantity</label>
		<input type="number" name="item1[quantity]" class="item_quantity"/>
		<label>Cost</label>
		<input type="number" name="item1[cost]" class="item_cost"/>
		<label>Retail</label>
		<input type="number" name="item1[retail]" class="item_retail"/>
	</div>
	<div id="add_item" class="btn">Add item</div>

	<input type="hidden" value="1" name="item_total" id="item_total">
	<br /><br />
	<input type="submit" class="btn-primary btn-large" value="Add order"/>
</form>

<div id="add_user" role="dialog" class="modal hide fade">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h3>Add a user</h3>
	</div>
	<div class="modal-body">
		<?php $this->load->view("_template/add_customer.php"); ?>
	</div>
	<div class="modal-footer">
		<a href="#" class="btn" data-dismiss="modal">Close</a>
	</div>
</div>

<?php $this->load->view("_template/footer.php"); ?>
