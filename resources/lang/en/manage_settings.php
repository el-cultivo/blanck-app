<?php

return [

    'create' => [

        'first_name' => [

            'label'         => 'First Name',
            'placeholder'   => 'First Name',

        ],

        'last_name' => [

            'label'         => 'Last Name',
            'placeholder'   => 'Last Name',

        ],

        'email' => [

            'label'         => 'User email',
            'placeholder'   => 'info@elcultivo.net',

        ],

        'roles' => [

            'label'     => 'Role',
            'select'    => 'Select a role',

        ],

        'save' => 'Save',

    ],

    'success' => [

        'create'    => 'The configuration has been set',
        'update'    => 'The configuration has been updated',
        'trash'     => 'The configuration has been deleted',
        'recovery'  => 'The configuration has been recovered',

    ],

    'error' => [
        'noexist'   => 'The configuration does not exist',
        'cantsave'  => 'The configuration could not be saved',
        'canteditthisuser' => 'The user could not be edited',
        'dontUpdateUser' => 'The user could not be updated',
        'cantedityoursroles' => 'Can not edit your role',
        'canttrashthisuser' => 'Can not delete this user',
        'canttrashyourself' => 'Can not trash your user',
        'problemtotrashthisuser' => 'An error occured while trashing this user',
        'usernotintrash' => 'This user was not trashed',
        'cantrecoverthisuser' => 'This user can not be recovered',
        'problemtorecoverthisuser' => 'An error occured while recovering this user',
    ],

    'blog' => [
        'title' => 'Blog',
        'url'   => [
            'placeholder'   => 'Ex. https://www.tumblr.com/elcultivo/',
            'label'         => 'Link:',
            'helper'        => 'This link will be conected with the Moodboard image in About',
        ]
    ],

    'social' => [
        'title'     => 'Redes sociales',
        'facebook'  => [
            'placeholder'   => 'Ex. https://www.tumblr.com/elcultivo/',
            'label'         => 'Facebook:',
            'helper'        => 'This link will be conected with the footer contact form',
        ],
        'twitter'   => [
            'placeholder'   => 'Ex. https://www.tumblr.com/elcultivo/',
            'label'         => 'Twitter:',
            'helper'        => 'This link will be conected with the footer contact form',
        ],
        'instagram' => [
            'placeholder'   => 'Ex. https://www.tumblr.com/elcultivo/',
            'label'         => 'Instagram:',
            'helper'        => 'This link will be conected with the instagram image in About',
        ],
        'pinterest' => [
            'placeholder'   => 'Ex. https://www.tumblr.com/elcultivo/',
            'label'         => 'Pinterest:',
            'helper'        => 'This link will be conected with the footer contact form',
        ],
        'create'    =>  [
            'form'  =>  [
                'save'  =>  ''
            ]
        ]
    ],

    'mail' => [
        'title' => 'Correo',
        'contact'   => [
            'placeholder'   => 'Ex. info@elcultivo.net',
            'label'         => 'Contact email:',
            'helper'        => '',
        ],
        'system'   => [
            'placeholder'   => 'Ex. hola@elcultivo.net',
            'label'         => 'System email:',
            'helper'        => 'Mail that will send register mails, etc',
        ],
        'notifications'   => [
            'placeholder'   => 'Ex. hola@elcultivo.net',
            'label'         => 'Notifications email:',
            'helper'        => 'Mail that will send notification mails',
        ],
        'register_copy' => [
            'es' => [
                'label'         => 'Mail register copy (spanish):',
            ],
            'en' => [
                'label'         => '(english):',
            ],
        ],
        'purchase_copy' => [
            'es' => [
                'label'         => 'Purchase mail copy (spanish):',
            ],
            'en' => [
                'label'         => '(english):',
            ],
        ],
        'thanks_copy' => [
            'es' => [
                'label'         => 'Thank-you page copy (spanish):',
            ],
            'en' => [
                'label'         => '(english):',
            ],
        ],
        'create'    =>  [
            'form'  =>  [
                'save'  =>  ''
            ]
        ]
        'mail_greeting' => [
          'en' => [
              'label'         => 'Mail greeting:',
          ],

        ],
        'mail_farewell' => [
          'en' => [
              'label'         => 'Mail farewell:',
          ],

        ],
    ],

    'shipment' => [
        'title' => 'Envíos',
        'origin-address'    => [
            'street-1'  => [
                'placeholder'   => 'Street & number',
                'label'         => 'Street 1:',
                'helper'        => 'First line of shipping address',
            ],
            'street-2'  => [
                'placeholder'   => 'Apartment number, , suite, delegation',
                'label'         => 'Street 2:',
                'helper'        => 'Second line of shipping address',
            ],
            'street-3'  => [
                'placeholder'   => 'Neighborhood',
                'label'         => 'Street 3:',
                'helper'        => 'Third line of shipping address',
            ],
            'city'  => [
                'placeholder'   => 'Ex. Mexico City',
                'label'         => 'Ciudad',
                'helper'        => 'City of shipping address',
            ],
            'state'  => [
                'placeholder'   => 'Ex. Mexico City',
                'label'         => 'State:',
                'helper'        => 'State of shipping address',
            ],
            'country'  => [
                'placeholder'   => 'Ex. Mexico',
                'label'         => 'Country:',
                'helper'        => 'Country of shipping address',
            ],
            'zip'  => [
                'placeholder'   => 'Ex. 01234',
                'label'         => 'Zip Code:',
                'helper'        => 'Zip Code of shipping address',
            ],
        ],
        'average-weight'    => [
            'placeholder'   => 'Ex. 10',
            'label'         => 'Average weight:',
            'helper'        => 'Average weight of shipping, in kilograms',
        ],
        'minimal-clothing'  => [
            'placeholder'   => 'Ex. 5',
            'label'         => 'Minimal clothes:',
            'helper'        => 'Minimal clothes per box',
        ],
    ],

    'exchange_rate' => [
        'title'     => 'Exchange rate',
        'US'   => [
            'currency' => [
                'placeholder'   => 'Ex. USD',
                'label'         => 'Type of currency (US):',
                'helper'        => '',
            ],
            'exchange' => [
                'placeholder'   => 'Ex. 19.56',
                'label'         => 'Exchange rate (US):',
            ],
        ],
    ],

    'general' => [
        'save'  => 'Save',
    ],

    'index' => [
        'label' =>  ''
    ],

    'copies'    =>  [
        'index' => [
            'label' =>  ''
        ],
        'create'    =>  [
            'form'  =>  [
                'save'  =>  ''
            ],
        ],
    ],

];
