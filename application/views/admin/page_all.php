<div id="container">
	<?php
	if(isset($_GET['msg']))
	{
	?>
	<div class="row-fluid">
		<div class="offset4 span4">
			<p class="alert <?php echo ($_GET['msg'] == 'dne' || $_GET['msg'] == 'togglef') ? 'alert-error':'';?>">
				<?php
				switch ($_GET['msg']) {
					case 'dne':
						echo '<strong>Ojoj.</strong> Nu gick något fel! Sidan finns inte!';
						break;
					case 'togglef':
						echo '<strong>Ojoj.</strong> Nu gick något fel! Det gick inte att ändra status!';
						break;
					case 'toggles':
						echo '<strong>Hurra!</strong> Status ändrad!';
						break;
					default:
						echo '<strong>Ojoj.</strong> Nu gick något fel! Försök igen!';
						break;
				}
				?>
			</p>
		</div>
	</div>
	<?php }  ?>
	<div class="row-fluid">
		<div class="span2">
			<h4>Alla sidor</h4>
			<p>
				Här nedan kan du se samtliga sidor som finns på sidan!
			</p>
		</div>
		<div class="span10">
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th class="span3">Rubrik</th>
						<th class="span7">Innehåll</th>
						<th class="span2">Hantera</th>
					</tr>
				</thead>
				<tbody>
					<?php
					foreach ($pages as $page) {
					?>
						<tr>
							<td>
								<strong><?php echo $page['title']; ?></strong>
								<?php echo $page['status'] ? '<span class="label">Publicerad</span>' : ''; ?><br />
								<small title="Senast redigerad">
									<i class="icon-pencil"></i> <?php echo $page['time']; ?>.
								</small>
							</td>
							<td><?php echo substr($page['content'],0,400); ?>...</td>
							<td>
								<a href="/admin/page/edit/<?php echo $page['post_id']; ?>">
									<i style="margin-right:3px;" class="icon-edit"></i>Redigera
								</a><br />
								<a href="/admin/page/togglestatus/<?php echo $page['post_id']; ?>" title="Ändra status på inlägget">
									<i style="margin-right:3px;" class="icon-eye-<?php echo !$page['status'] ? 'open' : 'close'; ?>"></i><?php echo !$page['status'] ? 'Publicera' : 'Dölj'; ?>
								</a><br />
								<a href="/admin/page/remove/<?php echo $page['post_id']; ?>">
									<i style="margin-right:3px;" class="icon-trash"></i>Ta bort
								</a>
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
