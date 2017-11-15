<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

// Principles
Route::get('/', 'Admin\AdminController@index')->name('index');
Route::get('manuals', 'Admin\AdminController@manuals')->name('manuals');

// Mapa de rutas
Route::group(['middleware' => ['permission:routes_view'] ], function(){
    Route::get('site-map', 'Admin\AdminController@siteMap')->name('site_map');
});

// Administrador de settings
Route::group(['middleware' => ['permission:system_config'] ,'prefix' => 'settings', 'as' => 'settings.'], function(){
    Route::resource('/', 'Admin\Settings\ManageSettingsController',
        ['only'         => ['index', 'update'],
        'parameters'    => ['' => 'setting_key']
    ]);
});

// Administrador de copies
Route::group(['middleware' => ['permission:system_config'] ,'prefix' => 'copies', 'as' => 'copies.'], function(){
    Route::resource('/', 'Admin\Settings\ManageCopiesController',
        ['only'         => ['index', 'update'],
        'parameters'    => ['' => 'copy']
    ]);
});

// Administrador de shapes
Route::group(['middleware' => ['permission:system_config'] ,'prefix' => 'shapes', 'as' => 'shapes.'], function(){
    Route::resource('/', 'Admin\Settings\ManageShapesController',
        ['only'         => ['index'],
        'parameters'    => ['' => 'shape']
    ]);
});

// Administrador de Seo Booster
Route::group(['middleware' => ['permission:manage_seo_booster'], 'prefix' => 'seo', 'as' => 'seo.' ], function(){
    Route::resource('/', 'Admin\Seo\ManageSeoController', [
        'only'         => ['index', 'create', 'edit', 'store', 'update'],
        'parameters'   => ['' => 'seo']
    ]);
});

// Administrador de usuarios
Route::group(['middleware' => ['permission:manage_users'] ,'prefix' => 'users', 'as' => 'users.'], function(){
    Route::resource('/', 'Admin\Users\ManageUserController',
        ['only'         => ['index', 'create', 'edit', 'store', 'update'],
        'parameters'    => ['' => 'user_editable']
    ]);

    Route::resource('/', 'Admin\Users\ManageUserController',
        ['only'         => ['destroy'],
        'parameters'    => ['' => 'erasable_user']
    ]);

    Route::group(['middleware' => ['onlyajax'], 'as' => 'ajax.'  ,'prefix' => 'ajax' ], function(){
        Route::patch( '{user_editable}/roles' , 'Admin\Users\ManageUserController@roles')->name('roles');
    });


    Route::get('trash', 'Admin\Users\ManageUserController@trash')->name('trash');
    Route::patch('trash/{user_trashed}', 'Admin\Users\ManageUserController@recovery')->name('recovery');
});

// Media Manager
Route::group(['middleware' => ['permission:manage_photos'] ,'prefix' => 'photos', 'as' => 'photos.'], function(){
    Route::group(['middleware' => ['permission:photos_view']], function(){
        Route::get('/', 'Admin\Photos\ManagePhotosController@indexView')->name('index');
    });

    Route::group(['middleware' => ['onlyajax'], 'as' => 'ajax.'  ,'prefix' => 'ajax'], function(){
        Route::resource('/', 'Admin\Photos\ManagePhotosController',
            ['only'         => ['index', 'edit', 'store', 'update', 'destroy'],
            'parameters'    => ['' => 'photo']
        ]);

        Route::post('{photo}/associate', 'Admin\Photos\ManagePhotosController@associate')->name('associate');
        Route::delete('{photo}/disassociate', 'Admin\Photos\ManagePhotosController@disassociate')->name('disassociate');
        Route::patch('update/sort', 'Admin\Photos\ManagePhotosController@sort')->name('sort');
    });
});

// Páginas
Route::group(['prefix' => 'pages', 'as' => 'pages.'], function(){

    // Rutas para editar el content
    Route::group(['middleware' => ['permission:manage_pages_contents']], function(){
        Route::patch('sort' , 'Admin\Pages\ManagePagesContentsController@sort')->name('sort');
        Route::group(['prefix' => 'contents', 'as' => 'contents.'], function(){

            Route::resource('/', 'Admin\Pages\ManagePagesContentsController', [
                'only' 			=> ['index', 'edit'],
                'parameters'    => ['' => 'page_edit_content']
            ]);

            Route::resource('/', 'Admin\Pages\ManagePagesController', [
                'only' 			=> ['update'],
                'parameters'    => ['' => 'page_edit']
            ]);
        });

        Route::group(['prefix' => 'sections', 'as' => 'sections.' ], function(){
            Route::group(['middleware' => ['onlyajax'], 'as' => 'ajax.', 'prefix' => 'ajax'], function(){
                Route::group(['prefix' => '{page_section}'], function(){
                    Route::group(['as' => 'components.', 'prefix' => 'components'], function(){
                        Route::patch('sort', 'Admin\Pages\ManagePagesComponentsController@sort')->name('sort');

                        Route::resource('/', 'Admin\Pages\ManagePagesComponentsController', [
                            'only' 			=> ['store', 'update', 'destroy'],
                            'parameters'    => ['' => 'section_component'],
                        ]);
                    });
                });
            });
        });
    });

    // Rutas para el manejo de paginas
    Route::group(['middleware' => ['permission:manage_pages']], function(){

        // CRUD de paginas
        Route::resource('/', 'Admin\Pages\ManagePagesController',[
            'only' 			=> ['index', 'create', 'store', 'edit', 'update', 'destroy'],
            'parameters'    => ['' => 'page_edit']
        ]);

        Route::group(['as' => 'sections.'], function(){
            // Para asociar y sortear secciones de una pagina
            Route::group(['middleware' => ['onlyajax'], 'as' => 'ajax.', 'prefix' => '{page_edit}/sections'], function(){
                Route::patch('{page_section}/association', 'Admin\Pages\ManagePagesController@sectionAssociation')->name('association');
                Route::patch('sort', 'Admin\Pages\ManagePagesController@sort')->name('sort');
            });

            Route::group(['prefix' => 'sections'], function(){
                Route::get('/', 'Admin\Pages\ManagePagesSectionsController@indexView')->name('index');
                Route::group(['middleware' => ['onlyajax'], 'as' => 'ajax.', 'prefix' => 'ajax'], function(){
                    Route::resource('/', 'Admin\Pages\ManagePagesSectionsController', [
                        'only' 			=> ['index', 'store','update','destroy'],
                        'parameters'    => ['' => 'page_section']
                    ]);
                });
            });
        });
    });
});
