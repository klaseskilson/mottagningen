<div id="container" class="tinysite">
	<h4>Logga in</h1>
	<form class="form-horizontal" action="/admin/login/do" method="post">
		<?php
		if($msg == 'ad')
			echo '<div class="alert alert-error"><strong>Åtkomst nekad.</strong> Du måste logga in innan du kan fortsätta.</div>';
		elseif($msg == 'logout')
			echo '<div class="alert alert-success"><strong>Utloggad!</strong> Du är nu utloggad. Fint, välkommen åter!</div>';
		elseif($msg == 'do')
			echo '<div class="alert alert-error"><strong>Kontrollera uppgifterna!</strong>
				Vi kunde inte logga in dig med de angivna uppgifterna. Försök igen.</div>';
		?>
		<div class="control-group">
			<label class="control-label" for="liuid">LiU-id</label>
			<div class="controls">
				<input type="text" id="liuid" placeholder="LiU-id" name="liuid" />
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="password">Lösenord</label>
			<div class="controls">
				<input type="password" name="password" id="password" placeholder="Lösenord" />
			</div>
		</div>
		<div class="control-group">
			<div class="controls">
				<button type="submit" class="btn btn-primary">Logga in</button>
			</div>
		</div>
	</form>
</div>
