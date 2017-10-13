export var alerts = jQuery(document).ready( function($) {
	$('#alert__container').css('top','0');
	$('#alert__container').click(function () {
		$('#alert__success').fadeOut();
		$('#alert__danger').fadeOut();
	});
});
