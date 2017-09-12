import R from 'ramda';
import Vue from 'vue';
import VueResource from 'vue-resource';
import Sortable from 'vue-sortable';
import {crudAjax} from './mixins/crud-ajax';
import {menusStore, menusMixin} from './mixins/menus';
import {JsonParseOrFalse} from '../functions/pure';
import {ifElementExistsThenLaunch} from '../functions/dom';
import {logoSwitch} from '../logoManipulations';
import {menuTreeToggler} from '../menu-tree-toggler';


if (window.VueHtml5Editor) {
	Vue.use(VueHtml5Editor, {
		name: 'v-editor',
		visibleModules: [
	        "text",
	        // "font",
	        "list",
	        "link",
	        "unlink",
	        "hr",
	        "eraser",
	        "undo",
	    ]
	});
}

Vue.use(Sortable);
Vue.use(VueResource);

export const mainVue = function(config ={}, components = {}) {
	let store = mainVueStore,
		data = config.data || {},
		mixins = R.concat([crudAjax, menusMixin], (config.mixins || []));

	data.store = R.mergeAll([store, (data.store || {}), menusStore]);

	Vue.transition('slide', {
	  enterClass: 'slideInLeft',
	  leaveClass: 'slideOutLeft'
	});

	Vue.transition('fade', {
	  enterClass: 'fadeIn',
	  leaveClass: 'fadeOut'
	});

	return new Vue({
		el: config.el || 'body',

		init() { if(typeof config.init === 'function') return config.init.call(this);},

		created() {
			let stored_objs = R.keys(this.store);
			R.forEach(obj =>{
				let url = R.path(['store', obj, 'routes', 'get'],this);
				if (url) {
					this.get(url, {data: {callee: obj}});
				}
			}, stored_objs);

			this.store.languages = JsonParseOrFalse(this.store.languages);

			if(typeof config.created === 'function') return config.created.call(this);
		},

		ready() {
			ifElementExistsThenLaunch([
				['#header__logo', logoSwitch, 'init', []],
			]);
			if(typeof config.ready === 'function') return config.ready.call(this);
		},

		data: data,

		computed: R.merge({
		},config.computed || {}),

		methods: R.merge({
			onGetSuccess(body, data) {
				this.store[data.callee].data = body;
			}
		},config.methods || {}),


		mixins: mixins,

		events: R.merge({
		}, config.events || {}),

		watch: config.watch || {},

		components: components
	});
};
