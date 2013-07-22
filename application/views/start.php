
<?php
// new fancy layout
?>

<div class="wrapper container-fluid">
	<section class="row-fluid">
		<div class="span4">
			<div class="maincontent">
				<h3>Välkommen, Nollan!</h3>
				<p>
					Här på Legionens sida finns mycket klokt att läsa, både <a href="http://bit.ly/12f2Mng" title="Fyll i Nollan-enkäten! Så snart som möjligt, Nollan.">före</a> och under
					Nolle-p.
				</p>
				<p>
					Under Nolle-p kommer här också en massa fina bilder komma upp, de kan
					du titta på tillsammans med dina Nollan-vänner. Sånt är ju trevligt,
					Nollan.
				</p>
				<p>
					Har Nollan förresten
					<a href="https://facebook.com/legionen.nu" target="_blank" title="Följ Legionen på Facebook">Facebook</a>
					eller <a href="https://twitter.com/legionen" target="_blank" title="Följ Legionen på Twitter">Twitter</a>?
					 Det har Legionen med!
				</p>
			</div>
		</div>
		<div class="span4">
			<div class="maincontent startimg">
				<h5><a href="/sida/bilder" title="Se fler bilder!">Finfina bilder</a></h5>
				<?php
				foreach ($images as $image)
				{
					echo '<a href="/sida/bilder" title="Se fler bilder!">
					<img src="/web/script/timthumb.php?w=300&h=200&src='.urlencode('/web/uploads/'.$image['filename']).'"/>
					</a>';
				}
				?>
				<div class="clearfix"></div>
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
			<h4>Annonser</h4>
			<div class="maincontent" id="adswrapper"></div>
		</div>
	</section>
</div>
