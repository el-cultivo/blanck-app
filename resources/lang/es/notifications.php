<?php

return [
	'user' =>[
		'update_password'    => [
			'subject'   => 'Tu contraseña ha cambiado',
	        'copy'      => 'Recientemente notamos que tu contraseña ha cambiado, si no reconoces este cambio por favor contacta a soporte técnico',
		],

		'update_mail'    => [
			'subject'   => 'Tu email ha cambiado',
	        'copy'      => 'Recientemente notamos que has hecho un cambio en tu mail, si no fuiste tu por favor contacta a soporte técnico, en caso contrario ignora este mensaje',
		]
	],

	'admin' => [
		'users'	=> [
			'activation_account' => [
				'subject'   => 'Registro en El Cultivo',
				'action'    => 'Activar cuenta',
			],
		]
	],

	'general'=> [
		'success'			=> 'Hola!',
		'error'				=> 'Whoops!',
		'salutation'		=> 'Saludos',
		'button_problems'	=> 'Si tienes problemas dando click al botón ":button", copia y pega el siguiente URL en tu navegador.',
		'rights_reserved'	=> 'Todos los derechos reservados',

	],

	'client'=> [
		'reset_password' => [
			'subject'   => 'Restablecer contraseña',
	        'copy'      => 'Recientemente notamos que has perdido tu contraseña, para restablecer da click en el boton',
	        'action'    => 'Restablecer contraseña',
		],
		
		'contact' => [
			'subject'   => 'Información de contacto: :email (:name)',
	        'copy'      => ':name con el correo :email dejo el sigiente mensaje <br/> :message',
		],

		'thanks_for_contact' => [
			'subject'   => 'Confirmación de contacto',
			'copy'      => 'Gracias por tu mensaje. Nos comunicaremos contigo pronto.',
		],
	],

];
