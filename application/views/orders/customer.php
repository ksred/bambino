<?php $this->load->view("_template/header.php"); ?>

<h2>View all orders</h2>
<div id="success" class="alert alert-success" style="display: none; position: fixed; top: 0px; width: 300px; text-align: center;">Successfully updated</div>
<div id="failure" class="alert alert-error" style="display: none; position: fixed; top: 0px; width: 300px; text-align: center;">An error occurred</div>
<h3>Customer: <?= $customer[0]->name ?></h3>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Order no</th>
			<th>Item</th>
			<th>Description</th>
			<th>Cost</th>
			<th>Retail</th>
			<th>Quantity</th>
			<th>Markup</th>
			<th>Customer</th>
			<th>Date</th>
			<th>Status</th>
			<th>Edit</th>
		</tr>
	</thead>
	<?php $site_order_id=''; ?>
	<?php foreach ($orders as $o) : ?>
		<tr>
			<td>
			<?php if ($site_order_id != $o->site_order_id) : ?>
				<a href="/orders/update/<?= $o->id ?>"><?= $o->site_order_id ?></a>
			<?php endif; ?>
			</td>
			<td><?= $o->item ?></td>
			<td><?= $o->description ?></td>
			<td><?= $o->cost ?></td>
			<td><?= $o->retail ?></td>
			<td><?= $o->quantity ?></td>
			<td><?= (($o->retail - $o->cost) * (int) $o->quantity) ?></td>
			<td>
			<?php if ($site_order_id != $o->site_order_id) : ?>
				<?= $o->customer ?>
			<?php endif; ?>
			</td>
			<td>
			<?php if ($site_order_id != $o->site_order_id) : ?>
				<?= $o->date ?></td>
			<?php endif; ?>
			<td>
			<?php if ($site_order_id != $o->site_order_id) : ?>
				<select class="order_status">
				<?php foreach ($status_all as $s) :?>
					<option value="<?= $s->id ?>" <?= ($s->id == $o->status) ? "selected=selected" : "" ?>><?= $s->status ?></option>
				<?php endforeach; ?>
				</select>
			<?php endif; ?>
			</td>
			<td>
			<?php if ($site_order_id != $o->site_order_id) : ?>
				<span class="btn btn-primary update_order" data-orderid="<?= $o->id ?>">Update</span>
			<?php endif; ?>
			</td>
			<?php $site_order_id = $o->site_order_id; ?>
		</tr>
	<?php endforeach; ?>
</table>

<?php $this->load->view("_template/footer.php"); ?>
