<?php $this->load->view("_template/header.php"); ?>

<h2>View all suppliers</h2>

<table class="table table-striped">
	<tr>
		<th>Name</th>
		<th>Contact Person</th>
		<th>Contact Email</th>
		<th>Date Added</th>
		<th>Edit</th>
	</tr>
	<?php foreach ($suppliers->result() as $s) : ?>
	<tr>
		<td><?= $s->name ?></td>
		<td><?= $s->contact_name ?></td>
		<td><?= $s->contact_email ?></td>
		<td><?= $s->date ?></td>
		<td><a href="/suppliers/update/<?= $s->id ?>" class="btn" >Update</a></td>
	</tr>
	<?php endforeach; ?>
</table>
<?php $this->load->view("_template/footer.php"); ?>
