import R from 'ramda';
import Vue from 'vue';
import {simpleCrud, simpleCrudWithImage, simpleModalCrud} from '../factories/simple-crud-component-makers.js';
import {gMap} from '../components/g-map';
import {numberFilters} from '../mixins/number-filters';
import {sortable} from '../mixins/sortable';
import {multilistSortable} from '../mixins/multilist-sortable';
import {mexicoStatesAndMunicipalities} from '../mixins/mexico-states-and-municipalities';
import {sortByNestedProp, toArray, objTextFilter, tapLog} from '../../functions/pure';
import {preSelectOption} from '../../functions/dom';


const checkboxesMethods = {
	props:['selectedElems', 'relatedProducts'],

	data: {
		selected_checkboxes: [],
		search: ''
	},

	computed: {
		filterable_elems() {
			return objTextFilter(['title'], this.search, this.list);
		}
	},
	methods: {
		makePost($event) {
   			this.post($event.target.form);
   		},

   		updateSelectedCheckboxes() {
			this.selected_checkboxes = R.map(elem => elem.id+'', this.selectedElems || []);
			this.relatedProducts = this.selected_checkboxes;
   		},

   		onUpdaterelatedproductsSuccess(body) {
   			this.relatedProducts = R.map(prod => prod.id, R.pathOr([], ['data', 'related_products'], body));
   		}
	},

	watch: {
		selectedElems() {
			this.updateSelectedCheckboxes();
		},

		list() {
			this.updateSelectedCheckboxes();
		}
	},

};

const relatedProductsFilter = {
	props: ['products', 'relatedProductsIds'],
	computed: {
		related_products() {
			let related_ids_to_string = R.map(id => id+'')(this.relatedProductsIds || []);
			let with_default_sku = R.filter(prod => prod.default_sku !== null);
			let related = R.filter(prod=> R.contains(prod.id+'', related_ids_to_string));
			return R.map(prod=>({
				title: prod.title,
				img_url: R.pathOr('', ['default_sku', 'thumbnail_image', 'url'], prod),
				alt: R.pathOr('', ['default_sku', 'thumbnail_image', 'alt'], prod),
			}), R.compose(related, with_default_sku)(this.products || []));
		}
	}
};

const openModal = function(name, $index) {
	if ($index === undefined) {return}
	this.edit_index = $index;
	$(name).modal('open');
}


const openModalFromSimpleImageCrud = function(name, $index) {
	if ($index === undefined) {return}
	this.$parent.$data.edit_index = $index;
	$(name).modal('open');
}



export const allytypesModalCreate = simpleModalCrud('#allytypes-modal-create-template');
export const allytypesModalEdit = simpleModalCrud('#allytypes-modal-edit-template',{props:['edit-index']});
export const allytypes = simpleCrud('#allytypes-template', {methods: {openModal}, components:{allytypesModalCreate, allytypesModalEdit}, mixins:[sortable]});
export const allytypesSelect = simpleCrud('#allytypes-select-template',{props:['current-ally'],methods: {openModal},components:{allytypesModalCreate}});

// export const alliesModalCreate = simpleModalCrud('#allies-modal-create-template');
// export const alliesModalEdit = simpleModalCrud('#allies-modal-edit-template',{props:['edit-index']});
export const allyList = simpleCrud('#ally-list-template',{props: ['label'], mixins:[sortable]});
export const allies = simpleCrud('#allies-template', {methods: {openModal}, components:{
	allyList
	// alliesModalCreate,
	// alliesModalEdit
}, mixins:[multilistSortable]});



const form_id  = function() {return R.replace('{{item_on_edit.id}}', this.id, this.formId)}
export const locationtypesModalCreate = simpleModalCrud('#locationtypes-modal-create-template');
export const locationtypesModalEdit = simpleModalCrud('#locationtypes-modal-edit-template',{props:['edit-index']});
export const locationtypesSelect = simpleCrud('#locationtypes-select-template',{props:['current-location', 'formId', 'id'], computed:{form_id},  methods: {openModal}, components:{locationtypesModalCreate}});
export const locationtypes = simpleCrud('#locationtypes-template', {methods: {openModal}, components:{locationtypesModalCreate, locationtypesModalEdit}});

