import R from 'ramda';

export const menusStore = {
	menus: {
		main: {
			isOpen: false,
			preventBodyScroll: true//when open
		}
	}
};

export const menusMixin = {
	data: {
		store: menusStore
	},
	computed: {
		bodyScrollIsDisabled() {
			return R.compose(
				R.any(R.equals(true)),
				R.values,
				R.map(menu => menu.isOpen && menu.preventBodyScroll)
			)(menusStore.menus)
		}
	},
	methods: {
		closeOpenStuff(args) {
			this.$emit('toggle-menu', undefined)
			if(config.closeOpenStuff === 'function') {config.closeOpenStuff(args)}
		},
		toggleMenu(menu_name) {
			this.$emit('toggle-menu', menu_name)
		}
	},

	events: {
		'toggle-menu': function(menu_name) {
			let other_menus_names = R.filter(menu => menu !== menu_name, R.keys(this.store.menus));

			R.forEach(menu_name => {
				if (R.path(['store', 'menus', menu_name], this)) {
					this.store.menus[menu_name].isOpen = false;
				}
			}, other_menus_names);
			if (R.path(['store', 'menus', menu_name], this)) {
				this.store.menus[menu_name].isOpen = !this.store.menus[menu_name].isOpen;
			}
		}
	}
};