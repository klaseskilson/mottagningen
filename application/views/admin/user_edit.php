<div id="container">

	<?php
	if(isset($_GET['msg']))
	{
		echo ($_GET['msg'] == 's'? '<div class="alert">Användare redigerad!</div>' : '<div class="alert alert-error">Gick inte att redigera användaren!</div>');
	}
	?>
	<div class="row-fluid">
		<div class="span3">
			<h4>Redigera användare</h4>
			<p>Redigera användare till systemet.</p>
		</div>
		<div class="span5">
			<form class="form-horizontal" action="/admin/user/edit_run/<?php echo $user['uid']; ?>" method="post">
				<h4>&nbsp;</h4>
				<div class="control-group">
					<label class="control-label" for="liuid">LiU-id</label>
					<div class="controls">
						<input type="text" id="liuid" name="liuid" placeholder="LiU-id" value="<?php echo $user['liuid']; ?>" />
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="fname">Förnamn</label>
					<div class="controls">
						<input type="text" id="fname" name="fname" placeholder="Förnamn" value="<?php echo $user['fname']; ?>" />
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="sname">Efternamn</label>
					<div class="controls">
						<input type="text" id="sname" name="sname" placeholder="Efternamn" value="<?php echo $user['sname']; ?>" />
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="passw">Lösenord</label>
					<div class="controls">
						<input type="text" id="passw" name="passw" placeholder="Lösenord" />
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="privil">Privilegier</label>
					<div class="controls">
						<select id="privil" name="privil" class="input-medium">
							<?php
							for($i = 1; $i <= 4; $i++)
								echo '<option value="'.$i.'" '.
									 ($user['privil'] == $i ? ' selected="selected"': '').
									 '>'.$i.'</option>';
							?>
						</select>
					</div>
				</label>
				</div>
				<div class="control-group">
					<div class="controls">
						<button type="submit" class="btn btn-primary">Skapa!</button>
					</div>
				</div>
			</form>
		</div>
		<div class="span4">
			<h5>Privilegier</h5>
			<p>
				Privilegier fungerar såhär:<br />
				1 - superadmin (kan göra allt)<br />
				2 - admin (kan göra det mesta (hantera användare osv), passande för general och kassör)<br />
				3 - kraftanvändare (kan publicera inlägg och bilder)<br />
				4 - fotograf, kan ladda upp bilder<br />
			</p>
		</div>
	</div>
</div>
