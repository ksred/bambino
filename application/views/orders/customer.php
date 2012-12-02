<?php $this->load->view("_template/header.php"); ?>

<h2>View all orders</h2>
<div id="success" class="alert alert-success" style="display: none; position: fixed; top: 0px; width: 300px; text-align: center;">Successfully updated</div>
<div id="failure" class="alert alert-error" style="display: none; position: fixed; top: 0px; width: 300px; text-align: center;">An error occurred</div>
<h3>Customer: <?= $customer[0]->name ?></h3>
<?php $site_order_id=''; ?>
<?php foreach ($orders as $o) : ?>
<a href="/orders/update/<?= $o->id ?>" class="btn btn-primary">Order number: <?= $o->site_order_id ?></a>
	<label>Order status:</label>
	<select class="order_status">
	<?php foreach ($status_all as $s) :?>
		<option value="<?= $s->id ?>" <?= ($s->id == $o->status) ? "selected=selected" : "" ?>><?= $s->status ?></option>
	<?php endforeach; ?>
	</select>
	<span class="btn btn-primary update_order" data-orderid="<?= $o->id ?>"><i class="icon-ok"></i></span>
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
		</tr>
	</thead>
		<?php //In an ideal world, none of these model calls would be here. Might send massive nested object/array instead ?>
		<?php $order_items = $this->Model_orders->items_per_order($o->user_id, $o->id)->result(); ?>
		<?php foreach($order_items as $oi) : ?>
		<?php $order_meta = $this->Model_orders->item_meta_orders_items($o->user_id, $oi->oi_id)->result(); ?>
		<tr>
			<td><?= $oi->stock_id ?></td>
			<td><?= $oi->description ?></td>
			<td><input name="item_cost" type="text" value="<?= $order_meta[0]->cost ?>" class="input-small" ></td>
			<td><input name="item_retail" type="text" value="<?= $order_meta[0]->retail ?>" class="input-small" ></td>
			<td><input name="item_quantity" type="text" value="<?= $order_meta[0]->quantity ?>" class="input-small" ></td>
			<td><input type="text" readonly value="<?= (($order_meta[0]->retail - $order_meta[0]->cost) * (int) $order_meta[0]->quantity) ?>" class="input-small" ></td>
			<td><input name="item_details" type="text" value="<?= $order_meta[0]->details ?>" ></td>
			<td>
				<?= "Item status" ?>
			</td>
			<td>
				<?= $o->date ?></td>
			<td>
			</td>
			<td>
				<span class="btn btn-primary update_order_item" data-order-itemid="<?= $order_meta[0]->id ?>"><i class="icon-ok"></i></span>
			</td>
			<?php $site_order_id = $o->site_order_id; ?>
		</tr>
		<?php endforeach; ?>
</table>
<?php endforeach; ?>

<?php $this->load->view("_template/footer.php"); ?>
