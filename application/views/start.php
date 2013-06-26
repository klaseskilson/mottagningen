<?php
// new fancy layout
?>

<div class="wrapper container-fluid">
	<section class="row-fluid">
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
				<h5><a href="https://twitter.com/legionen" target="_blank" title="Följ Legionen på Twitter, Nollan!">Twitter</a>, nollan!</h5>
				<div id="tweets_list"><li>Ojoj, tänker ju.</li></div>
			</div>
		</div>
	</section>
	<section class="row-fluid">
		<div class="span8">
			<h4>Legionen hälsar</h4>
			<?php
			foreach ($posts as $post) {
				?>
			<article class="maincontent">
				<h3>
					<a href="/sida/inlagg/<?php echo $post['slug']; ?>" title="Om nollan vill komma ihåg detta kan nollan klicka här.">
						<?php echo $post['title']; ?>
					</a>
				</h3>
				<p class="nomargin">
					<time class="title uppercase" title="<?php echo $post['time']; ?>"><?php echo readabletime($post['time']); ?></time>
				</p>
				<?php echo $post['content']; ?>
			</article>
				<?php
			}
			?>
		</div>
		<div class="span4">
			<h4>Annanonser</h4>
			<div class="maincontent" id="adswrapper"></div>
		</div>
	</section>
</div>
