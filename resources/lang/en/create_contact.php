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

	],

	'phone'	=>	[
		'present'	=> 'Phone field must be present',
	],

	'address' =>	[
		'required'	=>	'You forgot to enter your address',
		'array'	=>	'You forgot to enter your address',
		'street1' =>	[
			'present'	=>	'Street 1 field must be present',
			'string'	=>	'There is something wrong in your street 1'
		],
		'street2' =>	[
			'present'	=>	'Street 2 field must be present',
			'string'	=>	'There is something wrong in your street 2'
		],
		'city' =>	[
			'present'	=>	'City field must be present',
			'string'	=>	'There is something wrong in your city'
		],
		'state' =>	[
			'present'	=>	'State field must be present',
			'string'	=>	'There is something wrong in your state'
		],
		'country' =>	[
			'present'	=>	'Country field must be present',
			'string'	=>	'There is something wrong in your country'
		],
		'zip' =>	[
			'present'	=>	'Zip field must be present',
		],

	]

];
