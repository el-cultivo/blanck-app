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
		'required'	=>	'',
		'array'	=>	'',
		'street1' =>	[
			'present'	=>	'',
			'string'	=>	''
		],
		'street2' =>	[
			'present'	=>	'',
			'string'	=>	''
		],
		'city' =>	[
			'present'	=>	'',
			'string'	=>	''
		],
		'state' =>	[
			'present'	=>	'',
			'string'	=>	''
		],
		'country' =>	[
			'present'	=>	'',
			'string'	=>	''
		],
		'zip' =>	[
			'present'	=>	'',
		],

	]

];
