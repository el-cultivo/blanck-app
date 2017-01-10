import _ from 'ramda';
import {alertsController} from '../../alerts-controller.js';
import {uppercaseFirst, toArray} from '../../functions/pure'

export const crudAjax = {
	methods: {
		post(elem) {
			let url = _.path(['target', 'action'], elem) || elem.action,
				form = document.getElementById(elem.target.id) || elem,
				formData = new FormData(form),
				target = elem.target.action !== undefined ? elem.target : elem,
				body = {},
				actionType = uppercaseFirst(_.head(_.split('-', (_.head(_.split('_', target.id))))));
			this._disableInputs(form);

			this.$http.post(url, formData).then((response) => {
				try {//try for valid JSON
					body = response.body;
				} catch(e) {
					this.generalError();
				}
			
			//Algun error
				if (body.success !== true) { 
					console.warn('no se ha encontrado la propiedad success en el body de un ajax exitoso');
					this.generalError();
					return ;
				}
			
			//Respuesta
				if (_.path([`on${actionType}Success`], this)) {
					_.path([`on${actionType}Success`], this)(body, elem);
				} else {
					console.warn(`el método on${actionType}Success no existe`);
				}
			//Cookies	
				if(_.path(['dealWithCookieOnAjaxResponse'], this) && body.cookie) {
					this.dealWithCookieOnAjaxResponse(body.cookie)
				}

				this.alert(body);
				this._enableInputs(form);

			}, (response) => {
				try {//try for valid JSON
					body = response.body;
					if (response.status === 500 || response.status === 404) {
						this.generalError();
					} else {
						this.alertError( body );
						if (_.path([`on${actionType}Error`], this)) { _.path([`on${actionType}Error`], this)(body, elem);}
					}
				} catch(e) {
					this.generalError();
				}
				this._enableInputs(form);
				if(_.path(['dealWithCookieOnAjaxResponse'], this)) {this.dealWithCookieOnAjaxResponse(body.cookie)}
			});
			setTimeout(()=>this._enableInputs(form), 3000);
		},

		_disableInputs(form) {
			var inputs =  _.concat(	toArray(form.getElementsByTagName('input')) ,
									toArray(form.getElementsByTagName('button')));
			var pseudo_submit_button = form.querySelectorAll('.pseudo-submit_JS');
			_.forEach(input => input.disabled = true, inputs);
			if (_.path([0], pseudo_submit_button)) { pseudo_submit_button[0].setAttribute('disabled', true);}//for when we are unable to use a real button, dues to its ability to submit, it leverages the stylings for the disabled attribute as done in the helpers of Mazorca
		},

		_enableInputs(form) {
			var inputs =  _.concat(	toArray(form.getElementsByTagName('input')) ,
									toArray(form.getElementsByTagName('button')));
			var pseudo_submit_button = form.querySelectorAll('.pseudo-submit_JS');
			_.forEach(input => input.disabled = false, inputs);
			if (_.path([0], pseudo_submit_button)) { pseudo_submit_button[0].removeAttribute('disabled');}//for when we are unable to use a real button, dues to its ability to submit, it leverages the stylings for the disabled attribute as done in the helpers of Mazorca
		},

		get(url_or_clickEvent, cbs = {}){
			let url = _.path(['target', 'dataset', 'get'], url_or_clickEvent)/*click event*/ || typeof url_or_clickEvent === 'string' ? url_or_clickEvent : '',
				body = {};
			if (url === '' || url === undefined) {return;}
			 this.$http.get(url).then((response) => {
			 	if (response.body) {
					body = response.body;
					// console.log('body', body);
					_.path(['success'], cbs) !== undefined ? this[cbs.success](body, cbs.data) : this.onGetSuccess(body, cbs.data);
			 	} else {
			 		this.generalError();
				}

		      }, (response) => {
		         if (response.body) {
						body = response.body;
 						this.alertError( body );
 					} else {
 						this.generalError();
 					}
		      });

		},

		onCreateSuccess(body, input) {
				this.list.unshift(body.data);
				input.target.reset();
		},

		onUpdateSuccess(body, input) {
				//console.log('update was successfull');
		},

		onDeleteSuccess(body, input) {
			let index = input.target.dataset.index;
			this.list.splice(index, 1);
		},

		generalError() {
			var alert_content = {};
			alert_content.msg = ['Hubo un error procesando su petición'];
			alert_content.success = false;
			alertsController.showAlert(alert_content)
		},

		alert(body) {
			var alert_content = {};
			alert_content.msg = body.message;
			alert_content.success = body.success;
			alertsController.showAlert(alert_content);
		},

		processError(body) {
			var processed_body = {},
				error;

			processed_body.message = [];
			processed_body.success = false;

			for(error in body) {
				if (body.hasOwnProperty(error)) {
					processed_body.message.push(body[error]);
				}
			}
			return processed_body;
		},

		alertError(body) {
			return this.alert(this.processError(body));
		},

	}
};
