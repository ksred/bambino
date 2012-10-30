<?php $this->load->view("_template/header.php"); ?>

<?php $success = $this->session->flashdata("success"); ?> 
<?php if(isset($success)) : ?>
	<?php if ($success == 1) :?>
		<div class="span9 alert alert-success"><?= $this->session->flashdata("msg") ?></div>
	<?php else : ?>
		<div class="span9 alert alert-error"><?= $this->session->flashdata("msg") ?></div>
	<?php endif; ?>
<?php endif; ?>

<?php $this->load->view("_template/footer.php"); ?>
