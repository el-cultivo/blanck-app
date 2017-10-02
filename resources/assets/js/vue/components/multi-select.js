import R from 'ramda';
import {simpleCrud} from '../factories/simple-crud-component-makers.js';
import {openMultiSelect, openModal} from './helpers/simple-crud-helpers';

let toNumberMap = R.map(n => Number(n));

export const multiSelect = R.curry((template) => {

	let multiSelectConfig = {
		props:['itemsIds'],
		data: {checkedItems: []},
		methods:  {
			openMultiSelect,
			openModal,

			is_checked(id) {
				return R.contains(Number(id), toNumberMap(this.checkedItems)) ? true : false;
			},

			onUpdateSuccess(body, input) {
				this.checkedItems = R.map(n => n, body.data);
			}

		},
		ready() {

			this.checkedItems = R.map(n => n, this.itemsIds);
		},
		computed: {
			labels() {
				let check = R.filter(item => R.contains(item.id, this.checkedItems),this.list || []);
				return R.map(item => item.label, check)
			},

		}
	};
	return simpleCrud(template,multiSelectConfig);
});
