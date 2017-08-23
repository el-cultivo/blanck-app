import R from 'ramda';

var Vue = require('vue');
var VueResource = Vue.use(require('vue-resource'));

export var cltvoVEditor = Vue.component('cltvo-v-editor',{
	template: '#cltvo-v-editor-template',

	props: [
		'value',
		'form',
		'name',
		'label'
	]

});
