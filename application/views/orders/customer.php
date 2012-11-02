<?php $this->load->view("_template/header.php"); ?>

<h2>View all orders</h2>
<div id="success" class="alert alert-success" style="display: none; position: fixed; top: 0px; width: 300px; text-align: center;">Successfully updated</div>
<div id="failure" class="alert alert-error" style="display: none; position: fixed; top: 0px; width: 300px; text-align: center;">An error occurred</div>
<h3>Customer: <?= $customer[0]->name ?></h3>
<?php $site_order_id=''; ?>
<?php foreach ($orders as $o) : ?>
<h4>Order number: <?= $o->site_order_id ?></h4>
	<label>Order status:</label>
	<select class="order_status">
	<?php foreach ($status_all as $s) :?>
		<option value="<?= $s->id ?>" <?= ($s->id == $o->status) ? "selected=selected" : "" ?>><?= $s->status ?></option>
	<?php endforeach; ?>
	</select>
	<span class="btn btn-primary update_order" data-orderid="<?= $o->id ?>">Update Status</span>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Item</th>
			<th>Description</th>
			<th>Cost</th>
			<th>Retail</th>
			<th>Quantity</th>
			<th>Markup</th>
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
			<td><?= $order_meta[0]->cost ?></td>
			<td><?= $order_meta[0]->retail ?></td>
			<td><?= $order_meta[0]->quantity ?></td>
			<td><?= (($order_meta[0]->retail - $order_meta[0]->cost) * (int) $order_meta[0]->quantity) ?></td>
			<td>
				<?= "Item status" ?>
			</td>
			<td>
				<?= $o->date ?></td>
			<td>
			</td>
			<td>
				<span class="btn btn-primary update_order_item" data-order-itemid="<?= $order_meta[0]->id ?>">Update Item</span>
			</td>
			<?php $site_order_id = $o->site_order_id; ?>
		</tr>
		<?php endforeach; ?>
</table>
<?php endforeach; ?>

<?php $this->load->view("_template/footer.php"); ?>
