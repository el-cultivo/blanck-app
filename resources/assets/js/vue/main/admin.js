import R from 'ramda';

export var adminVue = {
	el: '#admin-vue',

	methods: {
		openMediaManager() {
			this.$refs.media_manager.open();
		},

		closeMediaManager() {
			this.$refs.media_manager.close();
		},

		openComponent(ref) {
			R.path(['$refs', ref, 'open'], this) ? this.$refs[ref].open() : '';
		},

		closeComponent(ref){
			R.path(['$refs', ref, 'close'], this) ? this.$refs[ref].close() : '';
		}
	}
};
