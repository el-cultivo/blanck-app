<?php
return [
	'admin_menu'	=>	[
		'label'		=>	'Pages',
		'index'		=>	'Manage Pages',
		'create'	=>	'Add Page',
		'contents' => [
			'index' => 'Pages',
		],
		'sections' => [
			'index' => 'Manage Sections',
		],
	],
	'update'		=>	[
		'error'		=>	"Could not update component",
		'success'	=>	"Component updated successfuly"
	],
	'delete'		=>	[
		'error'		=>	"Can not delete this component",
		'images'	=>	"Can not delete this component, it has related images",
		'success'	=>	"Component deleted successfuly",
		'delete'		=>	[
			'error'		=>	"Can not delete this page",
			'success'	=>	"Image deleted successfuly"
		],
		'main'	=>	[
				'error'	=>	'Can not delete this page'
		],
		'deletable'	=>	[
			'error'		=>	"Page is not deletable",
		],
		'sections'	=>	[
			'error'	=>	'Can not delete this page. It has associated sections'
		],
		'languages'	=>	[
			'error'	=>	'Can not delete this page. Languages error'
		]
	],
	'sort'		=>	[
		'error'		=>	"Can not update new order",
		'success'	=>	"New order saved successfuly"
	],
	'content'	=>	[
		'sort'	=>	[
			'error'		=>	"Last order could not be deleted",
			'success'	=>	"Order updated successfuly"
		]
	],
	'sections'		=>	[
		'index' => 'Manage Sections',
		'create'	=>	[
			'error'		=>	"Could not create section",
			'success'	=>	"Section created successfuly"
		],
		'update'	=>	[
			'error'		=>	"Could not update section",
			'success'	=>	"Section updated successfuly"
		],
		'delete'	=>	[
			'soft'	=>	[
				'error'		=>	"This section is asociated to pages or components, so it can not be deleted",
			],
			'error'		=>	"Could not delete section",
			'success'	=>	"Section deleted successfuly"
		],
		'associate'	=>	[
			'error'		=>	"Could not asociate section",
			'success'	=>	"Section asociated successfuly",
			'previous_error'	=>	'Could not find associated sections'
		],
		'disassociate'	=>	[
			'error'		=>	"Could not disasociate section",
			'success'	=>	"Section disasociated successfuly"
		],
		'sort'	=>	[
			'error'		=>	"Could not sort section",
			'success'	=>	"Section sorted successfuly",
			'save'	=>	'Save Sections',
		],
		'index'	=>	[
			'label'	=>	'Manage Sections',
			'instructions'	=>	'Click to edit pages sections',
			'table'	=>	[
				'name'	=>	'Name',
				'type'	=>	'Type',
				'template'	=>	'Template',
				'pages'	=>	'Pages',
				'edit'	=>	'Edit',
				'delite'	=>	'Delete',
			],
		],
		'create_modal'	=>	[
			'label'	=>	'Create Section',
			'form'	=>	[
					'index'	=>	[
							'label'	=> 'Section Name',
							'placeholder'	=>	'Home Slider',
					],
					'description'	=>	[
							'label'	=>	'Description'
					],
					'template_path'	=>	[
						'label'	=> 'Template path',
						'placeholder'	=>	'home.slider',
					],
					'components_max'	=>	[
						'label'	=> 'Maximum number of components',
					],
					'type_id'	=>	[
						'label'	=> 'Type',
						'placeholder'	=>	'Select',
					],
					'editable_contents'	=>	[
						'label'	=> 'User Editable Contents',
						'gallery_img'	=>	[
								'label'	=>	'Gallery Image',
						],
						'title'	=>	[
								'label'	=>	'Title',
						],
						'excerpt'	=>	[
								'label'	=>	'Excerpt',
						],
						'iframe'	=>	[
								'label'	=>	'iFrame',
						],
						'thumbnail_img'	=>	[
								'label'	=>	'Thumbnail Image',
						],
						'subtitle'	=>	[
								'label'	=>	'Subtitle',
						],
						'content'	=>	[
								'label'	=>	'Content',
						],
						'link'	=>	[
								'label'	=>	'Link',
						],
					],
					'save'	=>	'Save',
			],
		],
		'checkbox' => [
			'add'	=>	'Select sections to add',
		],
		'index'	=>	[
			'label' => 'Manage Sections',
			'instructions'	=>	'Manage sections',
			'table'	=>	[
				'name'	=>	'Name',
				'type'	=>	'Type',
				'template'	=>	'Template',
				'pages'	=>	'Pages',
				'edit'	=>	'Edit',
				'delite'	=>	'Delete',
			],
		],
		'edit_modal'	=>	[
				'label'	=>	'Edit Section',
				'form'	=>	[
						'description'	=>	[
								'label'	=>	'Description'
						],
						'template_path'	=>	[
									'label'	=>	'Template Path'
						],
						'template_pathtemplate_path'	=>	[
									'placeholder'	=>	'home.slider'
						],
						'save'	=>	'Save',
				],
		],
	],

	'create'	=>	[
		'error'		=>	"Could not create section",
		'success'	=>	"Section created successfuly",
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
	'edit'	=>	[
		'label'	=>	'Edit Pages',
		'instructions'	=>	'Edit this page',
		'sections'	=> 'Sections',
		'success'	=>	'Page edited successfuly',
		'error'	=>	'Page could not be edited',
	],
	'contents' => [
		'admin_menu' => [
				'label'	=>	'Pages',
		],
		'index'	=>	[
			'label' => 'Pages',
			'instructions'	=>	'Manage pages',
			'table'	=>	[
				'name'	=>	'Name',
				'state'	=>	'State',
				'index'	=>	'Index',
				'show'	=>	'Show',
				'edit'	=>	'Edit',
				'main_page'	=>	'Main Page',
			],
		],
		'edit'	=>	[
			'label'	=> 'Edit Page',
			'instructions'	=>	'Edit the form to update pages',
		],
		'components'	=>	[
			'gimme_name'	=>	'Give me a name',
			'form'	=>	[
				'title'	=>	[
					'label'	=>	'Title',
					'placeholder'	=>	'Title'
				],
				'excerpt'	=>	[
					'label'	=>	'Excerpt'
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
					'label'	=>	'Open in a new window?',
					'no'	=>	'No',
					'yes'	=>	'Yes'
				],
				'save'	=>	'Save',
				'subtitle'	=>	[
					'label'	=>	'Subtitle',
					'placeholder'	=>	'subtitle',
				],
				'content'	=>	[
					'label'	=>	'Content',
				]
			],
			'sort'	=> [
				'add'	=> 'Add',
				'save'	=>	'Save'
			],
			'empty'	=>	'Empty',

		],
	],
	'recovery'	=>	[
			'success'	=>	'Page recovered successfuly',
			'error'	=>	'Page could not be recovered',
	],


];
