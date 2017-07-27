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

   'email'   => [

       'required'  =>  'Es necesario que ingreses un correo electrónico',
       'email'     =>  'Ingresa un correo electrónico válido',

   ],

   'phone'	=>	[
       'present'	=> 'El campo teléfono debe estar presente',
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
