<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used during authentication for various
    | messages that we need to display to the user. You are free to modify
    | these language lines according to your application's requirements.
    |
    */

    'failed' => 'These credentials do not match our records.',
    'throttle' => 'Too many login attempts. Please try again in :seconds seconds.',

    'login' => [
        'label' => 'Log In',
        'form'  =>  [
            'email' =>  [
                'placeholder' =>  'email',
            ],
            'password' =>  [
                'placeholder' =>  'password',
            ],
            'enter' =>  'Enter',
        ],
        'in_active_account' =>  [
            'error' =>  'Unable to access to the account',
        ],
    ],

    'password_reset_email'  =>  [
        'label' =>  'Forgot password?',
    ],

    'password_set'  =>  [
        'error' =>  'Unable to update changes ',
    ],

    'register'  =>  [
      'label' =>  'Register'
    ],
    'password_reset_emailform'  =>  [
      'email' =>  [
        'placeholder' =>  'e mail',
      ],
      'save'  =>  'Send email'
    ]

];
