<?php
return [
	'file_input' => [
		'max'	=>	'The weight of the image must be up to 2 MB',
		'image'	=>	'The file must be image type',
		'required'	=>	'It is necessary to choose an image type file',
	],
	'create'	=>	[
		'error'		=>	'Image could not be loaded',
		'exist'		=>	"Image was previously uploaded",
		'store'		=>	"Image could not be saved",
		'success'	=>	"The image was created correctly"
	],

	'edit'		=>	[
		'error'		=>	"The image you want to modify does not exist"
	],

	'update'	=>	[
		'success'	=>	"Image successfully updated"
	],

	'delete'	=>	[
		'error'		=>	"Image could not be deleted",
		'success'	=>	"Image successfully deleted"
	],

	'deletable'	=>	[
		'error'		=>	"The image you want to erase is in use"
	],

	'associate'	=>	[
		'exist'		=>	"You have associated an image previously",
		'use'		=>	"You have previously associated this image",
		'error'		=>	"Image could not be associated",
		'success'	=>	"Image has been successfully associated"
	],

	'dissasociate'	=>	[
		'use'		=>	"Does not have an associated image",
		'success'	=>	"The image has been successfully deasigned",
		'error'		=>	"Image could not be disassociated"
	],

	'sort'		=>	[
		'success'	=>	"Order successfully saved"
	]

];
