
<div id="container">
	<div class="row-fluid">
		<div class="span4">
			<h4>Faddrar</h4>
			<p>Nedan visas samtliga faddrar.</p>
		</div>
		<div class="span4 offset4">
			<h4>Sök faddrar</h4>
			<form class="form-search" method="post" action="/admin/fadder/sok">
				<input type="text" name="search" placeholder="LiU-id, namn, post, mm" class="input-medium search-query">
				<button type="submit" class="btn btn-primary">Sök!</button>
			</form>
		</div>
	</div>
	<?php
	var_dump($faddrar);
?>
</div>
