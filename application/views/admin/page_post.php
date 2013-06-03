<div id="container">
	<form action="/admin/page/run/<?php echo $post_id; ?>" method="post">
		<div class="row-fluid">
			<div class="span7 offset2">
				<legend>
					<?php
						echo (!isset($post) ? 'Skapa ny sida' : 'Redigera sida');
					?>
				</legend>
				<?php
				if(isset($message))
				{
					echo ($message ? '<div class="alert">Sida redigerad!</div>' : '<div class="alert alert-error">Gick inte redigera sidan!</div>');
				}
				?>
				<input type="text" id="post_title" name="post_title" placeholder="Rubrik"
					class="span12" value="<?php echo (isset($post) ? $post['title'] : ''); ?>" />
			</div>
		</div>
		<div class="row-fluid">
			<div class="span2">
				LOL
			</div>
			<div class="span7">
				<textarea class="span12" placeholder="Skriv nyheten här..." rows="12"
				id="post_content" name="post_content" class="wysiwyg"><?php echo (isset($post) ? $post['content']: ''); ?></textarea>
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
				<h4>Spara</h4>
				<button type="submit" class="btn btn-primary">Spara sidan</button>
			</div>
		</div>
	</form>
</div>
