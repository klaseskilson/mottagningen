
<div class="wrapper container-fluid">
	<section class="row-fluid">
		<div class="span8">
			<div class="maincontent">
				<h3>Bilder</h3>
				<p>
					Klicka på bilderna för att se dem större.
				</p>
				<div id="images">
					<div class="row-fluid">
						<?php
						$i = 0;
						foreach ($images as $image) {
							$i++;
							?>
							<a href="/web/uploads/<?php echo $image['filename']; ?>">
								<img src="http://legionen.nu/web/script/timthumb.php?w=300&h=200&src=<?php echo urlencode('/web/uploads/'.$image['filename']); ?>"
									alt="<?php echo $image['date']; ?>" class="span4" />
							</a>
							<?php
							if(($i%3) == 0) echo '</div><div class="row-fluid">';
						}
						?>
					</div>
				</div>
				<div class="pagination pagination-centered">
					<ul>
						<li>
							<a href="#" id="loadmore">Ladda fler bilder</a>
						</li>
					</ul>
					<input type="hidden" id="page" value="<?php echo $page; ?>" />
				</div>
				<!-- Hehe, CSS-inladdning mitt i sidan, hehe. -->
				<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.4/jquery.fancybox.min.css" type="text/css" media="screen" />
				<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.4/helpers/jquery.fancybox-thumbs.min.css" type="text/css" />
				<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
				<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.4/jquery.fancybox.min.js"></script>
				<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.4/helpers/jquery.fancybox-thumbs.min.js"></script>
				<script>
				$(document).ready(function() {
					$("#images").click(function(){
						$("a[href$='.jpg'],a[href$='.jpeg'],a[href$='.JPG'],a[href$='.png'],a[href$='.gif']").attr('rel', 'gallery').fancybox({
							padding: 0,
							helpers	: {
								thumbs: {
									width	: 50,
									height	: 50
								}
							}
						});
					});

					$('a#loadmore').click(function(event){
						event.preventDefault();
						var page = $('#page').attr('value');
						page++;
						console.log('moar images: '+page);

						$.ajax({
							url: "/sida/bilder/"+page+"?ajax",
						}).done(function( html ) {
							$("#images").append(html);
						});

						$('#page').attr('value', page);
					});
				});
				</script>
			</div>
		</div>
		<div class="span4">
			<div class="maincontent" id="adswrapper"></div>
		</div>
	</section>
</div>
