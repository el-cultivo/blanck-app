<?php
return [
	'admin_menu'	=>	[
		'label'		=>	'Páginas',
		'index'		=>	'Administrar Páginas',
		'create'	=>	'Agregar Página',
		'contents' => [
			'index' => 'Páginas',
		],
		'sections' => [
			'index' => 'Administrador de Secciones',
		]
	],
	'update'		=>	[
		'error'		=>	"El componente no pudo ser actualizado",
		'success'	=>	"El componente fue correctamente actualizado"
	],
	'update'		=>	[
		'error'		=>	"El componente no pudo ser actualizado",
		'success'	=>	"El componente fue correctamente actualizado"
	],
	'delete'		=>	[
		'error'		=>	"El componente no puede ser borrado",
		'images'	=>	"El componente no pudo ser borrado porque tiene imágenes asociadas",
		'success'	=>	"El componente fue correctamente borrado"
	],
	'sort'		=>	[
		'error'		=>	"El nuevo orden no pudo ser actualizado",
		'success'	=>	"Orden correctamente guardado"
	],
	'content'	=>	[
		'sort'	=>	[
			'error'		=>	"El orden anterior no pudo ser borrado",
			'success'	=>	"El orden se actualizó correctamente"
		]
	],
	'sections'		=>	[
		'create'	=>	[
			'error'		=>	"La sección no pudo ser creada",
			'success'	=>	"La sección fue creada correctamente"
		],
		'update'	=>	[
			'error'		=>	"La sección no pudo ser actualizada",
			'success'	=>	"La sección fue correctamente actualizada"
		],
		'delete'	=>	[
			'soft'	=>	[
				'error'		=>	"La sección que desea borrar tiene páginas o componentes asociados, por lo que no puede ser eliminada",
			]
			'error'		=>	"La sección no pudo ser borrada",
			'success'	=>	"La sección fue borrada correctamente "
		],

	]

	'create'	=>	[
		'error'		=>	"La sección no pudo ser creada",
		'success'	=>	"La sección fue creada correctamente"
		'label'	=>	'Add Page',
		'instructions'	=> 'Fill in the blanks to add a new page',
		'form'	=>	[
			'index'	=> [
				'label' => 'Page Identifier',
				'placeholder' => 'Home',
			],
			'publish_at'	=> [
				'label' => 'Publish Date',
			],
			'publish_id'	=> [
				'label' => 'Page Status',
				'placeholder' => 'Select an option',
			],
			'parent_id'	=> [
				'label' => 'Page Status',
				'placeholder' => 'Select an option',
			],
			'tblank'	=> [
				'label' => 'Open in a new window',
				'no' => 'no',
				'yes' => 'yes',
			],
			'label'	=> [
				'label' => 'Page Name',
				'placeholder' => 'Home',
			],
			'save' => 'Save',

		],
	],
	'index'	=>	[
		'label' => 'Manage Pages',
		'instructions' => 'Click to edit page structure',
		'table'	=>	[
			'name'	=>	'Name',
			'parent'	=>	'Parent',
			'sections'	=>	'Sections',
			'edit'	=>	'Edit',
			'delete'	=>	'Delete',
			'main_page'	=> 'Main page of the site',
			'not_child'	=> 'No parent',
			'sections_empty'	=> 'No sections',
		],
	],
];
