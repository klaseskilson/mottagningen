<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="sv"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="sv"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="sv"> <![endif]-->
<!--[if IE 9 ]><html class="ie ie9" lang="sv"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="sv"> <!--<![endif]-->

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta property="og:description" content="Legionen – Nollans beskyddare. Legionen är GDK- och MT-sektionernas phadderi på Tekniska högskolan vid Linköpings Universitet, Campus Norrköping."/>
	<meta property="og:image" content="http://legionen.nu/web/img/ogimage.jpg"/>
	<meta property="og:title" content="Legionen – Nollans beskyddare - legionen.nu"/>
	<meta name="description" content="Legionen – Nollans beskyddare. Legionen är GDK- och MT-sektionernas phadderi på Tekniska högskolan vid Linköpings Universitet, Campus Norrköping." />

	<title>Legionen <?php echo isset($title) ? $title : '&ndash; Nollans beskyddare'; ?></title>

	<!-- Legionen laddar Bootstrap, för det är swag -->
	<link rel="stylesheet" href="/web/css/vendor/bootstrap.min.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="/web/css/vendor/bootstrap-responsive.min.css" type="text/css" media="screen" />
	<!-- Legionen laddar sin egna stil, för den är så jäääävla B R A. -->
	<link rel="stylesheet" href="/web/css/style.min.css" type="text/css" media="screen" />
	<!-- Åååååh, så fejnt det kan bli på hemskärmen -->
	<link href="/web/img/apple-touch-icon.png" rel="apple-touch-icon" />
	<link href="/web/img/apple-touch-icon-72x72.png" rel="apple-touch-icon" sizes="72x72" />
	<link href="/web/img/apple-touch-icon-114x114.png" rel="apple-touch-icon" sizes="114x114" />
	<link href="/web/img/apple-touch-icon-144x144.png" rel="apple-touch-icon" sizes="144x144" />
	<link rel="icon" type="image/png" href="/web/img/favicon.png">

	<script>
	var sunrise = <?php echo /*strtotime("2013-06-25 18:01")*/ $sunrise; ?>%86400,
		sunset = <?php echo /*strtotime("2013-06-25 18:10")*/ $sunset; ?>%86400;

	// color values [R, G, B]
	var sunsetdark = [151, 38, 0], sunsetlight = [253, 64, 0],
		daydark = [38, 97, 165], daylight = [171, 201, 236],
		nightdark = [8, 13, 17], nightlight = [41, 66, 86];
	</script>
</head>

<body class="<?php echo $daytime; ?>">
	<div id="background"></div>
	<div id="container">
		<header id="masthead" class="wrapper">
			<h1 class="pagetitle"><a href="/">Legionen</a></h1>
			<ul class="mainmenu">
				<li><a href="/sida/bilder/">Bilder</a></li>
				<!-- <li><a href="http://bit.ly/12f2Mng" target="_blank" title="Fyll i denna, Nollan.">Nollan-enkäten</a></li> -->
				<?php
				foreach ($menu_pages as $page) {
					?>
					<li><a href="/sida/visa/<?php echo $page['slug']; ?>"><?php echo $page['title']; ?></a></li>
					<?php
				}
				?>
			</ul>
		</header>
		<div id="clouds"></div>
		<div class="clearfix"></div>
