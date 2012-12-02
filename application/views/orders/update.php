<?php $this->load->view("_template/header.php"); ?>

<h2>View Order</h2>
<div id="success" class="alert alert-success" style="display: none; position: fixed; top: 0px; width: 300px; text-align: center;">Successfully updated</div>
<div id="failure" class="alert alert-error" style="display: none; position: fixed; top: 0px; width: 300px; text-align: center;">An error occurred</div>

<?php foreach ($orders as $o) : ?>
<h4>Order number: <?= $o->site_order_id ?></h4>
	<label>Order status:</label>
	<select class="order_status">
	<?php foreach ($status_all as $s) :?>
		<option value="<?= $s->id ?>" <?= ($s->id == $o->status) ? "selected=selected" : "" ?>><?= $s->status ?></option>
	<?php endforeach; ?>
	</select>
	<span class="btn btn-primary update_order" data-orderid="<?= $o->id ?>">Update Status</span>
	<a href="#delete_order" class="btn btn-danger delete_order pull-right" data-orderid="<?= $o->id ?>" data-toggle="modal">Delete Order</a>
	<a class="order-add-item btn pull-right" data-toggle="modal" href="#add_item_order"><i class="icon-plus-sign"></i> Add Item</a>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Item</th>
			<th>Description</th>
			<th>Cost</th>
			<th>Retail</th>
			<th>Quantity</th>
			<th>Markup</th>
			<th>Details</th>
			<th>Status</th>
			<th>Edit</th>
			<th>Delete</th>
		</tr>
	</thead>
		<?php //In an ideal world, none of these model calls would be here. Might send massive nested object/array instead ?>
		<?php $order_items = $this->Model_orders->items_per_order($o->user_id, $o->id)->result(); ?>
		<?php foreach($order_items as $oi) : ?>
		<?php $order_meta = $this->Model_orders->item_meta_orders_items($o->user_id, $oi->oi_id)->result(); ?>
		<tr data-row-order-itemid="<?= $oi->oi_id ?>">
			<td><?= $oi->stock_id ?></td>
			<td><?= $oi->description ?></td>
			<td><input name="item_cost" type="text" value="<?= $order_meta[0]->cost ?>" class="input-small" ></td>
			<td><input name="item_retail" type="text" value="<?= $order_meta[0]->retail ?>" class="input-small" ></td>
			<td><input name="item_quantity" type="text" value="<?= $order_meta[0]->quantity ?>" class="input-small" ></td>
			<td><input type="text" readonly value="<?= (($order_meta[0]->retail - $order_meta[0]->cost) * (int) $order_meta[0]->quantity) ?>" class="input-small" ></td>
			<td><input name="item_details" type="text" value="<?= $order_meta[0]->details ?>" ></td>
			<td>
				<input type="checkbox" name="item_status" <?= ($order_meta[0]->item_status == 1) ? "checked=checked" : "" ?>>
			</td>
			</td>
			<td>
				<span class="btn btn-primary update_order_item" data-order-itemid="<?= $order_meta[0]->id ?>"><i class="icon-ok"></i></span>
			</td>
			<td>
				<a href="#delete_order_item" data-toggle="modal" class="btn btn-danger delete_order_item delete_item_button" data-itemid="<?= $oi->item_id ?>" data-order-itemid="<?= $oi->oi_id ?>"><i class="icon-remove"></i></a>
			</td>
			<?php $site_order_id = $o->site_order_id; ?>
		</tr>
		<?php endforeach; ?>
</table>
<?php endforeach; ?>

<div id="delete_order" role="dialog" class="modal hide fade">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h3>Delete order</h3>
	</div>
	<div style="padding:10px">Are you sure you want to delete this order?</div>
	<div class="modal-footer">
		<button id="delete_order_submit" class="btn btn-danger" data-orderid="<?= $o->id ?>">Delete</button>
		<a href="#" class="btn" data-dismiss="modal">Cancel</a>
	</div>
</div>

<div id="delete_order_item" role="dialog" class="modal hide fade">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h3>Delete item</h3>
	</div>
	<div style="padding:10px">Are you sure you want to delete this item from this order?</div>
	<div class="modal-footer">
		<button id="delete_order_item_submit" class="btn btn-danger" data-orderid="<?= $o->id ?>" data-itemid="" data-order-itemid="">Delete</button>
		<a href="#" class="btn" data-dismiss="modal">Cancel</a>
	</div>
</div>

<div id="add_item_order" role="dialog" class="modal hide fade">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h3>Add Item</h3>
	</div>
	<div style="padding:10px">Add an item to your order</div>
	<div class="alert alert-error error-fill-in-fields">Please fill in all fields</div>
	<div class="span6">
		<label>Item 1:</label>
		<input name="itemadd[code]" type="text" placeholder="Code" class="item_code_add input-small" data-provide="typeahead" data-itemid='1'/><input name="itemadd[quantity]" type="number" placeholder="Quantity" class="item_quantity_add input-small"/>
	</div>
	<div class="modal-footer">
		<button id="add_item_order_submit" class="btn btn-danger" data-orderid="<?= $o->id ?>" >Add</button>
		<a href="#" class="btn" data-dismiss="modal">Cancel</a>
	</div>
</div>

<?php $this->load->view("_template/footer.php"); ?>
