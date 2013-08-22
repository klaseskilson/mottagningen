<div id="container">
	<div class="row-fluid">
		<div class="span6">
			<div class="alert alert-block alert-success" id="imagesneedtobee">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<h4><i class="icon-ok-sign"></i> Klart!</h4>
				<p>
					Samtliga bilder skall nu vara uppladdade. Observera att bilderna måste
					godkännas innan de är blir synliga.
				</p>
				<p>
					<a href="#" onclick="document.location.reload(true); return false;">
						<i class="icon-refresh"></i> Uppdatera sidan
					</a>
					för att se bilderna här nedan.
				</p>
			</div>
			<script>$('#imagesneedtobee').hide(0);</script>
			<script src="/web/js/vendor/dropzone.js" type="text/javascript"></script>
			<form method="post" action="/admin/images/run" class="dropzone" enctype="multipart/form-data" id="imagesform">
				<div class="dz-message">
					<!-- <h1 class="center" style="font-size:500%;">
						<i class="icon-upload"></i>
					</h1> -->
					<p class="lead">
						Drag och släpp bilder, eller klicka, här för att ladda upp dem.
					</p>
				</div>
			</form>
		</div>
		<div class="span6">
			<h4>Alla <?php echo $countall; ?> bilder (<?php echo $countpublic; ?> är publicerade)</h4>
			<p>
				Här ser du samtliga <?php echo $countall; ?> bilder som laddats upp, samt vem som laddat upp dem.
				Bilderna visas <?php echo $limit; ?> i taget.
			</p>
		</div>
	</div><!-- .row-fluid -->
	<form action="/admin/images/batchedit" method="post" id="imagesbatchedit">
		<div class="row-fluid">
			<div class="span4">
				Med markerade:
				<input type="submit" name="batch-show" class="btn btn-mini btn-primary" value="Visa" />
				<input type="submit" name="batch-hide" class="btn btn-mini btn-warning" value="Dölj" />
				<input type="submit" name="batch-delete" class="btn btn-mini btn-danger" value="Ta bort" />
			</div>
			<div class="span4">
				<label><input type="checkbox" class="batch-controll" /> Markera alla</label>
			</div>
		</div><!-- .row-fluid -->
		<ul class="thumbnails">
			<div class="row-fluid">
			<?php
			$i = 0;
			foreach ($images as $image)
			{
				?>
				<li class="span2">
					<div class="thumbnail" id="image-<?php echo $image['imageid']; ?>">
						<a href="http://legionen.nu/web/uploads/<?php echo $image['filename']; ?>" target="_blank"
							class="fancybox" title="<?php echo $image['editor']; ?> <?php echo $image['date']; ?>, alltså <?php echo readabletime($image['date']); ?>.">
							<img src="http://legionen.nu/web/script/timthumb.php?w=200&h=150&src=<?php echo urlencode('/web/uploads/'.$image['filename']); ?>"
								 alt="<?php echo $image['imageid']; ?>"
								 <?php echo !$image['status'] ? 'class="opacity-70"' : '';?> />
						</a>
						<h5>
							<input type="checkbox" name="batch_list[]" class="input-batch"
								value="<?php echo $image['imageid']; ?>" title="Välj bild" />
							<button onclick="imagecontrol('toggle','<?php echo $image['imageid'];?>'); return false;"
								class="toggle pull-right btn-small btn<?php echo $image['status'] ? ' btn-success' : '';?>"
								title="Ändra status">
								<i class="icon-eye-<?php echo $image['status'] ? 'open' : 'close';?>"></i>
								<span><?php echo $image['status'] ? 'Synlig' : 'Dold';?></span>
							</button>
						</h5>
						<span>
							<?php echo $image['editor']; ?>, <?php echo readabletime($image['date']); ?>.
						</span>
					</div>
				</li>
				<?php
				$i++;
				if($i % 6 == 0)
					echo '</div><div class="row-fluid">';
			}
			?>
			</div>
		</ul>
	</form>
	<div class="pagination pagination-centered">
		<ul>
			<li<?php if($page == 1) echo ' class="disabled"'; ?>>
				<a href="/admin/images/page/<?php echo $page == 1 ? 1 : $page-1; ?>">«</a>
			</li>
			<?php
			for($i = 1; $i <= $totalpages; $i++)
			{
				echo '<li'.($page == $i ? ' class="active"': '').'><a href="/admin/images/page/'.$i.'">'.$i.'</a></li>';
			}
			?>
			<li<?php if($page == $totalpages) echo ' class="disabled"'; ?>>
				<a href="/admin/images/page/<?php echo $page == $totalpages ? $totalpages : $page+1; ?>">»</a>
			</li>
		</ul>
	</div>
</div>
