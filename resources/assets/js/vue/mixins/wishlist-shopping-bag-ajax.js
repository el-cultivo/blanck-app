import R from 'ramda';

export const wishlistShoppingBagAjax = {
	data() {
		return {
			// in_wishlist: false//comentado para otros proyectos en Nice To have usamos una prop heredada al componente que llama este mixin
		};
	},

	methods: {
/////////////Ajax
//eventualmente todas las lineas comentadas deben dejar de estarlo o ser sustituidas
		dealWithCookieOnAjaxResponse(cookie) {//cuando no se ha seteado una cookie en el bag
			// if (R.path(['bags'], cookie)) {
			// 	this.$root.$data.store.bag_keys = cookie.bags;
			// }
		},

		onAddtobagSuccess(body) {
			this.$root.$data.store.bags = body.bags;
			this.updateBagKeys(body.bags);
		},

		onUpdatebagSuccess(body) {
			this.$root.$data.store.bags = body.bags;
			this.updateBagKeys(body.bags);
		},

		onRemovefrombagSuccess(body) {
			this.$root.$data.store.bags = body.bags;
			this.updateBagKeys(body.bags);
		},

		onAddtowishlistSuccess(body) {
			console.log('add');
			this.$root.$data.store.products_in_wishlist = R.append(this.id, this.$root.$data.store.products_in_wishlist)
			console.log('this.$root.$data.store.products_in_wishlist', this.$root.$data.store.products_in_wishlist);
		},

		onRemovefromwishlistSuccess() {
			console.log('remove');
			this.$root.$data.store.products_in_wishlist = R.without([this.id], this.$root.$data.store.products_in_wishlist)
			console.log('this.$root.$data.store.products_in_wishlist', this.$root.$data.store.products_in_wishlist);
		},

		updateBagKeys(bags) {
			let bag_names = R.keys(bags);
			let	bag_keys = R.fromPairs(R.map(bag => [ bag, bags[bag].key ], bag_names));
			this.$root.$data.store.bag_keys = bag_keys;
		}
	}
};
