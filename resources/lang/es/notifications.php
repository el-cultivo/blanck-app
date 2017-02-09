<?php

return [
    'ResetPasswordNotification' => [
        'subject'   => 'Restablecer contraseña',
        'greeting'  => 'saludo!',
        'copy'      => '<strong> texto de setting </strong>',
        'action'    => 'Restablecer contraseña',
        'farewell'  => 'despedida!',
    ],

    'ActivationAccountNotification' => [
        'subject'   => 'Registro en El Cultivo',
        'greeting'  => 'saludo!',
        'copy'      => '<strong> texto de setting </strong>',
        'action'    => 'Activar cuenta',
        'farewell'  => 'despedida!',
    ],

    'UpdatePasswordNotification'    => [
        'subject'   => 'Tu contraseña ha cambiado',
        'greeting'  => 'Hola!',
        'copy'      => 'Recientemente notamos que tu contraseña ha cambiado, si no reconoces este cambio por favor contacta a soporte técnico',
        'action'    => '',
        'farewell'  => 'Adios!',
    ],

    'UpdateMailNotification'    => [
        'subject'   => 'Tu email ha cambiado',
        'greeting'  => 'hello!',
        'copy'      => 'Recientemente notamos que has hecho un cambio en tu mail, si no fuiste tu por favor contacta a soporte técnico, en caso contrario ignora este mensaje',
        'action'    => '',
        'farewell'  => 'Adios!',
    ],

    'BuySuccessNotification'    => [
        'subject'   => 'Tu pedido elcultivo.mx #:BAG_KEY',
        'greeting'  => 'Confirmación de pedido',
        'copy'      => '',
        'action'    => 'Detalles del pedido',
        'farewell'  => '',
    ],

    'PresentNotification'       => [
        'subject'   => 'elcultivo.mx tiene una sorpresa para ti.',
        'greeting'  => '¡Felicidades :Name!',
        'copy'      => ':User_name te ha hecho un regalo a través de elcultivo.mx, haz click en el siguiente enlace y mira lo que muy pronto recibirás.',
        'action'    => '¡Quiero ver mis regalos!',
        'farewell'  => '',
    ],

];
