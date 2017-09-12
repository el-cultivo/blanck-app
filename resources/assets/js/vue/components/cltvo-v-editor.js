import R from 'ramda';
import Vue = 'vue';

export const cltvoVEditor = Vue.component('cltvo-v-editor',{
	template: '#cltvo-v-editor-template',

	props: [
		'value',
		'form',
		'name',
		'label'
	]

});
