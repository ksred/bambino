<?php $this->load->view("_template/header.php"); ?>
<?php $this->load->model("Model_orders"); ?>

<h2>View all orders</h2>
<div id="success" class="alert alert-success" style="display: none; position: fixed; top: 0px; width: 300px; text-align: center;">Successfully updated</div>
<div id="failure" class="alert alert-error" style="display: none; position: fixed; top: 0px; width: 300px; text-align: center;">An error occurred</div>

<table class="table table-striped">
	<thead>
		<tr>
			<th>Order no</th>
			<th>Customer</th>
			<th>Items</th>
			<th>Status</th>
			<th>Date</th>
			<th>Update</th>
		</tr>
	</thead>
	<?php $site_order_id=''; ?>
	<?php foreach ($orders->result() as $o) : ?>
		<tr>
			<td>
				<a href="/orders/update/<?= $o->id ?>" class="btn btn-primary"><?= $o->site_order_id ?></a>
			</td>
			<td>
				<a href="/orders/customer/<?= $o->customer_id ?>" class="btn"><?= $o->customer ?></a>
			</td>
			<td>
			<?php //In an ideal world, none of these model calls would be here. Might send massive nested object/array instead ?>
			<?php $order_items = $this->Model_orders->items_per_order($o->user_id, $o->id)->result(); ?>
			<?php foreach($order_items as $oi) : ?>
			<?php $order_meta = $this->Model_orders->item_meta_orders_items($o->user_id, $oi->oi_id)->result(); ?>
				<?= $oi->quantity ?> x <?= $oi->description ?> : <?= $order_meta[0]->details ?><br />
			<?php endforeach; ?>
			</td>
			<td>
				<select class="order_status">
				<?php foreach ($status_all as $s) :?>
					<option value="<?= $s->id ?>" <?= ($s->id == $o->status) ? "selected=selected" : "" ?>><?= $s->status ?></option>
				<?php endforeach; ?>
				</select>
			</td>
			<td>
				<?= $o->date ?>
			</td>
			<td>
				<span class="btn btn-primary update_order" data-orderid="<?= $o->id ?>">Update</span>
			</td>
		</tr>
	<?php endforeach; ?>
</table>

<?php $this->load->view("_template/footer.php"); ?>
