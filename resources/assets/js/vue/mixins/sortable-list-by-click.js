import {nonCyclingMoveInArray} from '../../functions/pure';

export const sortableListByClick = {
	data() {
		return {
			sortable_list: []
		}
	},

	ready() {
		this.sortable_list = this.list
	},

	computed: {
		sorted_ids() {
			return this.sortable_list.map(page => page.id)
		}
	},

	methods: {
		//Int 1(down) | -1( up:) -> Int -> IO VueData this.sortable_list
		move(direction, index, list) {
			this.sortable_list = nonCyclingMoveInArray(direction, index, list);
		}
	}
}
