import R from 'ramda';
import Vue from 'vue';
import {simpleCrud, simpleCrudWithImage, simpleModalCrud} from '../factories/simple-crud-component-makers.js';
import {gMap} from '../components/g-map';
import {numberFilters} from '../mixins/number-filters';
import {sortable} from '../mixins/sortable';
import {multilistSortable} from '../mixins/multilist-sortable';
import {sortableListByClick, sortableOnClickCbs} from '../mixins/sortable-list-by-click';
import {mexicoStatesAndMunicipalities} from '../mixins/mexico-states-and-municipalities';
import {sortByNestedProp, toArray, objTextFilter, tapLog, nonCyclingMoveInArray} from '../../functions/pure';
import {preSelectOption} from '../../functions/dom';
import {makePost, openModal, openModalFromSimpleImageCrud, postWithMaterialNote, checkboxesMethods} from './helpers/simple-crud-helpers';
import {addedCheckboxElem, removedCheckboxId, pageSectionsCheckboxUpdateSuccess} from './helpers/pages-simple-crud-helpers';




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

const sectionConfig = {//tiene que ir después de componentForm
	props: ['section', 'index'],
	data:{editing_title: false, title: []},
	components:{componentForm},
	mixins:[sortableListByClick],
	methods: sortableOnClickCbs
}

//section
export const sectionProtected = simpleCrud('#section-protected-template',{props: ['section', 'index']} );
export const sectionMultipleUnlimited = simpleCrud('#section-multiple-unlimited-template', sectionConfig );
export const sectionMultipleLimited = simpleCrud('#section-multiple-limited-template', sectionConfig );
export const sectionMultipleFixed = simpleCrud('#section-multiple-fixed-template', sectionConfig );
export const currentPageSections = simpleCrud('#current-page-sections-template',{props: ['currentPage'],ready(){$('.collapsible').collapsible();},components:{sectionProtected,sectionMultipleUnlimited, sectionMultipleLimited,sectionMultipleFixed} } );
