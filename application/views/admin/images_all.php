<div id="container">
	<div class="row-fluid">
		<div class="span4">
			<h4>Ladda upp</h4>
			<div class="alert alert-block" id="imagesneedtobee">
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
					för att se bilderna här till höger.
				</p>
			</div>
			<script>$('#imagesneedtobee').hide(0);</script>
			<script src="/web/js/vendor/dropzone.js" type="text/javascript"></script>
			<form method="post" action="/admin/images/run" class="dropzone" enctype="multipart/form-data" id="imagesform">
				<div class="dz-message">
					<h1 class="center" style="font-size:500%;">
						<i class="icon-upload"></i>
					</h1>
					<p class="lead">
						Drag och släpp bilder, eller klicka, här för att ladda upp dem.
					</p>
				</div>
			</form>
		</div>
		<div class="span8">
			<h4>Alla bilder</h4>
			<p>
				Här ser du samtliga bilder som laddats upp, samt vem som laddat upp dem.
			</p>
			<form action="/admin/images/batchedit" method="post">
				<div class="span6">
					Med markerade:
					<input type="submit" name="batch-show" class="btn btn-mini btn-primary" value="Visa" />
					<input type="submit" name="batch-hide" class="btn btn-mini btn-warning" value="Dölj" />
					<input type="submit" name="batch-delete" class="btn btn-mini btn-danger" value="Ta bort" />
				</div>
				<table class="table table-striped table-hover">
					<thead>
						<tr>
							<th><input type="checkbox" class="batch-controll" /></th>
							<th class="span3">Bild</th>
							<th class="span9">Info</th>
						</tr>
					</thead>
					<tbody>
						<?php
						foreach ($images as $image) {
							?>
							<tr>
								<td>
									<input type="checkbox" name="batch_list[]" class="input-batch"
										value="<?php echo $image['imageid']; ?>" />
								</td>
								<td>
									<a href="/web/uploads/<?php echo $image['filename']; ?>" target="_blank"
										class="fancybox" title="Se bild!">
										<img src="/web/script/timthumb.php?w=200&src=<?php echo urlencode('/web/uploads/'.$image['filename']); ?>"
											 alt="<?php echo $image['imageid']; ?>" />
									 </a>
								</td>
								<td>
									<span class="label<?php echo $image['status'] ? ' label-success' : '';?>">
										<i class="icon-eye-<?php echo $image['status'] ? 'open' : 'close';?>"></i> <?php echo $image['status'] ? 'Synlig' : 'Dold';?>
									</span>
									Uppladdad av <?php echo $image['editor']; ?> <?php echo $image['date']; ?>,
									alltså <?php echo readabletime($image['date']); ?>.
								</td>
							</tr>
							<?php
						}
						?>
					</tbody>
				</table>
			</form>
		</div>
	</div>
</div>
