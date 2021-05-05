<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class isEtudiant
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if($request->user()->isEtudiant()) {
            return $next($request);
        }
        abort(403,'Vous n\'êtes pas un étudiant');
    }
}
