
var Vue = require('vue');
import {singleImageMixin} from '../mixins/single-image-mixin';

export const singleImage = Vue.extend({
	template: '#single-image-template',
	mixins:[singleImageMixin]
});
