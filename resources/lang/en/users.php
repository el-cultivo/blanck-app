<?php
return [
	'first_name'      =>  [

        'required'  =>  'You forgot to enter your first  name',
		'max'    =>  'The first name field can not exceed 255 characters'

    ],

	'last_name'      =>  [

        'required'  =>  'You forgot to enter your last  name',
		'max'    =>  'The last name field can not exceed 255 characters'

    ],

	'email'   => [

		'required'  =>  'You forgot to enter your email',
		'email'     =>  'Enter a valid mail',
		'max'    =>  'The email field can not exceed 255 characters',
		'unique'    =>  'The email has already been taken',

	],

	'roles'   => [

		'required'  =>  'Choose a role is required ',
		'exist'     =>  'This role does not exist',
	],

];
