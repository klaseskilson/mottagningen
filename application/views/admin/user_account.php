<div id="container">
	<div class="row-fluid">
		<div class="span4">
			<h4>Ändra lösenord</h4>
			<p>Här kan du välja ett nytt lösenord till ditt konto.</p>
			<?php
			if(isset($message))
			{
				echo ($message ? '<div class="alert">Lösenord ändrat!</div>' : '<div class="alert alert-error">Lösenorden du angav stämmer inte överens! Försök igen.</div>');
			}
			?>
		</div>
		<div class="span4">
			<form class="form-horizontal" action="/admin/user/pwd" method="post">
				<h4>&nbsp;</h4>
				<div class="control-group">
					<label class="control-label" for="passw">Nytt lösenord</label>
					<div class="controls">
						<input type="password" id="passw" name="passw" placeholder="Lösenord" />
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="confirm">Bekfräfta lösenord</label>
					<div class="controls">
						<input type="password" id="confirm" name="confirm" placeholder="Bekräfta lösenord" />
					</div>
				</div>
				<div class="control-group">
					<div class="controls">
						<button type="submit" class="btn">BYT!</button>
					</div>
				</div>
			</form>

		</div>
	</div>
</div>
