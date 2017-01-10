<?php

return [

    'success' => [

        'create'    => 'La configuración ha sido creada',
        'update'    => 'La configuración ha sido actualizada',
        'trash'     => 'La configuración ha sido borrada',
        'recovery'  => 'La configuración ha sido recuperada',

    ],

    'error' => [
        'noexist'   => 'La configuración no existe',
        'cantsave'  => 'La configuración no se pudo guardar',
        'canteditthisuser' => 'No es posible editar este usuario',
        'dontUpdateUser' => 'No es posible actualizar este usuario',
        'cantedityoursroles' => 'No es posible editar tu rol',
        'canttrashthisuser' => 'No es posible borrar este usuario',
        'canttrashyourself' => 'No es posible borrar tu usuario',
        'problemtotrashthisuser' => 'Hubo un problema al borrar este usuario',
        'usernotintrash' => 'Este usuario no se ha eliminado',
        'cantrecoverthisuser' => 'No es posible recuperar este usuario',
        'problemtorecoverthisuser' => 'Hubo un problema al recuperar este usuario',
    ],

    'blog' => [
        'title' => 'Blog',
        'url'   => [
            'placeholder'   => 'Ej. https://www.tumblr.com/mextropoli/',
            'label'         => 'Link:',
            'helper'        => 'Este link estará conectado con la imagen de Moodboard en About',
        ]
    ],

    'social' => [
        'title'     => 'Redes sociales',
        'facebook'  => [
            'placeholder'   => 'Ej. https://www.facebook.com/mextropoli',
            'label'         => 'Facebook:',
            'helper'        => 'Este link estará conectado con la forma de contacto del footer',
        ],
        'twitter'   => [
            'placeholder'   => 'Ej. https://www.twitter.com/mextropoli',
            'label'         => 'Twitter:',
            'helper'        => 'Este link estará conectado con la forma de contacto del footer',
        ],
        'instagram' => [
            'placeholder'   => 'Ej. https://www.instagram.com/mextropoli',
            'label'         => 'Instagram:',
            'helper'        => 'Este link estará conectado con la imagen de instagram en About',
        ],
        'pinterest' => [
            'placeholder'   => 'Ej. https://www.pinterest.com/mextropoli',
            'label'         => 'Pinterest:',
            'helper'        => 'Este link estará conectado con la forma de contacto del footer',
        ],
    ],

    'mail' => [
        'title' => 'Correo',
        'contact'   => [
            'placeholder'   => 'Ej. info@mextropoli.mx',
            'label'         => 'Correo de contacto:',
            'helper'        => '',
        ],
        'system'   => [
            'placeholder'   => 'Ej. hola@mextropoli.mx',
            'label'         => 'Correo del sistema:',
            'helper'        => 'Correo con el que se enviarán los mails de registro, etc.',
        ],
        'notifications'   => [
            'placeholder'   => 'Ej. hola@mextropoli.mx',
            'label'         => 'Correo de notificaciones:',
            'helper'        => 'Correo con el que se enviarán los mails de notificaciones',
        ],
        'register_copy' => [
            'es' => [
                'label'         => 'Copy para mail de registro (Español):',
            ],
            'en' => [
                'label'         => '(Inglés):',
            ],
        ],
        'purchase_copy' => [
            'es' => [
                'label'         => 'Copy para mail de compra (Español):',
            ],
            'en' => [
                'label'         => '(Inglés):',
            ],
        ],
        'thanks_copy' => [
            'es' => [
                'label'         => 'Copy para página de agradecimiento (Español):',
            ],
            'en' => [
                'label'         => '(Inglés):',
            ],
        ],
        'mail_greeting' => [
            'es' => [
                'label'         => 'Saludo (Español):',
            ],
            'en' => [
                'label'         => 'Saludo (Inglés):',
            ],
        ],
        'mail_farewell' => [
            'es' => [
                'label'         => 'Despedida (Español):',
            ],
            'en' => [
                'label'         => 'Despedida (Inglés):',
            ],
        ],
    ],

    'shipment' => [
        'title' => 'Envíos',
        'origin-address'    => [
            'street-1'  => [
                'placeholder'   => 'Calle y número',
                'label'         => 'Street 1:',
                'helper'        => 'Primera linea de dirección de envío',
            ],
            'street-2'  => [
                'placeholder'   => 'Número interior, suite, fraccionamiento o delegación',
                'label'         => 'Street 2:',
                'helper'        => 'La segunda linea para la dirección de envío',
            ],
            'street-3'  => [
                'placeholder'   => 'Colonia',
                'label'         => 'Street 3:',
                'helper'        => 'La tercera linea para la dirección de envío',
            ],
            'city'  => [
                'placeholder'   => 'Ej. Ciudad de México',
                'label'         => 'Ciudad',
                'helper'        => 'La ciudad de la dirección de envío',
            ],
            'state'  => [
                'placeholder'   => 'Ej. Distrito Federal',
                'label'         => 'Estado:',
                'helper'        => 'El estado de la dirección de envío',
            ],
            'country'  => [
                'placeholder'   => 'Ej. México',
                'label'         => 'País:',
                'helper'        => 'El país de la compañia',
            ],
            'zip'  => [
                'placeholder'   => 'Ej. 01234',
                'label'         => 'Código postal:',
                'helper'        => 'Código postal de la dirección',
            ],
        ],
        'average-weight'    => [
            'placeholder'   => 'Ej. 10',
            'label'         => 'Peso promedio:',
            'helper'        => 'Peso promedio de cada envío en kilogramos',
        ],
        'minimal-clothing'  => [
            'placeholder'   => 'Ej. 5',
            'label'         => 'Prendas mínimas:',
            'helper'        => 'Prendas mínimas por caja',
        ],
    ],

    'exchange_rate' => [
        'title'     => 'Tipo de cambio',
        'US'   => [
            'currency' => [
                'placeholder'   => 'Ej. USD',
                'label'         => 'Tipo de moneda (US):',
                'helper'        => '',
            ],
            'exchange' => [
                'placeholder'   => 'Ej. 19.56',
                'label'         => 'Tipo de cambio (US):',
            ],
        ],
    ],

    'estafeta_zones' => [
        'title'     => 'Costos zonas de estafeta',
        'base_cost'   => [
            'placeholder'   => '30.50',
            'label'         => 'Costo base:',
            'helper'        => 'Ingresar el costo en pesos mexicanos',
        ],
        'additional_cost'   => [
            'placeholder'   => '6.50',
            'label'         => 'Medio adicional:',
            'helper'        => 'Ingresar el costo en pesos mexicanos',
        ],
    ],

    'card_cost' => [
        'title'         => 'Tarjeta de regalo para eventos',
        'placeholder'   => '12.50',
        'label'         => 'Costo:',
        'helper'        => '',
    ],

    'event_expiration' => [
        'title'         => 'Expiración de eventos después de realizado',
        'placeholder'   => '90',
        'label'         => 'Días para que expire un evento:',
        'helper'        => '',
    ],

    'general' => [
        'save'  => 'guardar',
    ]
];
