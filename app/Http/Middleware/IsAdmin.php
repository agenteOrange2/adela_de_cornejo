<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
    // Verifica si el usuario tiene el rol de estudiante
    if ($request->user()->roles->contains('id', 4)) {
        return redirect('/mi-cuenta');
    }

    // Verifica si el usuario es administrador
    if ($request->user()->is_admin != 1) {
        return redirect('/');
    }

    return $next($request);
    }
}
