import {numberFilters} from '../mixins/number-filters';
import R from 'ramda';
import Vue from 'vue';
import {crudAjax} from '../mixins/crud-ajax';
import {sumTotalPrice} from '../../functions/pure';

export var shoppingBagMaker = function(config) {
	return Vue.extend({
		template: config.template,
		mixins: R.concat([crudAjax, numberFilters], config.mixins || []),
		props: R.concat(['bagKey', 'printableBags',  'totalItemsInBags', 'currency', 'exchangeRate', 'currentLanguage', 'bag'], config.props || []),

		computed: R.merge({
			//products_total_price :: bag [{Number price, Int quantity, *}] -> Number price
			products_total_price() {
				return sumTotalPrice(this.bag || []);
			}
		}, config.computed||{}),

		data: function() {
			return R.merge({
			}, config.data || {});
		},

		ready() {
			if(typeof config.ready === 'function') return config.ready.call(this);
		},

		methods: R.merge({
		}, config.methods || {}),

		watch: R.merge({
		}, config.watch || {})
	});
};
