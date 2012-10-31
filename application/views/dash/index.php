<?php $this->load->view("_template/header.php"); ?>

<h2>Welcome to Bambino</h2>

<?php $user_id = $this->session->userdata("id"); if (!isset($user_id)) : ?>
<form method="post" action="/login/process" >
	<label>Email addy bro:</label>
	<input type="email" placeholder="princess@bubblegum.com" name="email" />
	<label>Password bro:</label>
	<input type="password" name="password" placeholder="passwordbro" />
	<br />
	<input type="submit" class="btn btn-primary" value="Login">
</form>

<?php else : ?>
	Yo, logged in.
<?php endif; ?>
<?php $this->load->view("_template/footer.php"); ?>
