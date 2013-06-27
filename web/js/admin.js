$(document).ready(function() {
	$('[data-toggle="tooltip"]').tooltip();
	$('[data-toggle="popover"]').popover({
		'html': true});

	$('a.batch-all').click(function(){
		$('.input-batch').prop('checked', true);
	});
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

});
