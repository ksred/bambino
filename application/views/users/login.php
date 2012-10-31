<?php $this->load->view("_template/header.php"); ?>

<h2>Users Login</h2>

<form method="post" action="/login/process" >
	<label>Email addy bro:</label>
	<input type="email" placeholder="princess@bubblegum.com" name="email" />
	<label>Password bro:</label>
	<input type="password" name="password" placeholder="passwordbro" />
	<br />
	<input type="submit" class="btn btn-primary" value="Login">
</form>

<?php $this->load->view("_template/footer.php"); ?>
