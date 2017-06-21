# Cltvo Blank app


## env

´´´
APP_ENV=
APP_DEBUG=
APP_KEY=

APP_NAME=
URL_SITE=

DB_CONNECTION
DB_HOST=
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=

CACHE_DRIVER=file
SESSION_DRIVER=file
QUEUE_DRIVER=sync

MAIL_DRIVER=
MAIL_HOST=
MAIL_PORT=
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_ENCRYPTION=

SEND_MAIL_AS=

CLTVO_MANUAL_URL="https://www.youtube.com/"

CLTVO_DEV_MODE=true
CLTVO_DEV_SEED=true
CLTVO_BASE_SEED=1

CLTVO_TEST_VIEW=

CLTVO_USER_NAME=
CLTVO_USER_FIRST_NAME=
CLTVO_USER_LAST_NAME=
CLTVO_USER_EMAIL=
CLTVO_USER_PASS=

CLTVO_ENCRYPTION_KEY=

´´´
## Pug
EL Blank App tiene soporte para pug dentro de los templates de blade.  

El paquete utilizado es https://github.com/BKWLD/laravel-pug y permite utilizar diferentes tipos de sintaxis, sólo pug, blade y pug, php y pug, y blade, php y pug.

Por lo cual es posible hacer cosas así dentro de los templates
```
@extends('layouts/admin')
@section('content')
div
	h1 hola
	<a href="#"><h2>{{'Adios'}}</h2></a>
@endsection
```

La documentación oficial de pug es https://pugjs.org/api/getting-started.html.

Para cualquier duda al respecto, consultar primero ambas documentaciones.

Pug permite el uso de HTML
