$(document).ready(function() {
	$('[data-toggle="tooltip"]').tooltip();
	$('[data-toggle="popover"]').popover({
		'html': true});

	$('input.batch-controll').change(function(){
		$('.input-batch').prop('checked', this.checked);
	});
	$("a[href$='.jpg'],a[href$='.jpeg'],a[href$='.png'],a[href$='.gif']").attr('rel', 'gallery').fancybox({
		padding: 0,
		helpers	: {
			thumbs: {
				width	: 50,
				height	: 50
			}
		}
	});

	Dropzone.options.imagesform = {
		addRemoveLinks: true,
		init: function() {
			this.on("complete", function() {
				if (this.getQueuedFiles().length == 0 && this.getUploadingFiles().length == 0)
					$('#imagesneedtobee').show();
			});
		}
	};

});
