<?php $this->load->view("_template/header.php"); ?>

<h2>View All Customers</h2>

<table class="table table-striped">
	<thead>
		<th>Name</th>
		<th>Contact Number</th>
		<th>Contact Email</th>
		<th>Delivery Address</th>
		<th>Orders</th>
		<th>Update</th>
	</thead>
	<?php foreach ($customers as $c) : ?>
	<tr>
		<td><?= $c->name ?></td>
		<td><?= $c->contact_number ?></td>
		<td><?= $c->contact_email ?></td>
		<td><?= $c->delivery_address ?></td>
		<td><a href="/orders/customer/<?= $c->id ?>" class="btn btn-primary">Orders</a></td>
		<td><a href="/customers/update/<?= $c->id ?>" class="btn">Update</a></td>
	</tr>
	<?php endforeach; ?>
</table>
<?php $this->load->view("_template/footer.php"); ?>
