<?php $this->load->view("_template/header.php"); ?>

<h3>View Items</h3>

<table class="table table-striped">
	<thead>
		<th>Item</th>
		<th>Description</th>
		<th>Supplier</th>
		<th>Date Added</th>
		<th>Update</th>
	</thead>
	<tbody>
		<?php foreach ($items as $i) : ?>
		<tr>
			<td><?= $i->stock_id ?></td> 
			<td><?= $i->description ?></td> 
			<td><?= $i->supplier ?></td> 
			<td><?= $i->date ?></td> 
			<td><a href="/items/update/<?= $i->id ?>" class="btn">Update</a></td>
		</tr>
		<?php endforeach; ?>
	</tbody>
<?php $this->load->view("_template/footer.php"); ?>
