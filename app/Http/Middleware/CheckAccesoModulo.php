<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckAccesoModulo
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $modulo)
    {
        $user = auth()->user();
        if ($user->modules->contains('IdModulo', $modulo)) {
            return $next($request);
        }
        
        return redirect()->route('home')->with('error', 'No tienes acceso a este módulo');
        
    }
}
