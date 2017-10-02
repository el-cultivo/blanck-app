import R from 'ramda';
import Vue from 'vue';
import {crudAjax} from '../mixins/crud-ajax';
import {fileDnD} from '../../file-dnd.js';
import {ifElementExistsThenLaunch, objTextFilter, numericalObjSort, sortingOrder} from '../../functions/pure';

export var mediaManager = Vue.extend({
	template: '#media-manager-template',
	mixins: [crudAjax],

	data: () => {
		return {
			DnDEvents:{
				droppable_input: '',
				container: '',
				bin:''
			},
			display: 'none',
			thumbnail_container: undefined,
			file_input: '',
			file_input_form:'',
			input: '',
			chosen_img: {
				src:'',
				id:'',
				en: {},
				es: {},
				index:'',
				photoable_id:'',
				photoable_type:'',
				use:'',
				class:'',
				order:''
			},
			callee: {dummy() {}},
			callee_cb: 'dummy',
			active_calling_component: {
				photoable_type:undefined,
				photoable_id:undefined,
				use:undefined,
				class:undefined,
				order: undefined
			},
			search:'',
			sort_by: 'desc',
			sort_types: [
				{value: 'desc', name: {es: 'más recientes'}},
				{value: 'asc', name: {es: 'más antiguas'}}
			],
			photos: []
		}
	},

	computed: {
		filterableAndSortablePhotos() {
			return R.compose(numericalObjSort(['updated_at'], this.sort_by), objTextFilter(['title'], this.search))(this.photos);
		}
	},

	init() {
	},

	create() {
	},

	ready() {
		if (document.getElementById('modal__drop-container') !== undefined) { // exists('modal__drop-container', fileDnD); var exists = (elem, constructor) => document.getElemetById(elem) !== undefined ? constructor : {};
			this.DnDEvents = fileDnD({
				onDragOver: this.onDragOver,
				onGeneralDraggend: this.onGeneralDraggend
			});//TODO inicializar el objeto fileDND directamente en el data //
											//data =commit '' function() {
											//	var data = {
											//		//otras propiedades
											//	}
											//
											// 	return R.merge(filDnD(), data);
											//}
			this.DnDEvents.init();
		}
		this.file_input_form = document.getElementById('create_photo_form')
	},


	methods: {
		open() {
			this.display = 'block';
			this.getPhotos();
		},

		close() {
			this.display = 'none';
		},

		onDragOver() {
			this.DnDEvents.container.appendChild(this.DnDEvents.droppable_input);
		},

		onGeneralDraggend() {
			document.getElementById('file_input-label').appendChild(this.DnDEvents.droppable_input);
		},

		getPhotos() {
			this.get(this.$root.store.media_manager.routes.index, {success: 'onGetPhotosSuccess'});
		},

		onGetPhotosSuccess(body) {
			this.photos = R.path(['data', 'photos'], body);
		},

		makePost(elem) {
			var target = R.path(['target', 'form'], elem) || R.path(['target'], elem);
			this.post(target);
		},

		onCreateSuccess(body) {
			this.photos.unshift(body.data);
			this.DnDEvents.bin = "";
			this.file_input_form.reset();
		},

		onDeleteSuccess(body, input) {
			this.photos.splice(this.chosen_img.index, 1);
			this.chosen_img = { src:'', id:'', en: {}, es: {}, index:'', photoable_id:'', photoable_type:'', use:'', class:'', order:''};
		},

		onAssociateSuccess(body, elem) {
			this.callee[this.callee_cb](this.chosen_img);
			this.close();
			this.callee = {dummy() {}};
			this.callee_cb = 'dummy';
		},

		onChosenImage($event) {
			let img = this._weHaveAnImageUrl($event.target),
				url;
			if (!img) { return;}
			url = R.replace('__image.id__', img.id, this.$root.store.media_manager.routes.edit);
			this.chosen_img.index = $event.target.dataset.index;
			this.get(url, {success: 'onGetChosenImageDataSuccess'});
		},

		onGetChosenImageDataSuccess(body){
			this.chosen_img = body;
		},

		_weHaveAnImageUrl(e_target) {
			if (e_target.dataset.imageUrl !== undefined) {
				return {src: e_target.dataset.imageUrl, id: e_target.dataset.id};
			} else if(e_target.children[0].dataset.imageUrl !== undefined) {
				return {src: e_target.children[0].dataset.imageUrl, id: e_target.children[0].dataset.id};
			} else {
				return false;
			}
		}

	},

	watch: {
		'DnDEvents.bin': function() {
			if (!this.thumbnail_container) { this.thumbnail_container =  document.getElementById('media-manager__dropped-img-container');}
			this.thumbnail_container.src = this.DnDEvents.bin;
		},

		file_input() {
			this.DnDEvents.onChange(this.DnDEvents.droppable_input);
		},
	}
});
