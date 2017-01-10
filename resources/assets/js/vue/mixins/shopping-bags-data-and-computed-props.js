import R from 'ramda';
import {doubleMapNestedAndReturnInUpperLevel} from '../../functions/pure';

export const shoppingBagDataAndComputedProps = {
	data () {
		return {
			bag_names: {
				'agregar-a-mesa-de-regalos': {es: 'Para Mesa De Regalos'},
				personal: {es: 'Para Mi'},
				regalo: {es: 'Para Alguien'}
			},
		};
	},
	computed: {
			printableBagKeys() {
				return R.keys(this.store.bags)
			},
//Objeto importante
			//printableBags :: store.bags {bag: {*}} -> printableBagKeys [Int] -> bag_names [{Int:String}] -> [{*}]
			printableBags() {
				return R.map(key => {
					let bag = this.store.bags[key];
					bag.slug = key,
					bag.name = this.bag_names[key];
					return bag;
				}, this.printableBagKeys);
			},

			//totalItemsInBags :: printableBags [{total : Int, *}] -> Int
			totalItemsInBags() {
				return R.sum(R.pluck('total', this.printableBags));
			},

			//skusByPrintableBag :: printableBags [{skus: [{String sku : Int}]] -> [String sku]
			skusByPrintableBag() {
				return R.compose(R.map(R.keys), R.pluck('skus'))(this.printableBags);
			},

			//printableBagIndexByPrintableBagSlug :: printableBags [{slug}] -> {String slug : Index Int}
			printableBagIndexByPrintableBagSlug() {//se usa para relacionar los skus con los botones de agregar a la bolsa, en el template de single.vue.forms.shopping-bag
				let mapIndexed = R.addIndex(R.map);
				return R.compose(R.mergeAll, mapIndexed((slug, index) => ({[slug]: index})), R.pluck('slug'))(this.printableBags);
			},

			//currentBagProductsWithSkusArray :: current_bag_products [{skus:{sku}, *}] -> [{skus_array, *}]
			currentBagProductsWithSkusArray() {
				return doubleMapNestedAndReturnInUpperLevel(['skus'], ['sku'], 'skus_array', R.pathOr([], ['store','current_bag_products'], this));
			},

			//currentPrintableBagIndex :: String slug -> [slug: Int] -> Int
			currentPrintableBagIndex() {
				let current_bag = R.path(['store','current_bag'], this);
				return R.pathOr(-1, ['printableBagIndexByPrintableBagSlug', current_bag], this);
			},

//Objeto importante
			//currentPrintableBag :: printableBags [{*}] -> currentPrintableBagIndex Int -> {*}
			currentPrintableBag() {
				return this.printableBags[this.currentPrintableBagIndex] || {};
			},

			//skusWithQuantityOfCurrentBag :: currentPrintableBag [{skus:quantity}] -> [{sku, quantity}]
			skusWithQuantityOfCurrentBag() {
				return R.compose(
					R.map( sku_quantity => ({ sku: sku_quantity[0], quantity: sku_quantity[1] }) ),
					R.toPairs
				)(R.pathOr([], ['currentPrintableBag', 'skus'], this));
			},

//Objeto importante
			//currentBagProductsWithSelectedSkusQuantitiesAndPrices :: [{*, [skus]}] ->  [{sku, quantity}] -> [{selected_sku, quantity, price, *}]
			currentBagProductsWithSelectedSkusQuantitiesAndPrices() {
				let hasSku = sku => R.compose(R.contains(sku), R.prop('skus_array'));
				return R.map(swq => {
					let product = R.clone(R.find(hasSku(swq.sku), this.currentBagProductsWithSkusArray))
					let selected_sku_index = R.findIndex(R.propEq('sku', swq.sku), product.skus);
					let price = R.pathOr(NaN, ['skus', selected_sku_index, 'price_with_discount'], product);
					product.price = price;
					product.selected_sku = swq.sku;
					product.quantity = swq.quantity;
					return product;
				}, this.skusWithQuantityOfCurrentBag)
			}
		},
};
