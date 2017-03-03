/**
 * MultiImages Vue Component 
 * version 2.0.0-BestBuddies
 */
import _ from 'ramda';
import {crudAjax} from '../mixins/crud-ajax';
var Vue = require('vue');
var VueResource = Vue.use(require('vue-resource'));
import {moveInArray, orderAscending, tapLog} from '../../functions/pure';
import {singleImage} from './single-image';
import Sortable from 'vue-sortable';
Vue.use(Sortable);

export var multiImages = Vue.component('multi-images', {
	template: '#multi-images-template',

	data: function() {
		return {
			children_with_image_order:[],
			ref: this.$options._ref,
			images: [],
			ordered_ids: [],
			type: 'multi-image'
		};
	},

	props: [
		'allPhotos', 
		'photoableType', 
		'photoableId', 
		'use', 
		'defaultOrder', 
		'class', 
		'title'
	],

	ready() {
		this.images = _.sortBy(_.prop('pivot_order'), _.filter(photo => photo.pivot_use === this.use, this.allPhotos));
	},

	mixins: [crudAjax],

	methods: {

		onUpdate($event) {
			let o = $event.oldIndex;
			let n = $event.newIndex;
			this.sort(n - o, o);
			this.$nextTick(() => this.getOrders());
		},

		sort(direction, $index, $event) {
			this.images = moveInArray(direction, $index, this.images);

			Vue.nextTick(()=>{
				this.$broadcast('updateRef, $index');
			});
		},

		getOrders($event) {
			let images = document.querySelectorAll('.singleImage--gallery_JS')
			this.ordered_ids  = _.filter(
				id => id !== '',
				 _.map(image => image.dataset.id, 
				 images)
			) 
		},

		postOrders($event) {
			this.getOrders();
			this.$nextTick(() => this.post($event))
		},

		onSortSuccess(body) {
			//sólo tiene que estar registrado
		},

		remove(index) {
			this.images.splice(index, 1);
		},

		addSingleImageComponent() {
			this.images.push({});
		},

		onSelectedMedia(data){
			this.images.unshift(_.merge({type:'single'}, data));
		},
	},

	events: {
		reupdateChildrenWithImageOrder(index, image) {
			this.images[index].currentImage = {
					thumbnail_url: image.src,
					id: image.id,
				}
			}
	},

	components: {
		'single-image': singleImage
	}
});