export const locationsModalCreate = simpleModalCrud('#locations-modal-create-template', {data: {form_id: ''}, props: ['store'], mixins:[mexicoStatesAndMunicipalities], components: {locationtypesSelect, gMap}});
export const locationsModalEdit = simpleModalCrud('#locations-modal-edit-template',{data: {form_id: ''} , props:['edit-index', 'store'], mixins:[mexicoStatesAndMunicipalities], components: {locationtypesSelect, gMap}});
export const locations = simpleCrud('#locations-template', {props: ['store'], methods: {openModal}, components:{locationsModalCreate, locationsModalEdit, locationtypesSelect, locationtypesModalCreate}});

export const categoriesModalCreate = simpleModalCrud('#categories-modal-create-template');
export const categoriesModalEdit = simpleModalCrud('#categories-modal-edit-template',{props:['edit-index']});
export const categories = simpleCrud('#categories-template', {methods: {openModal}, components:{categoriesModalCreate, categoriesModalEdit}});

export const topicsModalCreate = simpleModalCrud('#topics-modal-create-template');
export const topicsModalEdit = simpleModalCrud('#topics-modal-edit-template',{props:['edit-index']});
export const topics = simpleCrud('#topics-template', {methods: {openModal}, components:{topicsModalCreate, topicsModalEdit}});

export const registrationtypesModalCreate = simpleModalCrud('#registrationtypes-modal-create-template');
export const registrationtypesModalEdit = simpleModalCrud('#registrationtypes-modal-edit-template',{props:['edit-index']});
export const registrationtypesRow = simpleCrudWithImage('#registrationtypes-row-template', {props:['registrationtype'], methods: {openModalFromSimpleImageCrud}});
export const registrationtypes = simpleCrud('#registrationtypes-template', {methods: {openModal}, components:{registrationtypesModalCreate, registrationtypesModalEdit, registrationtypesRow}});


export const speakersModalCreate = simpleModalCrud('#speakers-modal-create-template');
export const speakersModalEdit = simpleModalCrud('#speakers-modal-edit-template',{props:['edit-index']});
export const speakersRow = simpleCrudWithImage('#speakers-row-template', {props:['speaker'], methods: {openModalFromSimpleImageCrud}});
export const speakers = simpleCrud('#speakers-template', {methods: {openModal}, components:{speakersModalCreate, speakersModalEdit, speakersRow}});


export const locationsSelect = simpleCrud('#locations-select-template',{props:['current-film'], methods: {openModal},components:{locationsModalCreate}});

export const registrationtypesSelect = simpleCrud('#registrationtypes-select-template',{props:['current-film'],methods: {openModal},components:{registrationtypesModalCreate}});

export const topicsSelect = simpleCrud('#topics-select-template',{props:['current-film'],methods: {openModal},components:{topicsModalCreate}});

export const speakersSelect = simpleCrud('#speakers-select-template',{props:['current-film'],methods: {openModal},components:{speakersModalCreate}});

export const categoriesSelect = simpleCrud('#categories-select-template',{props:['current-film'],methods: {openModal},components:{categoriesModalCreate}});


// // export var userCards = simpleCrudComponentMaker('#user-cards-template');
// // export var sizes = simpleCrudComponentMaker('#size-inputs-template');
// // export var colors  = simpleCrudComponentMaker('#color-inputs-template');
// // export var categoriesModal = simpleCrudComponentMaker('#categories-modal-template', simpleModalCrud('categories', categoriesModalConfig));
// // export var colorsModal = simpleCrudComponentMaker('#colors-modal-template', simpleModalCrud('colors'));
// // export var sizesModal = simpleCrudComponentMaker('#sizes-modal-template', simpleModalCrud('sizes'));
