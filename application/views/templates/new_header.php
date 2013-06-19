<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="sv"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="sv"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="sv"> <![endif]-->
<!--[if IE 9 ]><html class="ie ie9" lang="sv"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="sv"> <!--<![endif]-->

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>Legionen <?php echo isset($title) ? $title : '&ndash; Nollans beskyddare'; ?></title>

	<!-- Legionen laddar Bootstrap, för det är swag -->
	<link rel="stylesheet" href="/web/css/bootstrap.min.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="/web/css/bootstrap-responsive.min.css" type="text/css" media="screen" />
	<!-- Legionen laddar sin egna stil, för den är så jäääävla swag -->
	<link rel="stylesheet" href="/web/css/style.css" type="text/css" media="screen" />

	<script>
	var sunset = <?php echo /*strtotime('2013-06-13 19:10')*/ $sunset; ?>%86400,
		sunrise = <?php echo /*strtotime('2013-06-13 19:16')*/ $sunrise; ?>%86400;

	// color values [R, G, B]
	var sunsetdark = [151, 38, 0], sunsetlight = [253, 64, 0],
		daydark = [38, 97, 165], daylight = [171, 201, 236],
		nightdark = [8, 13, 17], nightlight = [41, 66, 86];
	</script>
</head>

<body class="<?php echo $daytime; ?>">
	<div id="background"></div>
	<div id="sunplaceholder"></div>
	<div id="container">
		<div id="masthead" class="wrapper">
			<h1 class="pagetitle">Legionen</h1>
			<ul class="mainmenu">
				<?php
				foreach ($menu_pages as $page) {
					?>
					<li><a href="sida/visa/<?php echo $page['slug']; ?>"><?php echo $page['title']; ?></a></li>
					<?php
				}

				do_dump($menu_pages);
				?>
			</ul>
		</div>
		<div id="clouds"></div>
