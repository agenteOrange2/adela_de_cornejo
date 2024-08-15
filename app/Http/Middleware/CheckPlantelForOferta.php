<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckPlantelForOferta
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Verifica si el usuario está autenticado
        if (!Auth::check()) {
            return redirect('/')->with('error', 'Necesitas estar logueado para acceder a este contenido');
        }

        $user = Auth::user();

        // Verifica si el usuario tiene acceso al plantel
        $plantelId = $request->query('plantel_id');
        if (!$user->plantel_id || $user->plantel_id != $plantelId) {
            return redirect('/')->with('error', 'No tienes permiso para acceder a este contenido');
        }

        return $next($request);
    }
}
