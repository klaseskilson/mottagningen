<div id="container">
	<div class="span4">
		<h4>Välkommen!</h4>
		<p>Hej <?php $this->login->get_id(); ?>!</p>
	</div>
	<div class="span4">
		<h4>Sök faddrar</h4>
		<form class="form-search">
			<input type="text" name="search" placeholder="LiU-id, namn, post, mm" class="input-medium search-query">
			<button type="submit" class="btn btn-primary">Sök!</button>
		</form>
	</div>
</div>
