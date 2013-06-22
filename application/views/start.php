<?php
// new fancy layout
?>

<div class="wrapper container-fluid">
	<div class="row-fluid">
		<div class="span4">
			<div class="maincontent">
				<h3>Välkommen, nollan!</h3>
				<p>
					Här på Legionens sida finns mycket klokt att läsa. Se till att göra det,
					Nollan. Så att du är väl förberedd på alla fantastiska äventyr du kommer vara
					med om under Nolle-p, Nollan.
				</p>
			</div>
		</div>
		<div class="span4">
			<div class="maincontent">
				<h5>Finfina bilder</h5>
			</div>
		</div>
		<div class="span4">
			<div class="maincontent">
				<h5>Någon tredje grej, Twitter kanske?</h5>
			</div>
		</div>
	</div>
	<div class="row-fluid">
		<div class="span8">
			<h4>Legionen hälsar</h4>
			<?php
			foreach ($posts as $post) {
				?>
			<div class="maincontent">
				<h3>
					<a href="/sida/inlagg/<?php echo $post['slug']; ?>" title="Om nollan vill komma ihåg detta kan nollan klicka här.">
						<?php echo $post['title']; ?>
					</a>
				</h3>
				<h5 class="uppercase"><?php echo readabletime($post['time']); ?></h5>
				<?php echo $post['content']; ?>
			</div>
				<?php
			}
			?>
		</div>
		<div class="span4">
			<h4>Annanonser</h4>
			<div class="maincontent" id="adswrapper"></div>
		</div>
	</div>
</div>
