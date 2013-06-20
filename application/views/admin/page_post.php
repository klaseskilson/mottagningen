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
				<?php
				if(isset($post))
				{
					?>
					<p>
						<a href="/sida/visa/<?php echo $post['slug']; ?>" target="_blank" title="Adressen till sidan. Klicka för att öppna i ett nytt fönster." data-toggle="tooltip">
							<i class="icon-globe" style="margin-right:3px;"></i><?php echo $_SERVER['SERVER_NAME'] ?>/sida/visa/<?php echo $post['slug']; ?>
						</a>
					</p>
					<?php
				}
				?>
			</div>
		</div>
		<div class="row-fluid">
			<div class="span2">
				<?php
				if(isset($post))
				{
					if($this->login->has_privilege(2) && !$post['status'])
					{
						?>
						<a href="/admin/page/remove/<?php echo $post['post_id']; ?>" onclick="return false;"
							data-toggle="popover" title="<strong>Varning!</strong> Detta går inte att ångra."
							data-content="<a class='btn btn-small btn-danger' href='/admin/page/remove/<?php echo $post['post_id']; ?>'>
										  <i class='icon-trash icon-white'></i> Okej, fortsätt!</a>"
							data-location="right">
							<i style="margin-right:3px;" class="icon-trash"></i>Ta bort
						</a>
						<?php
					} // privil & status
					?>
					<p>
						Inlägget redigerades senast <?php echo $post['time']; ?>, alltså
						<?php echo readabletime($post['time']); ?>.
					</p>
					<?php
				} // isset($post)
				?>
			</div>
			<div class="span7">
				<textarea class="span12" placeholder="Skriv nyheten här..." rows="17"
				id="post_content" name="post_content" class="wysiwyg"><?php echo (isset($post) ? $post['content']: ''); ?></textarea>
				<script type="text/javascript">
					$('#post_content').wysihtml5({
						"font-styles": true, //Font styling, e.g. h1, h2, etc. Default true
						"emphasis": true, //Italics, bold, etc. Default true
						"lists": true, //(Un)ordered lists, e.g. Bullets, Numbers. Default true
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
				<label>Status:
					<select id="post_status" name="post_status" class="input-medium" >
						<option value="0">Utkast/dold</option>
						<option value="1"<?php if(isset($post) && $post['status'] == 1) echo ' selected="selected"'; ?>>Färdig/publik</option>
					</select>
				</label>
				<button type="submit" class="btn btn-primary">Spara sidan</button>
			</div>
		</div>
	</form>
</div>
