<div id="container">
	<script src="/web/js/vendor/dropzone.js" type="text/javascript"></script>
	<div class="row-fluid">
		<div class="span4">
			<h4>Ladda upp bilder</h4>
			<p>
				Här laddar du upp bilder. Drag och släpp dem på fältet här brevid, eller
				klicka på fältet och markera filerna du vill ladda upp.
			</p>
		</div>
		<div class="span8">
			<div class="alert alert-block">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<h4>Obs!</h4>
				<p>
					Bilderna måste godkännas innan de är blir synliga, så att du vet!
				</p>
			</div>
			<form method="post" action="/admin/images/run" class="dropzone" enctype="multipart/form-data"></form>
		</div>
	</div>
</div>
