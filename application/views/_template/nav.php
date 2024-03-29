<?php if (!isset($nav)) : $nav = ""; endif; ?>
<div class="navbar pull-right navbar-inverse">
	<div class="navbar-inner">
		<ul class="nav">
			<li><a href="/"><img src="<?= BASE_URL ?>assets/img/icon.png"/></a></li>
			<li class="<?= ($nav == 'orders') ? "active " : "" ?> dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					Orders
					<b class="caret"></b>
				</a>
				<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
					<li><a href="/orders/add">Add</a></li>
					<li><a href="/orders/view">View</a></li>
				</ul>
			</li>
			<li class="<?= ($nav == 'customers') ? "active " : "" ?> dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					Customers	
					<b class="caret"></b>
				</a>
				<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
					<li><a href="/customers/add">Add</a></li>
					<li><a href="/customers/view">View</a></li>
				</ul>
			</li>
			<li class="<?= ($nav == 'items') ? "active " : "" ?> dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					Items	
					<b class="caret"></b>
				</a>
				<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
					<li><a href="/items/add">Add</a></li>
					<li><a href="/items/view">View</a></li>
				</ul>
			</li>
			<li class="<?= ($nav == 'suppliers') ? "active " : "" ?> dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					Suppliers	
					<b class="caret"></b>
				</a>
				<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
					<li><a href="/suppliers/add">Add</a></li>
					<li><a href="/suppliers/view">View</a></li>
				</ul>
			</li>
			<li>
				<a href="login/logout">
					<strong>Logout</strong>
				</a>
			</li>
		</ul>
	</div>
</div>
