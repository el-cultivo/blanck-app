<?php

return [
	'user' =>[
		'reset_password' => [
			'subject'   => 'Restore password',
			'copy'      => 'We recently noticed that you have lost your password, to restore click on the button',
			'action'    => 'Restore password',
		],

		'update_password'    => [
			'subject'   => 'Your password has changed',
			'copy'      => 'Recently your password was changed. If it was you ignore this message on the contrary call techincal support',
		],

		'update_mail'    => [
			'subject'   => 'Your email has changed',
			'copy'      => 'Recently your email was changed. If it was you ignore this message on the contrary call techincal support',
		]
	],

	'admin' => [
		'users'	=> [
			'activation_account' => [
				'subject'   => 'El Cultivo register',
				'action'    => 'Activate account',
			],
		]
	],

	'general'=> [
		'success'			=> 'Hello!',
		'error'				=> 'Whoops!',
		'salutation'		=> 'Greetings',
		'button_problems'	=> 'If you have problems clicking the ":button", copy and paste the following URL in your browser.',
		'rights_reserved'	=> 'All rights reserved',

	],

	'client'=> [

	],

];
