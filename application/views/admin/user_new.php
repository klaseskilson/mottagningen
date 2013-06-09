<div id="container">
	<div class="row-fluid">
		<div class="span4">
			<h4>Skapa användare</h4>
			<p>Här kan du skapa en ny användare till systemet.</p>
			<?php
			if(isset($message))
			{
				echo ($message ? '<div class="alert">Användare skapad!</div>' : '<div class="alert alert-error">Gick inte att skapa användaren!</div>');
			}
			?>
		</div>
		<div class="span4">
			<form class="form-horizontal" action="/admin/user/new_run" method="post">
				<h4>&nbsp;</h4>
				<div class="control-group">
					<label class="control-label" for="liuid">LiU-id</label>
					<div class="controls">
						<input type="text" id="liuid" name="liuid" placeholder="LiU-id" />
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="fname">Förnamn</label>
					<div class="controls">
						<input type="text" id="fname" name="fname" placeholder="Förnamn" />
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="sname">Efternamn</label>
					<div class="controls">
						<input type="text" id="sname" name="sname" placeholder="Efternamn" />
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="passw">Lösenord</label>
					<div class="controls">
						<input type="text" id="passw" name="passw" placeholder="Lösenord" />
					</div>
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
				3 - kraftanvändare (kan publicera inlägg)<br />
				4 - kan logga in, men inte göra något<br />
			</p>
		</div>
	</div>
</div>
