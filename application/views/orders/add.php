<?php $this->load->view("_template/header.php"); ?>

<h2>Add an order</h2>
<div class="alert alert-error hidden" id="order_error"></div>

<form method="post" action="/orders/add_process" class="form form-horizontal" id="order_add_form">
	<div class="control-group">
		<label class="control-label">Customer name</label>
		<input name="customer_name" type="text" data-provide="typeahead" id="customer_name" class="controls"/>
		<a href="#add_user" role="button" class="btn" data-toggle="modal">Add customer</a>
	</div>

	<div class="control-group">
		<label class="control-label">Order ID (from site)</label>
		<input type="text" name="site_order_id" id="order_id" class="controls"/>
	</div>
	<div class="control-group">
		<label class="control-label">Order status</label>
		<select name="status" class="controls">
		<?php foreach ($status as $s) : ?>
			<option value="<?= $s->id ?>"><?= $s->status ?></option>
		<?php endforeach; ?>
		</select>
	</div>
	<div class="order_item form-horizontal span12" data-itemid="1">
		<strong>Items</strong>
		<div id="add_item" class="btn">+</div>
		<div class="span12" style="margin: 10px 0px"></div>
		<div class="span3 pull-left">
			<label>Item 1:</label>
			<input name="item1[code]" type="text" placeholder="Code" class="item_code input-small" data-provide="typeahead" data-itemid='1'/><input name="item1[quantity]" type="number" placeholder="Quantity" class="item_quantity  input-small" data-itemid='1'/>
		</div>
	</div>

	<input type="hidden" value="1" name="item_total" id="item_total">
	<div class="span12" style="margin: 10px 0px;"></div>
	<input type="button" class="btn-primary btn-large pull-left" value="Add order" id="order_add"/>
</form>

<div id="add_user" role="dialog" class="modal hide fade">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h3>Add a customer</h3>
	</div>
	<div class="modal-body">
		<?php $this->load->view("_template/add_customer.php"); ?>
	</div>
	<div class="modal-footer">
		<a href="#" class="btn" data-dismiss="modal">Close</a>
	</div>
</div>

<?php $this->load->view("_template/footer.php"); ?>
