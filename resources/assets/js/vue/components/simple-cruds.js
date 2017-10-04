import R from 'ramda';
import Vue from 'vue';
import {simpleCrud, simpleCrudWithImage, simpleModalCrud} from '../factories/simple-crud-component-makers.js';
import {multiSelect} from '../components/multi-select';
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

// usuarios
export const rolesMultiSelect = multiSelect('#roles-multi-select-template');

let userFilters = {
	data: {
		filters: {
			name: {
				description: 'Nombre',
				filters: [isPath(['full_name'])]
			},
			email: {
				description: 'E-mail',
				filters: [isPath(['email'])]
			},
			role: {
				description: 'Rol',
				filter: [isPathInObjArray(['roles'], ['label'])]
			},
		}
	},
	mixins: [listFilters],
};
// users index
export const users = simpleCrud('#users-template', userFilters);

// users trash
export const usersTrash = simpleCrud('#users-trash-template', userFilters);
