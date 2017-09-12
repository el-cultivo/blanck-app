# Cltvo Blank app

## Instalación de la parte del front
`npm i`
Luego es necesario ir a las carpetas `resources/assets/sass/` y `resources/assets/js/` y seguir los pasos de sus respectivos readmes. Finalmente para comprobar que todo funcione correctamente y el proyecto compile `gulp watch`

## Uso con Webpack

### Para el desarrollo
Webpack se puede usar para compilar los archivos de JS aprovechando la funcionalidad de Hot Module Replacement (HMR) que Webpack provee y que nos permite desarrollar JS sin tener que recagar la p'agina cada vez que salvamos el archivo.

Los comandos son los siguientes:

`npm run start` Compila archivos de JS asociados a `micorriza.js` y `micorriza-admin.js`
`npm run start:functions` Compila archivos de JS asociados únicamente a `micorriza.js`
`npm run start:admin-functions` Compila archivos de JS asociados únicamente a `micorriza-admin.js`

El segundo y el tercer comando son m'as rápidos

__Es importante notar que con estos comandos Webpack no crea ningún archivo en la carpeta `public` y todo sucede en el cache.__

### Para hacer un Build
`npm run build:dev` Compila y guarda el archivo en `public`
`npm run build:prod` Compila, minifica, realiza varias optmizaciones y guarda el archivo en `public`


### env

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
CLTVO_OPEN_SITE=false
CLTVO_OPEN_REGISTER=false
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
