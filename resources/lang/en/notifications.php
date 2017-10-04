<?php

return [
	'user' =>[
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
		'reset_password' => [
			'subject'   => 'Restore password',
			'copy'      => 'We recently noticed that you have lost your password, to restore click on the button',
			'action'    => 'Restore password',
		],
		
		'contact' => [
			'subject'   => 'Contact information: :email (:name)',
			'copy'      => ':name with mail :email leave the following message <br/> :message',
		],

		'thanks_for_contact' => [
			'subject'   => 'Contact confirmation',
			'copy'      => 'Thank you for your message. We will contact you soon.',
		],
	],

];
