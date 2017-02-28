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
import {makePost, openModal, openModalFromSimpleImageCrud, postWithMaterialNote} from './helpers/simple-crud-helpers';


const checkboxesMethods = {
	props:['currentPage'],

	data: {
		selected_checkboxes: [],
		search: ''
	},

	ready() {
		this.selected_checkboxes = this.currentPage.sections_ids;
	},

	methods: {
		openModal,

		makePost,

   		updateSelectedCheckboxes() {
			this.selected_checkboxes = R.map(elem => elem.id+'', this.selectedElems || []);
   		},

		is_checked(id) {
			return R.contains(id, this.selected_checkboxes) ? true : false;
		}
	}
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

const form_id  = function() {return R.replace('{{item_on_edit.id}}', this.id, this.formId)}

export const pagesGroup = simpleCrud('#pages-group-template',{props: ['label','index'], mixins:[sortable]});
export const pages = simpleCrud('#pages-template', { components:{pagesGroup}, mixins:[multilistSortable]});

export const pagesectionsModalCreate = simpleModalCrud('#pagesections-modal-create-template');
export const pagesectionsModalEdit = simpleModalCrud('#pagesections-modal-edit-template',{props:['edit-index']});
export const pagesections = simpleCrud('#pagesections-template', {methods: {openModal}, components:{pagesectionsModalCreate, pagesectionsModalEdit}});

export const pagesectionsCheckbox = simpleCrud('#pagesections-checkbox-template', checkboxesMethods);
export const pagesectionsSort = simpleCrud('#pagesections-sort-template',{props: ['currentPage'], mixins:[sortable]});

export const sectionProtected = simpleCrud('#section-protected-template',{props: ['section']} );
export const sectionMultipleUnlimited = simpleCrud('#section-multiple-unlimited-template',{props: ['section']} );
export const sectionMultipleLimited = simpleCrud('#section-multiple-limited-template',{props: ['section']} );
export const sectionMultipleFixed = simpleCrud('#section-multiple-fixed-template',{props: ['section']} );
export const componentForm = simpleCrud('#component-form-template',{props: ['section','component']} );

export const currentPageSections = simpleCrud('#current-page-sections-template',{props: ['currentPage'],  mixins:[multilistSortable],components:{sectionProtected,sectionMultipleUnlimited, sectionMultipleLimited,sectionMultipleFixed, componentForm} } );
