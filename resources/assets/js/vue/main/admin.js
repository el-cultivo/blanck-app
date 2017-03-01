import R from 'ramda';
import {mexicoStatesAndMunicipalities} from '../mixins/mexico-states-and-municipalities';

export var adminVue = {
	el: '#admin-vue',
	mixins:[mexicoStatesAndMunicipalities],
	methods: {
	},
	events: {
		onAssociatedCheckbox(elem) {
			console.log('elem', elem);
			this.$broadcast('addedCheckboxElem', elem);
		}, 
		onDissociatedCheckbox(id) {
			console.log('id', id);
			this.$broadcast('removedCheckboxId', id);
		}
	}
};
