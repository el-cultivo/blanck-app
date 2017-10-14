<?php

namespace App\Http\Middleware;

use Closure;
use Config ;

class CltvoLang
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $testLang = $request->segment(1); // requiere actualizacion 
        $available_langs = Config::get('app.available_langs');

        if( isset($available_langs[$testLang]) ) {
            session(['cltvo_lang' => $testLang]);
        }

        if (session('cltvo_lang')) {
            \App::setLocale( session('cltvo_lang') );
            \Config::set('app.locale_prefix', session('cltvo_lang') );
        }

        return $next($request);
    }
}
