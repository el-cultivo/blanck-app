export const makePost = function($event) {
	this.post($event.target.form);
}

export const openModal = function(name, $index) {
	if ($index === undefined) {return}
	this.edit_index = $index;
	$(name).modal('open');
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