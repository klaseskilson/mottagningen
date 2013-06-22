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
					<li><a href="/admin"><i class="icon-home"></i> Hem</a></li> <!-- class="active" -->
					<?php
					if($this->login->has_privilege('2'))
					{
					?>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<i class="icon-user"></i> Användare
							<b class="caret"></b>
						</a>
						<ul class="dropdown-menu">
							<li><a href="/admin/user/all">Se alla</a></li>
							<li class="divider"></li>
							<li class="nav-header">Skapa ny!</li>
							<li><a href="/admin/user/new">Skapa ny användare</a></li>
						</ul>
					</li>
					<?php
					}
					?>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<i class="icon-info-sign"></i> Sidor
							<b class="caret"></b>
						</a>
						<ul class="dropdown-menu">
							<li><a href="/admin/page/new">Skapa ny sida</a></li>
							<li class="divider"></li>
							<li><a href="/admin/page/all">Se alla</a></li>
						</ul>
					</li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<i class="icon-file"></i> Inlägg
							<b class="caret"></b>
						</a>
						<ul class="dropdown-menu">
							<li><a href="/admin/post/new">Skapa nytt inlägg</a></li>
							<li class="divider"></li>
							<li><a href="/admin/post/all">Se alla inlägg</a></li>
						</ul>
					</li>
				</ul>
				<ul class="nav pull-right">
					<li>
						<a href="/admin/user/me" title="Redigera konto">
							<i class="icon-cog"></i> Inloggad som <?php echo $this->login->get_info("fname"); ?>
						</a>
					</li>
					<li><a href="/"><i class="icon-globe"></i> Gå till sidan</a></li>
					<li><a href="/admin/login/logout"><i class="icon-road"></i> Logga ut</a></li>
				</ul>
			</div>

		</div>
	</div>
</div>
