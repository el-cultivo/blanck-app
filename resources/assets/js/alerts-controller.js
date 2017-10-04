var _ = require('ramda');

export var alertsController = function() {
	let modal_config = {
			dismissible: true, // Modal can be dismissed by clicking outside of the modal
			opacity: 0, // Opacity of modal background
			in_duration: 100, // Transition in duration
			out_duration: 300, // Transition out duration
			starting_top: 0, // Starting top style attribute
			ending_top: 0, // Ending top style attribute
			ready: function(modal, trigger) { // Callback for Modal open. Modal and trigger parameters available.
			  $('body').css({overflow: ''})
			},
			complete: function() { } // Callback for Modal close
	};
	return {
		is_open: false,
		container: $('#alerts__container'),
		success_container: $('#alert__success'),
		danger_container:$('#alert__danger'),
		msg: [],
		success: '',
		close_btn: $('.alert__hide_JS'),
		init() {
			var self = this;
			//placeholder method for the helpers.ifExistsThenLaunch, do not delete
			////TO DO: arreglar esta necesidad en el "ifExistsThenLaunch"
			this.hideAlert();
			this.hideOnOutsideClick();
			this.is_open = this.loadedOpen();
		},

		loadedOpen() {//set the alert's open status, when it was opened by the backend
			if (this.success_container.css('display') === 'block' ||
				this.danger_container.css('display') === 'block')  {
				return true;
			}
			return false;
		},

		showAlert(obj) {
			var type;
			this.hideAlreadyOpenContainer();//el método entra en conflicto con las alertas de Materialize
			this.msg = obj.msg || [];
			this.success = obj.success;
			if(this.success === true) {
				type = 'success';
			} else if(this.success === false || this.success === '' || this.success === false) {
				type = 'danger';
			}
			this.alert(type);
			this.is_open = true;
		},

		hideAlreadyOpenContainer() {
			if (this.success_container.css('display') === 'block') {
				this.success_container.css('display','none');
			}
			if (this.danger_container.css('display') === 'block') {
				this.danger_container.css('display','none');
			}
		},

		hideAlert() {
			this.close_btn.on('click', function() {
				$(this).parent().css('display','none');
			});
		},

		hideOnOutsideClick() {
			this.container.on('click', function(e) {
				e.stopPropagation();
			});
			$(document).on('click',(e) => {
				if (this.is_open) {
					this.hideAlreadyOpenContainer();
					this.is_open = false;
				}
			});
		},

		alert(type) {
			var $li, $ul;
			this[`${type}_container`].css('display','block');
			$ul = $(this[`${type}_container`].find('ul')[0]);
			$ul.html('');
			this.msg.forEach(function(msg) {
				$li = $(`<li class="text__alert-${type} text__alert-${type}_JS">`);
				$li.text(msg).appendTo($ul);
			});
		}
	}
}(jQuery);
