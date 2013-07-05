<div id="container">
	<div class="row-fluid">
		<div class="span3">
			<h4>Alla användare!</h4>
			<p>
				Privilegier fungerar såhär:<br />
				1 - superadmin (kan göra allt)<br />
				2 - admin (kan göra det mesta (hantera användare osv), passande för general och kassör)<br />
				3 - kraftanvändare (kan publicera inlägg)<br />
				4 - fotograf, kan ladda upp bilder!<br />
			</p>
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
							<a href="/admin/user/edit/<?php echo $user['uid']; ?>" title="Redigera användare">
								<?php echo $user['liuid']; ?>
							</a>
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
