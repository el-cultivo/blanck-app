import {sortable} from '../../mixins/sortable';

export const alliesConfig = {
	props: ['types'],
	mixins: [sortable],
	methods: {
		openModal: function(name, $index) {
		    console.log('$index', $index);
			if ($index === undefined) {return}
			this.edit_index = $index;
			$(name).modal('open');
		}
	}, 
	components:{
		// alliesModalCreate,
		// alliesModalEdit
	}, 
};
