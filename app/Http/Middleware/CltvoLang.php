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
        $testLang = $request->segment(1);
        $available_langs = Config::get('app.available_langs');

        if( isset($available_langs[$testLang]) ) {
            session(['lang' => $testLang]);
        }

        if (session('lang')) {
            \App::setLocale( session('lang') );
            \Config::set('app.locale_prefix', session('lang') );
        }

        return $next($request);
    }
}
