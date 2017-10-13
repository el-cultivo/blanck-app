<?php
return [
	'file_input' => [
		'max'	=>	'El peso de la imagen debe ser menor o igual a 2 MB',
		'image'	=>	'El archivo debe ser de tipo imagen',
		'required'	=>	'Es necesario elegir un archivo de tipo imagen',
	],
	'create'	=>	[
		'error'		=>	'La imagen no pudo ser cargada',
		'exist'		=>	"La imagen ya fue cargada anteriomente",
		'store'		=>	"La imagen no pudo ser guardada",
		'success'	=>	"La imagen fue creada correctamente"
	],

	'edit'		=>	[
		'error'		=>	"La imagen que desea modificar no existe"
	],

	'update'	=>	[
		'success'	=>	"La imagen se ha actualizado exitosamente"
	],

	'delete'	=>	[
		'error'		=>	"La imagen no pudo ser borrada",
		'success'	=>	"La imagen se ha borrado exitosamente"
	],

	'deletable'	=>	[
		'error'		=>	"La imagen que desea borrar se encuentra en uso"
	],

	'associate'	=>	[
		'exist'		=>	"Ya cuenta con una imagen asignada previamente",
		'use'		=>	"Ya ha asignado esta imagen previamente",
		'error'		=>	"La imagen no pudo ser asignada",
		'success'	=>	"La imagen se ha asignado exitosamente"
	],

	'dissasociate'	=>	[
		'use'		=>	"No cuenta con una imagen asignada",
		'success'	=>	"La imagen se ha desasignado exitosamente",
		'error'		=>	"La imagen no pudo ser desasignada"
	],

	'sort'		=>	[
		'success'	=>	"Orden correctamente guardado"
	]
];
