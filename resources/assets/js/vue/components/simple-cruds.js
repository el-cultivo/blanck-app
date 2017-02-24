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



const form_id  = function() {return R.replace('{{item_on_edit.id}}', this.id, this.formId)}

export const pagesGroup = simpleCrud('#pages-group-template',{props: ['label','index'], mixins:[sortable]});
export const pages = simpleCrud('#pages-template', { components:{
	pagesGroup
}, mixins:[multilistSortable]});
