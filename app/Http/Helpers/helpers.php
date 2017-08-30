<?php
/**
 * verifica que si la  futa contiene el string buscado
 * @param  string  $page_slug slug de la pagina a pasar
 * @return boolean            si se encuentra en la fruta o no
 */
function is_page($route_name)
{
    return Route::currentRouteName() == $route_name;
}

/**
 * verifica que si la  futa contiene el string buscado
 * @param  string  $page_slug slug de la pagina a pasar
 * @return boolean            si se encuentra en la fruta o no
 */
function in_pages(array $route_names)
{
    return in_array(Route::currentRouteName(), $route_names);
}

/**
 * verifica que si la  futa contiene el string buscado
 * @param  string  $page_slug slug de la pagina a pasar
 * @return boolean            si se encuentra en la fruta o no
 */
function is_exact_page($route_name,array $parameters)
{
    return Request::url() == route($route_name,$parameters);
}

/**
 * encrypta el mail
 * @param  string $mail        mail encriptasrse
 * @return string              valor encriptado
 */
 function cltvoMailEncode($mail)
 {
     $iv = getIVKey();

     $key = config( "cltvo.encryption_key");

     return  base64url_encode( openssl_encrypt( $mail, Config::get('app.cipher'), md5($key), OPENSSL_RAW_DATA, $iv));
 }


/**
 * desencrypta el mail encryptado con la la funcion cltvoMailEnconde
 * @param  string $encodedMail mail encryptado con la la funcion cltvoMailEnconde
 * @return string              valor desencriptado
 */
 function cltvoMailDecode($mail_encoded)
 {
     $iv = getIVKey();

     $key = config( "cltvo.encryption_key");

     return openssl_decrypt( base64url_decode($mail_encoded), Config::get('app.cipher'), md5($key), OPENSSL_RAW_DATA, $iv);
 }

 function getIVKey()
{
    $app_key    = config('app.key');
    $cipher     = Config::get('app.cipher');
    $iv_lenght  = openssl_cipher_iv_length($cipher);
    $iv_base64  = explode(':', $app_key)[1];
    $iv         = base64_decode($iv_base64);

    return substr($iv, $iv_lenght);
}

function base64url_encode($data) {
  return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
}

function base64url_decode($data) {
  return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT));
}


/**
 * coleccion con la que vamos a traer elemntos aleatorios
 * @param  IlluminateDatabaseEloquentCollection $Colection coleccion de elenntos
 * @return IlluminateDatabaseEloquentCollection coleccion de elemntos aleatorios
 */
function getRandomElements(Illuminate\Database\Eloquent\Collection $Colection)
{

    $ColectionRandom = new Illuminate\Database\Eloquent\Collection ;

    $ColectionRandNumber = rand( 0, $Colection->count() ) ;

    if ( $ColectionRandNumber > 0 ) {

        $ColectionRandom = $Colection->random( $ColectionRandNumber ) ;

        if ( get_class($ColectionRandom) != "Illuminate\Database\Eloquent\Collection" ) {
            $ColectionRandom = (new Illuminate\Database\Eloquent\Collection)->add($ColectionRandom) ;
        }

    }

    return  $ColectionRandom;
}


function csvToArray($filename='', $delimiter=','){

    if(!file_exists($filename) || !is_readable($filename))
        return FALSE;

    $counter = 0;
    $header = NULL;
    $data = [];

    if ( ( $handle = fopen($filename, 'r') ) !== FALSE ){

        while ( ( $row = fgetcsv($handle, 1000, $delimiter) ) !== FALSE){

            if(!$header)
                $header = $row;
            else
                $data[] = array_combine($header, $row);

        }
        fclose($handle);
    }
    return $data;
}


function cltvoCurrentLanguageIso()
{
	return session('Lang') ? session('Lang') : config("app.locale"); 
}
