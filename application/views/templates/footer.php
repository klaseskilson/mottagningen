<?php // footer ?>
	<footer id="footer" class="wrapper container-fluid">
		<section class="row-fluid">
			<div class="span8">
				<div class="maincontent">
					<p>
						Legionen har <a href="http://facebook.com/legionen.nu" target="_blank">Facebook</a>
						och <a href="http://twitter.com/legionen" target="_blank">Twitter</a>. Följ Legionen där!
					</p>
					<p>
						Allt som finns här får såklart användas hur du vill, förutsatt
						att du följer de licenser som finns på de pluginer och verktyg som
						du hittar. Det är det viktigaste som finns för en öppen, trygg och
						trevlig webb! Kika gärna runt bland koden om du tycker sånt är kul!
					</p>
				</div>
			</div>
			<div class="span4">
				<div class="maincontent">
					<p>
						<a href="http://www.yr.no/place/Sweden/%C3%96sterg%C3%B6tland/Norrk%C3%B6ping/" target="_blank">
							Weather forecast from yr.no, delivered by the Norwegian Meteorological Institute and the NRK
						</a>
					</p>
					<p>
						<a href="http://twitter.github.io/bootstrap/" target="_blank">
							Legionen &lt;3 Bootstrap
						</a>
					</p>
				</div>
			</div>
		</section>
	</footer>
	<div id="desert"></div>
</div><!-- #container -->

<!-- legionens animationer, hurra! http://bigassmessage.com/83502 -->
<script src="<?php echo base_url(); ?>web/js/animate.js"></script>
<script src="<?php echo base_url(); ?>script/ads/leg/script.js" type="text/javascript"></script>
<script>
	init();
	initads("adswrapper");
	<?php
	if($CI_ENVIRONMENT !== 'development')
	{
	?>
	// analytics!
	var _gaq = _gaq || [];
	_gaq.push(['_setAccount', 'UA-39071997-1']);
	_gaq.push(['_trackPageview']);

	(function() {
		var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	})();
	<?php
	}
	?>
</script>
<script type="text/javascript" src="<?php echo base_url(); ?>web/js/tweets.js"></script>
</body>
</html>
<!-- Legionen kastade ihop sidan på {elapsed_time} sekunder. BARA FÖR DIG! Man skulle kanske kunna säga att legionen är snäll. -->
