<?php
return [

    'first_name' => [
       'required'	=>	'El nombre es obligatorio',
       'max'	=>	'El nombre debe tener 255 caracteres como máximo',
   ],
   'last_name' => [
       'required'	=>	'El apellido es obligatorio',
       'max'	=>	'El apellido debe tener 255 caracteres como máximo',
   ],
   'message' =>	[
	   'present'	=>	'Encontramos un problema con tu mensage',
	   'string'	=>	'Hay algo mal con el mensage que ingresaste'
   ],
   'email'   => [

       'required'  =>  'Es necesario que ingreses un correo electrónico',
       'email'     =>  'Ingresa un correo electrónico válido',

   ],

   'sended'	=> [
	   "success"	=> "¡Muchas gracias! Hemos recibido tu mensaje correctamente, pronto recibirás un correo de confirmación.",
   ]

];
