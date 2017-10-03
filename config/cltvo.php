<?php

return array(

    /*
    |--------------------------------------------------------------------------
    | Open site
    |--------------------------------------------------------------------------
    |	When the open_site is flase the app show a splash page in the main route,
    |	and register routes are closed
    */

    'open_site' => env("CLTVO_OPEN_SITE", false),



	/*
    |--------------------------------------------------------------------------
    | Open register
    |--------------------------------------------------------------------------
    |	if false register routes are closed
    |
    */

    'open_register' => env("CLTVO_OPEN_REGISTER", false),


	/*
    |--------------------------------------------------------------------------
    | Cltvo test view
    |--------------------------------------------------------------------------
    |	when the dev mode is true exists the uri cltvo/ , the controller of this
	| find the view  'cltvo.'.config("cltvo.test_view")
    |
    */

    'test_view' => env("CLTVO_TEST_VIEW","test"),

	/*
	|--------------------------------------------------------------------------
	| Cltvo dev mode
	|--------------------------------------------------------------------------
	|	turns the app in cltvo dev mode
	|
	*/

	'dev_mode' => env("CLTVO_DEV_MODE",false),



	/*
	|--------------------------------------------------------------------------
	| Cltvo version assets
	|--------------------------------------------------------------------------
	|	if version assets is true the the app load css versioned
	|
	*/

	'version_assets' => env("CLTVO_VERSION_ASSETS",false),


	/*
    |--------------------------------------------------------------------------
    | Cltvo encryption key
    |--------------------------------------------------------------------------
    |	random string to enconde and decode emails for set firsttime password
    |
    */

    'encryption_key' => env("CLTVO_ENCRYPTION_KEY",'#&$sdfx2s7sffgg4'),

	/*
	|--------------------------------------------------------------------------
	| Cltvo base seed
	|--------------------------------------------------------------------------
	|	factor of the base seed, multiplies the number of dates in seed
	|
	*/

	'base_seed' => intval(env("CLTVO_BASE_SEED",1)),


	/*
	|--------------------------------------------------------------------------
	| Cltvo manual url
	|--------------------------------------------------------------------------
	|	url embed of cltvo playlist of the manual of this app
	|
	*/

	'manual_url' => env("CLTVO_MANUAL_URL"),
);
