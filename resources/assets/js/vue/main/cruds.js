export const cruds = {
	ready() {
		console.log('corre cruds');
	},
	methods: {
		openModal(name, $index) {
			console.log($index);
			$(name).modal('open');
		}
	}
};
