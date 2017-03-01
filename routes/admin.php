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

// principles
Route::get('/', 'Admin\AdminController@index')->name('index');
Route::get('manuals', 'Admin\AdminController@manuals')->name('manuals');

//administrador de settings
Route::group(['middleware' => ['permission:system_config'] ,'prefix' => 'settings', "as" => "settings." ], function(){

    Route::resource('/','Admin\Settings\ManageSettingController',
        ['only' => [ 'index', 'update'],
        'parameters' => ['' => 'setting_key']
    ]);

});

//administracion de usuarios
Route::group(['middleware' => ['permission:manage_users'] ,'prefix' => 'users', "as" => "users."  ], function(){

    Route::resource('/','Admin\Users\ManageUserController',
        ['only' => ['index','create','edit','store','update'],
        'parameters' => ['' => 'user_editable']
    ]);

    Route::resource('/','Admin\Users\ManageUserController',
        ['only' => ["destroy"],
        'parameters' => ['' => 'erasable_user']
    ]);

    Route::get( "trash" , 'Admin\Users\ManageUserController@trash')->name("trash");
    Route::patch( "trash/{user_trashed}" , 'Admin\Users\ManageUserController@recovery')->name("recovery");
});

// media manager
Route::group(['middleware' => ['permission:manage_photos'] ,'prefix' => 'photos', "as" => "photos." ], function(){
    Route::group(['middleware' => ['permission:photos_view']  ], function(){
        Route::get( "/" , 'Admin\Photos\ManagePhotosController@indexView')->name("index");
    });

    Route::group(['middleware' => ['onlyajax'], "as" => "ajax."  ,'prefix' => 'ajax' ], function(){
        Route::resource('/','Admin\Photos\ManagePhotosController',
            ['only' => ["index",'edit','store','update',"destroy"],
            'parameters' => ['' => 'photo']
        ]);

        Route::post( "{photo}/associate" , 'Admin\Photos\ManagePhotosController@associate')->name("associate");
        Route::delete( "{photo}/disassociate" , 'Admin\Photos\ManagePhotosController@disassociate')->name("disassociate");

        Route::patch( "update/sort" , 'Admin\Photos\ManagePhotosController@sort')->name("sort");
    });
});

//paginas
Route::group(['prefix' => 'pages', "as" => "pages."  ], function(){

    // rutas para editar el content
    Route::group(['middleware' => ['permission:manage_pages_contents']  ], function(){
        Route::patch( "sort" , 'Admin\Pages\ManagePagesContentsController@sort')->name("sort");
        Route::group([ 'prefix' => 'contents', "as" => "contents."  ], function(){

            Route::resource('/','Admin\Pages\ManagePagesContentsController',[
                'only' 			=> ['index', 'edit'],
                'parameters'    => ['' => 'page_edit_content'],
            ]);
            Route::resource('/','Admin\Pages\ManagePagesController',[
                'only' 			=> ['update'],
                'parameters'    => ['' => 'page_edit'],
            ]);
        });
    });

    // rutas para el manejo de paginas
    Route::group(['middleware' => ['permission:manage_pages']], function(){

    // crud de paginas
        Route::resource('/','Admin\Pages\ManagePagesController',[
            'only' 			=> ['index','create','store', 'edit', 'update','destroy'],
            'parameters'    => ['' => 'page_edit'],
        ]);

        Route::group([ "as" => "sections."  ], function(){

            // para asociar y ortear secciones de una pagina
            Route::group(['middleware' => ['onlyajax'], 'as' => 'ajax.', 'prefix' => '{page_edit}/sections'  ], function(){
                Route::patch( '{page_section}/association' , 'Admin\Pages\ManagePagesController@sectionAssociation')->name('association');
                Route::patch( "sort" , 'Admin\Pages\ManagePagesController@sort')->name("sort");
            });

            Route::group([ 'prefix' => 'sections'], function(){

                Route::get( '/' , 'Admin\Pages\ManagePagesSectionsController@indexView')->name('index');

                Route::group(['middleware' => ['onlyajax'], 'as' => 'ajax.'  ,'prefix' => 'ajax' ], function(){
                    Route::resource('/','Admin\Pages\ManagePagesSectionsController',[
                        'only' 			=> ['index',/*'create','edit',*/'store','update','destroy'],
                        'parameters'    => ['' => 'page_section'],
                    ]);
                });

            });

        });

    });

});
