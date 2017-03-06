import R from 'ramda';
import Vue from 'vue';
import {simpleCrud, simpleCrudWithImage, simpleModalCrud} from '../factories/simple-crud-component-makers.js';
import {gMap} from '../components/g-map';
import {numberFilters} from '../mixins/number-filters';
import {sortable} from '../mixins/sortable';
import {multilistSortable} from '../mixins/multilist-sortable';
import {sortableListByClick} from '../mixins/sortable-list-by-click';
import {mexicoStatesAndMunicipalities} from '../mixins/mexico-states-and-municipalities';
import {sortByNestedProp, toArray, objTextFilter, tapLog, nonCyclingMoveInArray} from '../../functions/pure';
import {preSelectOption} from '../../functions/dom';
import {makePost, openModal, openModalFromSimpleImageCrud, postWithMaterialNote} from './helpers/simple-crud-helpers';


const toNumberMap = R.map(n => Number(n))

const checkboxesMethods = function(options) {
	return {
		props:['currentPage'],

		data: {
			selected_checkboxes: [],
			search: ''
		},

		ready() {
			this.selected_checkboxes = R.map(n => n+'', this.currentPage.sections_ids);
		},

		methods: R.merge({
			openModal,

			makePost,

	   		updateSelectedCheckboxes() {
				this.selected_checkboxes = R.map(elem => elem.id+'', this.selectedElems || []);
	   		},

			is_checked(id) {
				return R.contains(Number(id), toNumberMap(this.selected_checkboxes)) ? true : false;
			}
		}, options.methods || {})
	}
}

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

const form_id  = function() {return R.replace('{{item_on_edit.id}}', this.id, this.formId)}

//para pagesectionsSort
const addedCheckboxElem = function(section) { this.sortable_list = R.append(section, this.sortable_list);}

//para pagesectionsSort
const removedCheckboxId = function(section_id) {
	let index = R.findIndex(R.propEq('id', section_id), this.sortable_list);
	this.sortable_list = R.remove(index, 1, this.sortable_list);
}

const pageSectionsCheckboxUpdateSuccess = function(body) {
		let is_associated = R.pathOr(false, ['data','is_associated'], body);
		let id = R.pathOr(false, ['data','section_id'], body);
		if (is_associated === true) {
			let selected = R.filter(elem => elem.id === id, this.list)[0];
			this.$dispatch('onAssociatedCheckbox', selected)
		} else {
			this.$dispatch('onDissociatedCheckbox', id)
		}
}

const sortableListOnDeleteSuccess = function(body, input) {
	let index = input.target.dataset.index;
	this.sortable_list.splice(index, 1);
}

const sortableListOnCreateSuccess = function(body, input) {
	this.sortable_list.push(body.data);
}
//pages
export const pagesGroup = simpleCrud('#pages-group-template',{props: ['label','index'], mixins:[sortableListByClick], methods: {onCreateSuccess: sortableListOnCreateSuccess, onDeleteSuccess: sortableListOnDeleteSuccess}});
export const pages = simpleCrud('#pages-template', { components:{pagesGroup}, mixins:[multilistSortable]});
export const pagesectionsModalCreate = simpleModalCrud('#pagesections-modal-create-template', {data: { item_on_create: {description: '' } }});
export const pagesectionsModalEdit = simpleModalCrud('#pagesections-modal-edit-template',{props:['edit-index']});
export const pagesections = simpleCrud('#pagesections-template', {methods: {openModal}, components:{pagesectionsModalCreate, pagesectionsModalEdit}});
export const pagesectionsCheckbox = simpleCrud('#pagesections-checkbox-template', checkboxesMethods({methods: {onUpdateSuccess: pageSectionsCheckboxUpdateSuccess}}));
export const pagesectionsSort = simpleCrud('#pagesections-sort-template',{props: ['currentPage'], mixins:[sortableListByClick], methods: {onCreateSuccess: sortableListOnCreateSuccess, onDeleteSuccess: sortableListOnDeleteSuccess}, events: {addedCheckboxElem, removedCheckboxId}});

//component
export const componentForm = simpleCrud('#component-form-template',{props: ['section','component', 'index', 'componentName']} );

//section
export const sectionProtected = simpleCrud('#section-protected-template',{props: ['section', 'index']} );
export const sectionMultipleUnlimited = simpleCrud('#section-multiple-unlimited-template',{props: ['section', 'index'],  data:{editing_title: false, title: []},  components:{componentForm}, mixins:[sortableListByClick], methods: {onCreateSuccess: sortableListOnCreateSuccess, onDeleteSuccess: sortableListOnDeleteSuccess}} );
export const sectionMultipleLimited = simpleCrud('#section-multiple-limited-template',{props: ['section', 'index'],components:{componentForm}, mixins:[sortableListByClick], methods: {onCreateSuccess: sortableListOnCreateSuccess, onDeleteSuccess: sortableListOnDeleteSuccess}} );
export const sectionMultipleFixed = simpleCrud('#section-multiple-fixed-template',{props: ['section', 'index'],components:{componentForm}, mixins:[sortableListByClick], methods: {onCreateSuccess: sortableListOnCreateSuccess, onDeleteSuccess: sortableListOnDeleteSuccess}} );
export const currentPageSections = simpleCrud('#current-page-sections-template',{props: ['currentPage'], mixins:[multilistSortable],components:{sectionProtected,sectionMultipleUnlimited, sectionMultipleLimited,sectionMultipleFixed} } );
