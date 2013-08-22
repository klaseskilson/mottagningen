$(document).ready(function() {
	$('[data-toggle="tooltip"]').tooltip();
	$('[data-toggle="popover"]').popover({
		'html': true});

	$('input.batch-controll').change(function(){
		$('.input-batch').prop('checked', this.checked);
		$(".thumbnail").toggleClass('checked', this.checked);
	});
	$('.input-batch').change(function(){
		$(this).closest(".thumbnail").toggleClass('checked', this.checked);
	});

	$("a[href$='.jpg'],a[href$='.jpeg'],a[href$='.png'],a[href$='.gif'],a[href$='.JPG']").attr('rel', 'gallery').fancybox({
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

	$("a.hej").click(function(event){
		event.preventDefault();

		$.post("/admin/images/toggle/", { "this": $(this).attr('id') },
			function(data){
				console.log(data.name);
				console.log(data.time);
			},
			"json"
		);
	});

});

function imagecontrol(action, id)
{
	$.post("/admin/images/edit/",
		{
			'id': id,
			'action': action
		},
		function(data){
			console.log(data.action);
			console.log(data.id);
			console.log(data.status);

			$('#image-'+data.id+' img').toggleClass('opacity-70');
			$('#image-'+data.id+' button.toggle').toggleClass('btn-success');
			$('#image-'+data.id+' button.toggle i').toggleClass('icon-eye-open').toggleClass('icon-eye-close');
			var span = $('#image-'+data.id+' button.toggle span').text();
			$('#image-'+data.id+' button.toggle span').text(span == 'Synlig' ? 'Dold' : 'Synlig');
		},
		"json"
	);
}
