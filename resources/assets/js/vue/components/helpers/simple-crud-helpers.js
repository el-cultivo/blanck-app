import R from 'ramda';
export const makePost = function($event) {
	this.post($event.target.form);
}

export const openModal = function(name, $index) {
	if ($index === undefined) {return}
	this.edit_index = $index;
	$(name).modal('open');
}

export const closeModal = function(name) {
    if (this.modal.length > 0) {
        this.modal.modal('close')
    } else {
        $(name).modal('close');
    }
}

export const openModalFromSimpleImageCrud = function(name, $index) {
	if ($index === undefined) {return}
	this.$parent.$data.edit_index = $index;
	$(name).modal('open');
}


export const postWithMaterialNote = function($event) {
	let mn = $($event.target).find('.materialnote_JS')
	mn.each(function() {
		let $this = $(this),
		     note = $this.siblings('.note-editor').find('.note-editable');
	     $this.text(note.html())
	});
	this.post($event)
};

export const openMultiSelect = function(selector) {

	$('html').click(function() {
		$('.container-items_JS').slideUp();
	});
	$('.submenu_JS').click(function(event){
		event.stopPropagation();
	});
	$(".select-wrapper").click(function(){
  		$(".select-wrapper").not(this).next(".container-items_JS").slideUp("slow");
  		$(this).next(".container-items_JS").slideDown("slow");
	});
}

export const checkboxesMethods = function(options) {
	let toNumberMap = R.map(n => Number(n));

	return {
		props:['currentPage'],

		data: {
			selected_checkboxes: [],
			search: ''
		},

		ready() {
			this.selected_checkboxes = R.map(n => n+'', this.currentPage.sections_ids);
		},

		methods: R.merge({
			openModal,

			makePost,

	   		updateSelectedCheckboxes() {
				this.selected_checkboxes = R.map(elem => elem.id+'', this.selectedElems || []);
	   		},

			is_checked(id) {
				return R.contains(Number(id), toNumberMap(this.selected_checkboxes)) ? true : false;
			}
		}, options.methods || {})
	}
}
