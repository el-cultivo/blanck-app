import _ from 'ramda';
import {crudAjax} from '../mixins/crud-ajax';
var Vue = require('vue');
var VueResource = Vue.use(require('vue-resource'));
import {moveInArray, orderAscending, tapLog} from '../../functions/pure';
import {singleImage} from './single-image';

export var multiImages = Vue.extend({
	template: '#multi-images-template',

	data: function() {
		return {
			children_with_image_order:[],
			ref: this.$options._ref,
			images: [],
			type: 'multi-image'
		};
	},

	props: ['photoableType', 'photoableId', 'use', 'order', 'class'],

	init() {
	},

	create() {
	},

	ready() {
		this.getImages();
		Vue.nextTick(()=>this.updateChildrenWithImageOrder());
		this.order = this.order || -1;
	},

	mixins: [crudAjax],

	methods: {
		getImages() {
			this.images = _.pathOr([], ['$root', '$data', 'store', 'photos', this.use], this);
		},

		updateChildrenWithImageOrder() {
			var children = _.pathOr([],['$refs', 'otherImagesList'], this),
				children_with_image = _.filter(child => child.image.id != "", children),
				ids_order = _.map(child => child.image.id)(children_with_image);
				this.children_with_image_order = ids_order || 0;
		},

		sort(direction, $index, $event) {
			this.images = moveInArray(direction, $index, this.images);

			Vue.nextTick(()=>{
				this.updateChildrenWithImageOrder();
				this.$broadcast('updateRef');
			});
		},

		onSortSuccess(body) {
			var children =  _.pathOr([],['$refs', 'otherImagesList'], this);
			var children_with_image = _.filter(child => _.path(['image', 'id'],child), children);
			var children_without_image = _.filter(child => _.not(_.path(['image', 'id'],child)), children);
			children_with_image.forEach((child, i) => {
				child.$data.order = body.data[i].order
			});
			
				console.log('FOR DEBUGGING PURPOSES, delete soon: singleImage-s without image, they should always be sorted', _.map(child => child.index, children_without_image));
			children_without_image.forEach((child, i) => {
				this.$emit('removeSingleImageComponent', child.index - i)
			});	
			
		},

		remove(index) {
			this.$emit('removeSingleImageComponent', index)
		},

		addSingleImageComponent() {
			var order_prop_values = _.map(image => _.pathOr(0, ['order'], image)),
				getLargestOrder = _.compose(_.last, orderAscending, order_prop_values);
			this.images.push({});
			Vue.nextTick(()=> _.last(this.$refs.otherImagesList).order = getLargestOrder(this.$refs.otherImagesList) + 1 );
		},

		onSelectedMedia(data){
			this.images.unshift(_.merge({type:'single'}, data));
		},



	},

	events: {
		reupdateChildrenWithImageOrder(index) {
			console.log('corre');
			this.updateChildrenWithImageOrder();
		},

		removeSingleImageComponent($index) {
			this.images.splice($index, 1);
		},

	},

	components: {
		'single-image': singleImage
	}
});
