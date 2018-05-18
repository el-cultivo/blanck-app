import {simpleCrud} from '../../factories/simple-crud-component-makers';
import {multiSelect} from '../../components/multi-select';
import {listFilters, isPath, isPathInObjArray, isStringArray} from '../../mixins/list-filters';

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
