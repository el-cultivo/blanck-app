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

	'message' =>	[
		'present'	=>	'Message field must be present',
		'string'	=>	'There is something wrong in your message'
	],

	'email'   => [

		'required'  =>  'You forgot to enter your email',
		'email'     =>  'Enter a valid mail',

	],

	'send'	=> [
		"success"	=> "Thank you very much! We have received your message correctly, you will soon receive a confirmation email.",
	]

];
