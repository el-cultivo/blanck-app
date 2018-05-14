import R from 'ramda';

export const editIndex = function() {
	this.item_on_edit = this.filteredList[this.editIndex];
}

export const onUpdateSuccess = function(body, input) {
	let index = R.findIndex(el => el.id === body.data.id, this.list)
	if(index === -1) { return }
	this.list.splice(index, 1, body.data)
	this.item_on_edit =  body.data
	this.modal.modal('close')
}
