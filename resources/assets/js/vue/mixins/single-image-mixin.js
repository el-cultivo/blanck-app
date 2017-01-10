
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
	}},

	props: ['currentImage', 'type', 'photoableType',  'photoableId', 'use', 'class', 'imagesOnLastLoad', 'index', 'parentRef', 'refPath', 'defaultOrder'],

	init() {
	},

	create() {
	},


	ready() {
		initPropsFromJSON.call(this, this.$options.props);
		this.setRef();
		this.image.src = _.pathOr('', ['thumbnail_url'], this.currentImage);
		this.image.id = _.pathOr('', ['id'], this.currentImage);
		this.order = _.pathOr((this.defaultOrder || 0), ['currentImage', 'order'], this);
	},

	mixins: [crudAjax],

	methods: {
		setRef() {
		if (this.refPath) {
			this.ref = this.refPath;
			return;
		}
		if (this.parentRef !== undefined) {
				this.ref = {
					parent: this.parentRef,
					list: this.$options._ref,
					index: this.index
				}
				this.printable_ref = this.ref.parent + '_' +this.ref.index
				return ;
			}
			this.ref = this.$options._ref
		},

		initAddMediaProcess(media_manager_ref, e) {
			if (this.image.src !== '') {return;}
			var mediaManager = this.$root.$refs.media_manager;
			mediaManager.active_calling_component.ref = this.ref;
			mediaManager.active_calling_component.photoable_id = this.photoableId;
			mediaManager.active_calling_component.photoable_type = this.photoableType;
			//TODO pasar estos datos (use, class, order) de otra manera,
			//ésta dudosamente funcionará, creo que se tienen que generar
			//dentro del mismo componente,
			//además creo que sólo son útiles en el multiImages
			//habrá que esperar para ver los casos de uso
			mediaManager.active_calling_component.use = this.use;
			mediaManager.active_calling_component.class = this.class;
			mediaManager.active_calling_component.order = this.order;
			if (mediaManager.active_calling_component.photoable_id !== undefined) { 
				mediaManager.open();
			} else {
				console.error('[singleImageMixin] To open the media manager you need to define the photoable-id')
			}
		},

		onSelectedMedia(media_data = {}){
			console.log('media_data', media_data, this.index);
			_.forEach(prop => this.image[prop] = media_data[prop], _.keysIn(media_data));
			this.$dispatch('reupdateChildrenWithImageOrder');
		},

		onDisassociateSuccess() {
			this.image.src = '';
			this.image.id = '';
			this.$dispatch('reupdateChildrenWithImageOrder');
		}
	},

	watch: {
		'image.id'() {
			this.$dispatch('reupdateChildrenWithImageOrder');
		},

		index() {
			console.log(this.index);
			this.setRef();
			console.log(this.index);
		}
	},

	events: {
		updateRef(){
			this.setRef();
		}
	}
}
