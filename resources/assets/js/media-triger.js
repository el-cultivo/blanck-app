export var mediaTriger = $(document).on('click','#media-trigger_JS',
	function() {$('#media-input_JS input').click();}).find('#media-input_JS input').on('click', function (e) {
		e.stopPropagation();
	});
