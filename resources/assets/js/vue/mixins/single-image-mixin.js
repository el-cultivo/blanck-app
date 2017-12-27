import _ from 'ramda';
var Vue = require('vue');
// var VueResource = Vue.use(require('vue-resource'));
import {crudAjax} from './crud-ajax';
import {initPropsFromJSON} from '../helpers';
import {componentInteractionsWithMediaManager} from './component-interactions-with-media-manager.js';

export const singleImageMixin = {
	data: function(){return {
		printable_ref: this.$options._ref,
		ref: '',
		image: {
			src: '',
			id: ''
		},
		order:-1,
	    parent_ref: ''

	}},

	props: ['currentImage', 'type', 'photoableType',  'photoableId', 'use', 'class', 'imagesOnLastLoad', 'index', 'parentRef', 'refPath', 'defaultOrder'],

	init() {
	},

	create() {
	},


	ready() {
		initPropsFromJSON.call(this, this.$options.props);
		this.image.src = _.pathOr('', ['thumbnail_url'], this.currentImage);
		this.image.id = _.pathOr('', ['id'], this.currentImage);
		this.order = _.pathOr((this.defaultOrder || 0), ['currentImage', 'order'], this);
		this.printable_ref = Array.isArray(this.refPath) ? this.refPath.join('-') : this.printable_ref;
		this.parent_ref =
			this.parentRef !== undefined && typeof this.parentRef === 'string'	 ? this.parentRef 
			: Array.isArray(this.refPath)	 									 ? this.refPath[0] 
			:																		's_image';  
	},

	mixins: [crudAjax],

	methods: {
		initAddMediaProcess(media_manager_ref, e) {
			if (this.image.src !== '') {return;}
			var mediaManager = this.$root.$refs.media_manager;
			mediaManager.active_calling_component.photoable_id = this.photoableId;
			mediaManager.active_calling_component.photoable_type = this.photoableType;
			mediaManager.active_calling_component.use = this.use;
			mediaManager.active_calling_component.class = this.class;
			mediaManager.active_calling_component.order = this.order;
			mediaManager.callee = this;
			mediaManager.callee_cb = 'onSelectedMedia';
			if (mediaManager.active_calling_component.photoable_id !== undefined) { mediaManager.open();}
		},

		onSelectedMedia(image){
			this.image = image
			// this.$dispatch('reupdateChildrenWithImageOrder');
		},

		onDisassociateSuccess() {
			console.log('dissoc');
			this.image.src = '';
			this.image.id = '';
			// this.$dispatch('reupdateChildrenWithImageOrder');
		}
	},

	watch: {
		'image.id'() {
			// this.$dispatch('reupdateChildrenWithImageOrder');
		},

		// index() {
		// 	console.log(this.index);
		// 	this.setRef();
		// 	console.log(this.index);
		// }
	},

	events: {
		// updateRef(){
		// 	this.setRef();
		// }
	}
}
