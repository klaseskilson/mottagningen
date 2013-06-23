<?php
// new fancy layout
?>

<div class="wrapper container-fluid">
	<div class="row-fluid">
		<div class="span8">
			<div class="maincontent page">
				<h2 class="pagetitle"><?php echo $page['title']; ?></h2>
				<?php
				echo $page['content'];
				?>
			</div>
		</div>
		<div class="span4">
			<div class="maincontent" id="adswrapper"></div>
		</div>
	</div>
</div>
