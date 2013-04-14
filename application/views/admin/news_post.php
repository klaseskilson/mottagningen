<div id="container">
	<form action="admin/post/perf" method="post">
		<div class="row-fluid">
			<div class="span7 offset2">
				<legend>
					<?php
						echo (!isset($info) ? 'Skapa nytt inlägg' : 'Redigera inlägg');
					?>
				</legend>
				<input type="text" id="post_title" name="post_title" placeholder="Rubrik" class="span12" />
			</div>
		</div>
		<div class="row-fluid">
			<div class="span2">
				LOL
			</div>
			<div class="span7">
				<textarea class="span12" placeholder="Skriv nyheten här..." rows="12" id="post_content" name="post_content" class="wysiwyg"></textarea>
				<script type="text/javascript">
					$('#post_content').wysihtml5({
						"font-styles": true, //Font styling, e.g. h1, h2, etc. Default true
						"emphasis": true, //Italics, bold, etc. Default true
						"lists": false, //(Un)ordered lists, e.g. Bullets, Numbers. Default true
						"html": true, //Button which allows you to edit the generated HTML. Default false
						"link": true, //Button to insert a link. Default true
						"image": false, //Button to insert an image. Default true,
						"color": false //Button to change color of font
						//,"locale": "sv-SE"
					});
				</script>
			</div>
			<div class="span3">
				LOL
			</div>
		</div>
	</form>
</div>
