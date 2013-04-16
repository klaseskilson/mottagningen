<div id="container">
	<div class="row-fluid">
		<div class="span3">
			<h4>Alla användare!</h4>
		</div>
		<div class="span9">
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th>
							LiU-ID
						</th>
						<th>
							Förnamn
						</th>
						<th>
							Efternamn
						</th>
						<th>
							Privilegier
						</th>
					</tr>
				</theah>
				<tbody>
					<?php
					foreach($users as $user)
					{
					?>
					<tr>
						<td>
							<?php echo $user['liuid']; ?>
						</td>
						<td>
							<?php echo $user['fname']; ?>
						</td>
						<td>
							<?php echo $user['sname']; ?>
						</td>
						<td>
							<?php echo $user['privil']; ?>
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
