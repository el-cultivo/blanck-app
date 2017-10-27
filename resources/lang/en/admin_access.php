<?php
return [
  'admin_menu'  =>  [
        'label' =>  'Menu',
        'index' =>  'Administrator',
  ],
    'index' => [
      'greeting'      => 'Hello ',
      'label'         => 'Administrator',
      'instructions'  => 'Click on any item in the menu',
  ],
  'manuals' => [
      'label'		=>	'Manuals',
      'admin_menu'  =>  [
            'label' =>  'Manuals',
            'index' =>  'Videos',
      ]
  ],
  'site_map' => [
    'label'		=>	'Routes',
    'index'		=>	'Routes Administrator',
    'instructions'  =>  'Site Routes',
    'admin_menu'	=>	[
      'label'		=>	'Routes',
      'index'		=>	'Routes Administrator',
      'create'	=>	'Add Route',
      'contents' => [
        'index' => 'Routes',
      ],
      'sections' => [
        'index' => 'Routes Section Administrator',
      ]
    ],
    'route_name' => [
      'label' => 'Route Name'
    ],
  ],

];
