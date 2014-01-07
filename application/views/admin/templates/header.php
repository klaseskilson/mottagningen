<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="no-js ie6" lang="en"><![endif]-->
<!--[if IE 7 ]><html class="no-js ie7" lang="en"><![endif]-->
<!--[if IE 8 ]><html class="no-js ie8" lang="en"><![endif]-->
<!--[if (gte IE 9)|(gt IEMobile 7)|!(IEMobile)|!(IE)]><!-->
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml" xmlns:og="http://ogp.me/ns#" class="no-js" lang="en">
<!--[if IE]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<head>
	<meta name="HandheldFriendly" content="True" />
	<meta name="MobileOptimized" content="320" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<link rel="canonical" href="" />

	<!-- swagstrap -->

	<link rel="stylesheet" href="<?php echo base_url(); ?>web/css/vendor/flatstrap.min.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>web/css/vendor/bootstrap-responsive.min.css" type="text/css" media="screen" />
	<!-- Legionen laddar sin egna adminstil, för den är så jäääävla swag -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>web/css/admin.css" type="text/css" media="screen" />
	<!-- fiiint -->
	<link href="<?php echo base_url(); ?>web/img/admin_apple-touch-icon.png" rel="apple-touch-icon" />
	<link href="<?php echo base_url(); ?>web/img/admin_apple-touch-icon-72x72.png" rel="apple-touch-icon" sizes="72x72" />
	<link href="<?php echo base_url(); ?>web/img/admin_apple-touch-icon-114x114.png" rel="apple-touch-icon" sizes="114x114" />
	<link href="<?php echo base_url(); ?>web/img/admin_apple-touch-icon-144x144.png" rel="apple-touch-icon" sizes="144x144" />
	<link rel="icon" type="image/png" href="<?php echo base_url(); ?>web/img/admin_favicon.png">

	<title>Legionen admin<?php if(isset($pagetitle)) echo ' '.$pagetitle; ?></title>

	<!-- load js -->
	<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
	<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>
	<!-- FANCYBOX! -->
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.4/jquery.fancybox.min.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.4/helpers/jquery.fancybox-thumbs.min.css" type="text/css" />
	<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.4/jquery.fancybox.min.js"></script>
	<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.4/helpers/jquery.fancybox-thumbs.min.js"></script>
	<!-- fejnt -->
	<script type="text/javascript" src="<?php echo base_url(); ?>web/js/admin.js"></script>

	<!-- WYSIWYG editor -->
	<script src="//tinymce.cachefly.net/4.0/tinymce.min.js"></script>
	<script>
		tinymce.init({
			selector:'#post_content',
			toolbar: "undo redo | styleselect | bold italic | bullist numlist outdent indent | link unlink image | code | removeformat",
			paste_as_text: true,
			plugins: "link code paste image",
			target_list: [
			    {title: 'Samma flik', value: '_self'},
			    {title: 'Ny flik', value: '_blank'}
			],
			menubar: false,
			paste_as_text: true,
			style_formats : [
				{title : 'Rubrik 1', block : 'h1',},
				{title : 'Rubrik 2', block : 'h2',},
				{title : 'Rubrik 3', block : 'h3',},
				{title : 'Rubrik 4', block : 'h4',},
				{title : 'Rubrik 5', block : 'h5',},
				{title : 'Normal', block : 'p',},
			],
			language_url : '<?php echo base_url(); ?>web/js/vendor/tinymce/sv.js'
		});
	</script>
	<!-- DROPZONE! -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>web/css/vendor/dropzone.css" type="text/css" media="screen" />

	<script>
	if (typeof jQuery == 'undefined')
	{
		document.write('');
	}
	</script>
</head>

<body>
<div id="content">
