import {ifElementExistsThenLaunch} from './functions/dom';
import {w} from './cltvo/constants.js';
import {alertsController} from './alerts-controller';

//Vue
import {mainVue} from './vue/main-vue';
import {
		allytypes,
		allytypesModalCreate,
		allytypesModalEdit,
		allies,
		allytypesSelect,
		// alliesModalEdit,
		// alliesModalCreate,
		locationtypesModalCreate,
		locationtypesModalEdit,
		locationtypes,
		locationtypesSelect,
		locationsModalCreate,
		locationsModalEdit,
		locations,
		categoriesModalCreate,
		categoriesModalEdit,
		categories,
		topicsModalCreate,
		topicsModalEdit,
		topics,
		registrationtypesModalCreate,
		registrationtypesModalEdit,
		registrationtypes,
		speakersModalCreate,
		speakersModalEdit,
		speakers,
		registrationtypesSelect,
		topicsSelect,
		speakersSelect,
		categoriesSelect,
		locationsSelect
	} from './vue/components/simple-cruds';
import {mexicoStatesAndMunicipalities} from './vue/mixins/mexico-states-and-municipalities';
import {mediaManager} from './vue/components/media-manager';
import {singleImage} from './vue/components/single-image';

w.on('load', () => {
	ifElementExistsThenLaunch([
		[],
		['#admin-vue', mainVue, undefined, [{mixins:[mexicoStatesAndMunicipalities]}, {
			mediaManager,
			singleImage,
			allytypes,
			allytypesModalCreate,
			allytypesModalEdit,
			allies,
			allytypesSelect,
			// alliesModalEdit,
			// alliesModalCreate,
			locationtypesModalCreate,
			locationtypesModalEdit,
			locationtypes,
			locationtypesSelect,
			locationsModalCreate,
			locationsModalEdit,
			locations,
			categoriesModalCreate,
			categoriesModalEdit,
			categories,
			topicsModalCreate,
			topicsModalEdit,
			topics,
			registrationtypesModalCreate,
			registrationtypesModalEdit,
			registrationtypes,
			speakersModalCreate,
			speakersModalEdit,
			speakers,
			registrationtypesSelect,
			topicsSelect,
			speakersSelect,
			categoriesSelect,
			locationsSelect
		}]],
		['#alert__container', alertsController, 'init', []],
	]);
});


console.log('Hola, estás bien sabroso de tu micorriza');


(function($) {


	$(document).ready( function() {

		var toolbar = [
			['style', ['bold', 'italic', 'underline', 'strikethrough', 'clear']],
            ['para', ['style','ul', 'ol']],
            ['insert', ['link',"hr"]],
            ['Misc', ['undo', 'redo','codeview']]
        ];

		var summernote = $('.summernote_JS');

		if (summernote.length > 0) {
	        summernote.summernote({
	            toolbar: toolbar,
	            minHeight: 500,
				placeholder: 'Vamos a empezar...',
				dialogsInBody: false,
				disableDragAndDrop: true,
				onInit : function(){
                	$('.note-editor [data-name="ul"]').tooltip('disable');
            	}
	        });
		}

		// var toolbar = [
        //     ['style', ['style', 'bold', 'italic', 'underline', 'strikethrough', 'clear']],
        //     ['fonts', ['fontsize', 'fontname']],
        //     ['color', ['color']],
        //     ['undo', ['undo', 'redo', 'help']],
        //     ['ckMedia', ['ckImageUploader', 'ckVideoEmbeeder']],
        //     ['misc', ['link', 'picture', 'table', 'hr', 'codeview', 'fullscreen']],
        //     ['para', ['ul', 'ol', 'paragraph', 'leftButton', 'centerButton', 'rightButton', 'justifyButton', 'outdentButton', 'indentButton']],
        //     ['height', ['lineheight']],
        // ];
		//
		// var materialnote = $('.materialnote_JS');
		//
		// if (materialnote.length > 0) {
	    //     materialnote.materialnote({
		// 		toolbar: toolbar,
	    //         height: 550,
	    //         minHeight: 100,
	    //         defaultBackColor: '#fff'
	    //     });
		// 	$(".note-editor").find("button").attr("type", "button");
		// }

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

		// Despliega selects

/*

	// diego corregir aqui
		$('select').material_select();
		console.log("reagey");


		$(document).ajaxComplete(function(){
			console.log("ajax");
			$('select').trigger('contentChanged')
		});

		$('.datepicker').pickadate({
			format: 'yyyy-mm-dd',
		  	selectMonths: true, // Creates a dropdown to control month
		  	selectYears: 15 // Creates a dropdown of 15 years to control year
		});

		$('select').on('contentChanged', function() {
		  // re-initialize (update)
		  	console.log('change');

				$('select').material_select('destroy');
				$('select').material_select();
		});

 */
	//hasta aqui
	});

})(jQuery);
