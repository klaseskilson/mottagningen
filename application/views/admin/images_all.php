<div id="container">
	<div class="row-fluid">
		<div class="span3">
			<h4>Alla bilder</h4>
			<p>
				Här ser du samtliga bilder som laddats upp, samt vem som laddat upp dem.
			</p>
		</div>
		<div class="span9">
			<table class="table table-striped table-hover">
				<thead>
					<tr>
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
								<img src="/web/uploads/<?php echo $image['filename']; ?>"
									 alt="<?php echo $image['imageid']; ?>" />
							</td>
							<td>
								Uppladdad av <?php echo $image['editor']; ?> <?php echo $image['cachedate']; ?>,
								alltså ungefär <?php echo readabletime($image['cachedate']); ?>.
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
		</div>
	</div>
</div>
