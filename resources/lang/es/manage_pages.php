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
	'index'			=> [
		'label'		=> 'Administrar de páginas',
		'instructions'	=>'Da click para editar o borrar una página',
		'table'		=> [
			'name'	=> "Nombre",
			'parent'	=> "Padre",
			'sections'	=> "Secciones",
			'edit'	=> "editar",
			'delete'	=> "Borrar",
			'main_page'	=> "Principal",
			'not_child'	=> "Sin padre",
			"sections_empty"	=> "Sin secciones"
		]
	],
	'create'		=>	[
		'label'		=>  'Crear Página',
		'instructions'	=> 'Llena los campos para crear una nueva página',
		'error'		=>	"La sección no pudo ser creada",
		'success'	=>	"La sección fue creada correctamente",
		'form'	=>	[
			'index'	=> [
				'label' => 'Identificador de la página',
				'placeholder' => 'Nosotros',
			],
			'publish_at'	=> [
				'label' => 'Fecha de publicación',
			],
			'publish_id'	=> [
				'label' => 'Estatus de publicación',
				'placeholder' => 'Elige una opción',
			],
			'parent_id'	=> [
				'label' => 'Página padre',
				'placeholder' => 'Elige una opción',
			],
			'tblank'	=> [
				'label' => '¿Quieres que la página se abra en una nueva ventana?',
				'no' => 'No',
				'yes' => 'Si',
			],
			'label'	=> [
				'label' => 'Nombre de la página',
				'placeholder' => 'Nosotros',
			],
			'save' => 'Guardar',

		],

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
		'success'	=>	"El componente fue correctamente borrado",
		'main'		=>	[
			'error'	=>	'El componente no pudo ser eliminado, ya que está marcado como principal'
		],
		'deletable'	=>	[
			'error'	=>	'El componente no puedo ser eliminado, inténtalo más tarde'
		],
		'sections'	=>	[
			'error'	=>	'El componente no pudo ser eliminado, ya que cuentas con secciones asociadas'
		],
		'languages'	=>	[
			'error'	=>	'El componente no pudo ser eliminado'
		],
		'delete'	=>	[
			'error'		=>	'El componente no pudo ser eliminado',
			'success'	=>	'El componente ha sido eliminado correctamente'
		]
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
			],
			'error'		=>	"La sección no pudo ser borrada",
			'success'	=>	"La sección fue borrada correctamente "
		],
		'checkbox'	=> [
			"add"	=> " Agregar sección",
		],
		'index'	=>	[
			'label' => 'Administrar Secciones',
			'instructions'	=>	'Administrar Secciones',
			'table'	=>	[
				'name'	=>	'Nombre',
				'type'	=>	'Tipo',
				'template'	=>	'Template',
				'pages'	=>	'Paginas',
				'edit'	=>	'Editar',
				'delite'	=>	'Borrar',
			],
		],
		'create_modal'	=>	[
			'label'	=>	'Crear Sección',
			'form'	=>	[
				"index"	=> [
					"label"			=> 'Index',
					"placeholder"	=> 'about',
				],
				"description"	=> [
					"label"			=> 'Descripción',
					"placeholder"	=> 'Acerca de',
				],
				"template_path"	=> [
					"label"			=> 'Template',
					"placeholder"	=> 'home.gallery',
				],
				'components_max'	=> [
					"label"			=> 'Número máximo de componentes',
				],
				'type_id'	=> [
					"label"			=> "Tipo",
					"placeholder"	=> "Seleccionar"
				],
				'editable_contents'	=>	[
					'label'	=>	'Contenido Editable',
					'gallery_img'	=>	[
						'label'	=>	'Galería de Imagenes'
					],
					'title'	=>	[
						'label'	=>	'Título'
					],
					'subtitle'	=>	[
						'label'	=>	'Subtítulo'
					],
					'excerpt'	=>	[
						'label'	=>	'Resumen'
					],
					'content'	=>	[
						'label'	=>	'Contenido'
					],
					'iframe'	=>	[
						'label'	=>	'iFrame'
					],
					'link'	=>	[
						'label'	=>	'Link'
					],
					'thumbnail_img'	=>	[
						'label'	=>	'Thumbnail'
					],
				],
				'save'	=>	'Guardar',
			],
		],
		'edit_modal'	=>	[
			'label'	=>	'Editar Sección',
			'form'	=>	[
				'components_max'	=> [
					"label"			=> 'Número máximo de componentes',
				],
				"template_path"	=> [
					"label"			=> 'Template',
					"placeholder"	=> 'home.gallery',
				],
				"description"	=> [
					"label"			=> 'Descripción',
				],
				'editable_contents'	=>	[
					'label'	=>	'Contenido Editable',
					'gallery_img'	=>	[
						'label'	=>	'Galería de Imagenes'
					],
					'title'	=>	[
						'label'	=>	'Título'
					],
					'subtitle'	=>	[
						'label'	=>	'Subtítulo'
					],
					'excerpt'	=>	[
						'label'	=>	'Resumen'
					],
					'content'	=>	[
						'label'	=>	'Contenido'
					],
					'iframe'	=>	[
						'label'	=>	'iFrame'
					],
					'link'	=>	[
						'label'	=>	'Link'
					],
					'thumbnail_img'	=>	[
						'label'	=>	'Thumbnail'
					],
				],
				'save'	=>	'Guardar',
			],
		],
		'sort'	=>	[
			'error'		=>	"No se pudo ordenar la sección",
			'success'	=>	"Sección clasificada con éxito",
			'save'	=>	"Guardar orden",
		],
		'associate'	=>	[
			'previous_error'	=>	'La sección no pudo ser asociada, inténtalo más tarde',
			'error'	=>	'La sección no pudo ser asociada, inténtalo más tarde',
			'success'	=>	'La sección ha sido asociada correctamente'
		],
		'disassociate'	=>	[
			'error'		=>	'La sección no pudo ser desasociada, inténtalo más tarde',
			'success'	=>	'La sección ha sido desasociada correctamente'
		]
	],
	'contents'	=>	[
		'admin_menu'	=> [
			'label'		=> "Páginas contenido"
		],
		'components'	=>	[
			'gimme_name'	=>	'Pónme un nombre',
			'form'	=>	[
				'title'	=>	[
					'label'	=>	'Título',
					'placeholder'	=>	'Título'
				],
				'excerpt'	=>	[
					'label'	=>	'Extracto'
				],
				'link_title'	=> [
						'label'	=>	'Link',
						'placeholder'	=>	'link'
				],
				'link_url'	=> [
						'label'	=>	'Link Url',
						'placeholder'	=>	'http://www.example.com'
				],
				'tblank_link_'	=>	[
					'label'	=>	'¿Quieres que el link se abra en una nueva ventana?',
					'no'	=>	'No',
					'yes'	=>	'Si'
				],
				'save'	=>	'Guardar',
				'subtitle'	=>	[
					'label'	=>	'Subtítulo',
					'placeholder'	=>	'subtítulo',
				],
				'content'	=>	[
					'label'	=>	'Contenido',
				],
				'iframe'	=>	[
					'label'			=>	'Link del vídeo',
					'placeholder'	=>	''
				]
			],
			'sort'	=> [
				'add'	=> 'Agregar',
				'save'	=>	'Guardar'
			],
			'empty'	=>	'Vacío',
		],
		'index'	=>	[
			'label'			=>	'Páginas',
			'instructions'	=>	'Da click para ver o editar una página; también puedes utilizar las flechas para cambiar el orden.',
			'table'			=>	[
				'name'		=>	'Nombre',
				'state'		=>	'Estatus',
				'show'		=>	'Ver',
				'edit'		=>	'Editar',
				'save_sort'	=>	'Guardar orden',
				'main_page'	=>  'Principal',
			]
		],
		'edit'	=>	[
			'label'			=>	'Editar página',
			'instructions'	=>	'Llena los campos para editar la página :page'
		]
	],
	'edit'	=>	[
		'error'		=>	'La componente no pudo ser actualizada, inténtalo más tarde',
		'success'	=>	'La componente ha sido actualizada correctamente',
		'sections'	=> 	'Secciones',
		'label'		=>	'Editar página',
		'instructions'		=>	'Llena los campos para editar la página :page',
	]
];
