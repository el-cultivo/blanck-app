import R from 'ramda';
import Vue from 'vue';
import Sortable from 'vue-sortable';
import {removeAndInsert, moveInArray} from '../../../functions/pure';

const sortable = {
	props: ['list'],

	computed: {
		sorted_ids() {
	     	return R.map(elem => elem.id, this.list);
		}
	},

	methods: {
		onUpdate(event) {
			return this.list = removeAndInsert(event, this.list);
	   }
	}
};

Vue.use(Sortable);
export const mySorting = Vue.extend({
	template: '#my-sorting-template',
	mixins: [sortable]
});