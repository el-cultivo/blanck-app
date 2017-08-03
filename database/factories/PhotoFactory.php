<?php

use App\Models\Photo;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/**
 * factory photos
 */
$factory->define(Photo::class, function ($faker) use ($factory) {
    return [
            'filename' => $faker->unique()->slug
        ,   'type'      => ""
    ];
});
