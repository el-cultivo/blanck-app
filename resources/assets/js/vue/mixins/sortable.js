import R from 'ramda';
import Vue from 'vue';
import Sortable from 'vue-sortable';
import {removeAndInsert} from '../../functions/pure';

export const sortable = {
	props: ['list'],

	data: function() {
		return {
		}
	},

	computed: {
		sorted_ids() {
	     	return R.map(elem => elem.id, this.list || []);
		}
	},

	methods: {
		onUpdate(event) {
			return this.list = removeAndInsert(event, this.list);
	   }
	}
};

Vue.use(Sortable);