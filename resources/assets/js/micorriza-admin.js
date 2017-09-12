import {ifElementExistsThenLaunch} from './functions/dom';
import {w} from './cltvo/constants.js';
import {alertsController} from './alerts-controller';

//Vue
import {mainVue} from './vue/main-vue';
import {adminVue} from './vue/main/admin';
import {
		pages,
		pagesectionsModalCreate,
		pagesectionsModalEdit,
		pagesections,
		pagesectionsCheckbox,
		pagesectionsSort,
		sectionProtected,
		sectionMultipleUnlimited,
		sectionMultipleLimited,
		sectionMultipleFixed,
		componentForm,
		currentPageSections
	} from './vue/components/pages-simple-cruds';
import {mediaManager} from './vue/components/media-manager';
import './vue/components/multi-images';
import './vue/components/single-image';
import './vue/components/cltvo-v-editor';

w.on('load', () => {
	ifElementExistsThenLaunch([
		[],
		['#admin-vue', mainVue, undefined, [adminVue, {
			mediaManager,
			pages,
			pagesectionsModalCreate,
			pagesectionsModalEdit,
			pagesections,
			pagesectionsCheckbox,
			pagesectionsSort,
			sectionProtected,
			sectionMultipleUnlimited,
			sectionMultipleLimited,
			sectionMultipleFixed,
			componentForm,
			currentPageSections
		}]],
		['#alert__container', alertsController, 'init', []],
	]);
});


console.log('Hola, estás bien sabroso de tu micorriza');
