<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckPlantelAndAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if(!Auth::check()){
            return redirect('/')->with('error', 'Necesitas estar logueado para acceder a este contenido');
        }

        $user = Auth::user();

        if($request->route('aviso')){
            $aviso = $request->route('aviso');
            if (!$aviso->planteles->contains($user->plantel_id)) {
                return redirect('/')->with('error', 'No tienes permiso para acceder a este contenido');
            }
        }
        return $next($request);
    }
}
