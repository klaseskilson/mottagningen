<?php
// neat menu
?>

<div class="navbar" id="headermenu">
	<div class="navbar-inner">
		<div class="container">

			<!-- .btn-navbar is used as the toggle for collapsed navbar content -->
			<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</a>

			<!-- Be sure to leave the brand out there if you want it shown -->
			<a class="brand" href="/admin">Legionen admin</a>

			<!-- Everything you want hidden at 940px or less, place within here -->
			<div class="nav-collapse collapse">
				<ul class="nav">
					<li><a href="/admin">Hem</a></li> <!-- class="active" -->
					<li><a href="/admin/fadder">Faddrar</a></li>
				</ul>
				<ul class="nav pull-right">
					<li><a href="/">Gå till sidan</a></li>
					<li><a href="/admin/login/logout">Logga ut</a></li>
				</ul>
			</div>

		</div>
	</div>
</div>
