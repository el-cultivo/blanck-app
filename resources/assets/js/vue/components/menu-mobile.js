import R from 'ramda';
import Vue from 'vue';
import {menusMixin} from '../mixins/menus';
import {uppercaseFirst} from '../../functions/pure'

export const menuMobile = Vue.extend({
	template: '#menu-mobile-template',
	data() {
		return {
			selected_shop_submenu: '',
			selected_category_id: -1,
			selected_type_id: -1
		}
	},
	mixins:[menusMixin],
	props: [
	'menu',
	'isOpen',

	'currentEvent',
	'openingTransition',

	'typesById', 
	'subtypesById', 
	'subtypeIdsByTypeIds',
	'selectedSubtypes',
	'typeIdsBySubtypeIds',

	'categoriesById', 
	'subcategoriesById', 
	'subcategoryIdsByCategoryIds',
	'selectedSubcategories',
	'categoryIdsBySubcategoryIds',
	
	'priceRange'
	],

	filters: {
		printSelected(arr_of_selected) {
			let s = '';
			R.forEach(item => {
				if (item.parent.length > 0 && item.child.length > 0) {
					s += `${item.parent}: ${item.child}, `
				}
			}, arr_of_selected || []);

			return R.dropLast(2, s);//quita la última coma y el espacio
		},

		printPriceRange({from, to}) {
			if (from && to) {
				return `Desde $${from}.00, hasta $${to}.00`
			}
			return ''
		}

	},

	computed: {
		selected_subcategories_with_category() {
			return R.map(id => {
		 		let category_id = R.pathOr(-1, ['categoryIdsBySubcategoryIds', id] ,this);
		 		let parent = R.pathOr('', ['categoriesById', category_id, 'label'],this);
		 		let child = R.pathOr('', ['subcategoriesById', id, 'label'],this);
				return { parent: parent, child: child};
			}, this.selectedSubcategories || []);
	 	}, 
	 	
	 	selected_subtypes_with_type() {
			return R.map(id => {
		 		let type_id = R.pathOr(-1, ['typeIdsBySubtypeIds', id] ,this);
		 		let parent = R.pathOr('', ['typesById', type_id, 'label'],this);
		 		let child = R.pathOr('', ['subtypesById', id, 'label'],this);
				return { parent: parent, child: child};
			}, this.selectedSubtypes || []);
	 	}, 
		
		sub_something_name() {
			if (this.selected_category_id > -1) {
				return R.pathOr({}, ['categoriesById',this.selected_category_id], this).label;
			} else if (this.selected_type_id > -1) {
				return R.pathOr({}, ['typesById',this.selected_type_id], this).label;
			} else {
				return '';
			}
		}
	},

	methods: {
		toggleSelectionOnAllParentCheckboxes(kind, kind_plural, kind_id) {
			let uc_kind = uppercaseFirst(kind),
				sub_ids = R.pathOr([], [`sub${kind}IdsBy${uc_kind}Ids`, kind_id], this),
				selected = this[`selectedSub${kind_plural}`] || [],
				all_are_selected = R.intersection(sub_ids, selected).length === sub_ids.length;
			
			if (all_are_selected) {
				this[`selectedSub${kind_plural}`] = R.without(sub_ids, selected)
			} else {
				this[`selectedSub${kind_plural}`] = R.uniq(R.concat(sub_ids, selected))
			}
		},

		unselectAll() {
			this.selectedSubcategories = [];
			this.selectedSubtypes = this.currentEvent === null ? [] : this.selectedSubtypes;
		},

		unselectAllSubs(kind, kind_plural, kind_id) {
			let uc_kind = uppercaseFirst(kind),
				selected = this[`selectedSub${kind_plural}`],
				sub_ids = this[`sub${kind}IdsBy${uc_kind}Ids`][kind_id];

			this[`selectedSub${kind_plural}`] = R.without(sub_ids, selected)
		},

		resetPriceRanges() {
			this.priceRange = {from:"", to:""};
		}
	}
});
