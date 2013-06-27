<div id="container">
	<div class="row-fluid">
		<div class="span3">
			<h4>Alla bilder</h4>
			<p>
				Här ser du samtliga bilder som laddats upp, samt vem som laddat upp dem.
			</p>
		</div>
		<div class="span9">
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
							<th class="span2">Bild</th>
							<th class="span8">Info</th>
							<th class="span2">Hantera</th>
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
										<img src="/web/uploads/<?php echo $image['filename']; ?>"
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
								<td>
									Hej
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
