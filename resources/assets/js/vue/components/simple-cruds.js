import R from 'ramda';
import Vue from 'vue';
import {simpleCrud, simpleCrudWithImage, simpleModalCrud} from '../factories/simple-crud-component-makers.js';
import {gMap} from '../components/g-map';
import {numberFilters} from '../mixins/number-filters';
import {sortable} from '../mixins/sortable';
import {multilistSortable} from '../mixins/multilist-sortable';
import {sortableListByClick, sortableOnClickCbs} from '../mixins/sortable-list-by-click';
import {listFilters, isPath, isPathInObjArray, isStringArray} from '../mixins/list-filters';
import {mexicoStatesAndMunicipalities} from '../mixins/mexico-states-and-municipalities';
import {sortByNestedProp, toArray, objTextFilter, tapLog, nonCyclingMoveInArray} from '../../functions/pure';
import {preSelectOption} from '../../functions/dom';
import {makePost, openModal, openModalFromSimpleImageCrud, postWithMaterialNote, checkboxesMethods} from './helpers/simple-crud-helpers';


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

//pages
export const pagesGroup = simpleCrud('#pages-group-template',{props: ['label','index'], mixins:[sortableListByClick], methods: sortableOnClickCbs});
export const pages = simpleCrud('#pages-template', { components:{pagesGroup}});
export const pagesectionsModalCreate = simpleModalCrud('#pagesections-modal-create-template', {data: { item_on_create: {description: '' } }});
export const pagesectionsModalEdit = simpleModalCrud('#pagesections-modal-edit-template',{props:['edit-index']});
export const pagesections = simpleCrud('#pagesections-template', {methods: {openModal}, components:{pagesectionsModalCreate, pagesectionsModalEdit}});
export const pagesectionsCheckbox = simpleCrud('#pagesections-checkbox-template', checkboxesMethods({methods: {onUpdateSuccess: pageSectionsCheckboxUpdateSuccess}}));
export const pagesectionsSort = simpleCrud('#pagesections-sort-template',{props: ['currentPage'], mixins:[sortableListByClick], methods: sortableOnClickCbs, events: {addedCheckboxElem, removedCheckboxId}});

//component
export const componentForm = simpleCrud('#component-form-template',{props: ['section','component', 'index', 'componentName']} );

// Tiene que ir después de componentForm
const sectionConfig = {
	props: ['section', 'index'],
	data:{editing_title: false, title: []},
	components:{componentForm},
	mixins:[sortableListByClick], methods: sortableOnClickCbs
}

//section
export const sectionProtected = simpleCrud('#section-protected-template',{props: ['section', 'index']} );
export const sectionMultipleUnlimited = simpleCrud('#section-multiple-unlimited-template', sectionConfig );
export const sectionMultipleLimited = simpleCrud('#section-multiple-limited-template', sectionConfig );
export const sectionMultipleFixed = simpleCrud('#section-multiple-fixed-template', sectionConfig );
export const currentPageSections = simpleCrud('#current-page-sections-template',{props: ['currentPage'],components:{sectionProtected,sectionMultipleUnlimited, sectionMultipleLimited,sectionMultipleFixed} } );
