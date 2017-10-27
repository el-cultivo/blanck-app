<?php
return [
	'admin_menu'	=>	[
		'label'	=>	'Users',
		'create'	=>	'Create User',
		'index'	=>	'Users List',
		'trash'	=>	'Deleted Users List',
	],
	'create' => [
		'label' => 'Users',
		'instructions' => 'Fill in the blanks to create an user',
		'form' => [
				'first_name'	=> [
						'label'	=>	'First Name',
						'placeholder' =>	'Michael',
				],
				'last_name'	=> [
						'label'	=>	'Last Name',
						'placeholder' =>	'Johnson',
				],
				'email'	=> [
						'label'	=>	'email',
						'placeholder' =>	'mjohnson@mail.com',
				],
				'save' =>	'Save',
			],
		'success'	=>	'User successfuly created',
		'error'	=>	'User could not be created',
		],
		'index'	=> [
			'label' => 'Active Users List',
			'table'	=> [
				'name'	=>	'Name',
				'roles'	=>	'Roles',
				'email'	=>	'email',
				'edit'	=>	'Edit',
				'delete'	=>	'Delete',
				'empty'	=>	'No active users'
			],
	],
	'trash'	=>	[
		'label' => 'Trashed Users List',
		'table'	=> [
			'name'	=>	'Name',
			'roles'	=>	'Roles',
			'email'	=>	'email',
			'recovery'	=>	'Recover',
			'empty'	=>	'No trashed users'
		],
	],
	'edit'	=>	[
			'label'	=>	'Edit user',
			'instructions'	=>	'Fill the form to update the user',
			'roles'	=>	[
				'label'	=>	'Select a role',
			],
			'success'	=>	'User successfuly edited',
			'error'	=>	'User could not be edited',
	],
	'delete'	=>	[
		'success'	=>	'User successfuly trashed',
		'error'	=>	'User could not be trashed',
	],
	'recovery'	=>	[
		'success'	=>	'User successfuly recovered',
		'error'	=>	'User could not be recovered',
	],
	'associate'	=>	[
			'roles'	=>	[
					'success'	=>	'Role associated to the user successfuly',
			],
	],
];
