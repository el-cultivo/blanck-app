<?php
    return [
        'admin_menu'  =>  [
            'label' =>  'Menú',
            'index' =>  'Administrador',
        ],
        'index' => [
            'greeting'      => 'Hola :name',
            'label'         => 'Administrador',
            'instructions'  => 'Da click en alguno de los ítems del menú lateral',
        ],
        'manuals' => [
            'label'		=>	'Manuales',
            'admin_menu'  =>  [
                'label' =>  'Manuales',
                'index' =>  'Vídeos',
            ],
            'coming_soon'   =>  'En desarrollo'
        ],
        'site_map' => [
            'label'		=>	'Mapa de rutas',
            'index'		=>	'Administrador de rutas',
            'instructions'  =>  'Lista de rutas del sitio',
            'admin_menu'	=>	[
                'label'		=>	'Rutas',
                'index'		=>	'Lista de rutas',
                'create'	=>	'Agregar ruta',
                'contents' => [
                    'index' => 'Rutas',
                ],
            'sections' => [
                'index' => 'Administrador de secciones de rutas',
            ]
            ],
            'route_name' => [
                'label' => 'Nombre de la ruta'
            ],
        ],
		'translations'	=> [
			"label"	=> 'Traducciones incompletas',
			'instructions'  =>  'Lista de rutas de traducciones incompletas del sitio',
			"file"	=> [
				"languages"	=> 'Idiomas faltantes',
				"trans_key"	=> "Llave de traducción",
				"line"		=> 'Línea',
			],

			"found"		=> "Se encontraron :total_trans_find traducciones en :total_files archivos",
			"checked"	=> 'Se revisaron :total_trans_checked traducciones y se encontraron <span class="red-text">:total_trans_no_complete</span> por agregar',
			'admin_menu'	=> [
				'label'	=> 'Traducciones',
				'index'		=>	'Lista de traducciones',
			],
		]
    ];
