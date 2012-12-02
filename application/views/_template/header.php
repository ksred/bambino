<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title><?= $title ?></title>
    <meta name="description" content="">
    <meta name="author" content="">

    <link href="<?= BASE_URL ?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= BASE_URL ?>assets/css/bootstrap-responsive.css" rel="stylesheet">
    <link href="<?= BASE_URL ?>assets/css/bambino.css" rel="stylesheet">

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

  </head>

  <body>
    <div class="container">
    <header class="span12">
		<div id="toplogo" class="pull-left"><a href="/">
			<img src="<?= BASE_URL ?>assets/img/full_logo_960.png" />
			</a>
		</div>
        <?php $this->load->view("_template/nav"); ?>
    </header>
    <hr />
    <div class="row span11">
