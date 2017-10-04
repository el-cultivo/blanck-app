<?php

namespace App\Http\Middleware\Cltvo;

use Closure;

class CltvoTestUrls
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
        if (!config("cltvo.dev_mode")) {
            if ($request->ajax() || $request->wantsJson()){
                return response('Unauthorized.', 403);
            } else {
                return abort(403);
            }
        }
        return $next($request);
    }
}
