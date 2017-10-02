import R from 'ramda';
import Vue from 'vue';

export const cltvoVEditor = Vue.component('cltvo-v-editor',{
	template: '#cltvo-v-editor-template',

	props: [
		'value',
		'form',
		'name',
		'label'
	]

});
