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
       'required'	=>	'Es necesario que ingreses una dirección',
       'array'	=>	'Es necesario que ingreses una dirección',
       'street1' =>	[
           'present'	=>	'Encontramos un problema en el campo calle',
           'string'	=>	'Hay algo mal con la calle que ingresaste'
       ],
       'street2' =>	[
           'present'	=>	'Encontramos un problema en el campo colonia',
           'string'	=>	'Hay algo mal con la colonia que ingresaste'
       ],
       'city' =>	[
           'present'	=>	'Encontramos un problema en el campo ciudad',
           'string'	=>	'Hay algo mal con la ciudad que ingresaste'
       ],
       'state' =>	[
           'present'	=>	'Encontramos un problema en el campo estado',
           'string'	=>	'Hay algo mal con el estado que ingresaste'
       ],
       'country' =>	[
           'present'	=>	'Encontramos un problema en el campo país',
           'string'	=>	'Hay algo mal con el país que ingresaste'
       ],
       'zip' =>	[
           'present'	=>	'Encontramos un problema en el campo código postal',
       ],

   ]

];
