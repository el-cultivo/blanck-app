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


(function($) {


	$(document).ready( function() {

		// Sidebar Item Display
		$('.label_JS').click( function () {
			if ( !$(this).hasClass('label_active') ) {
				$('.tree_JS').slideUp();
				$('.label_JS').removeClass('label_active');
				$(this).addClass('label_active');
				$(this).parent().find('.tree_JS').slideDown();
			}
		});

		// Sidebar Item Display
		$('.label_active').parent().find('.tree_JS').slideDown();

		// Trigger Choose File on Media Manager
		$(document).on('click','#media-trigger_JS', function() {
			$('#media-input_JS input').click();
		}).find('#media-input_JS input').on('click', function (e) {
			e.stopPropagation();
		});

	});

})(jQuery);
