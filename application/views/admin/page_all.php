<div id="container">
	<?php
	if(isset($_GET['msg']))
	{
	?>
	<div class="row-fluid">
		<div class="offset4 span4">
			<p class="alert <?php echo ($_GET['msg'] == 'dne' ||
										$_GET['msg'] == 'togglef' ||
										$_GET['msg'] == 'removef') ? 'alert-error':'';?>">
				<a class="close" data-dismiss="alert" href="#">&times;</a>
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
					case 'removes':
						echo '<strong>Sådär!</strong> Inlägget borttaget. Hoppas du inte gjorde bort dig nu.';
						break;
					case 'removef':
						echo '<strong>Ojoj!</strong> Nu gick något fel. Det gick inte att ta bort sidan! Kolla så att den
							  inte är publicerad eller något sådant.';
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
								<?php echo $page['status'] ? '<a href="/sida/visa/'.$page['slug'].'" target="_blank" class="label"
								data-toggle="tooltip" title="Sidan är publicerad och synlig publikt. Klicka för att se.">Publicerad</a>':''; ?><br />
								<small title="Senast redigerad" data-toggle="tooltip">
									<i class="icon-pencil"></i> <?php echo $page['time']; ?>.
								</small>
							</td>
							<td><?php echo substr(strip_tags($page['content']),0,400); ?>...</td>
							<td>
								<a href="/admin/page/edit/<?php echo $page['post_id']; ?>">
									<i style="margin-right:3px;" class="icon-edit"></i>Redigera
								</a><br />
								<a href="/admin/page/togglestatus/<?php echo $page['post_id']; ?>" data-toggle="tooltip" title="Ändra status på inlägget">
									<i style="margin-right:3px;" class="icon-eye-<?php echo !$page['status'] ? 'open' : 'close'; ?>"></i><?php echo !$page['status'] ? 'Publicera' : 'Dölj'; ?>
								</a><br />
								<?php
								if($this->login->has_privilege(2) && !$page['status'])
								{
								?>
								<a href="/admin/page/remove/<?php echo $page['post_id']; ?>" onclick="return false;"
									data-toggle="popover" title="<strong>Varning!</strong> Detta går inte att ångra."
									data-location="left"
									data-content="<a class='btn btn-small btn-danger' href='/admin/page/remove/<?php echo $page['post_id']; ?>'>
												  <i class='icon-trash icon-white'></i> Okej, fortsätt!</a>">
									<i style="margin-right:3px;" class="icon-trash"></i>Ta bort
								</a>
								<?php
								}
								?>
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
