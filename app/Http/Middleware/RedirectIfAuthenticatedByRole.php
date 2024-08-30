<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticatedByRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        Log::info('Redireccionando usuario:', ['user_id' => $request->user()->id, 'role' => $request->user()->roles]);
        // Check if user is authenticated
        if ($request->user()) {
            // Check if user has the 'student' role (ID 4)
            if ($request->user()->roles->contains('id', 4)) {
                return redirect()->route('student.account');
            }

            // Otherwise, redirect admin users to the admin dashboard
            if ($request->user()->is_admin == 1 || $request->user()->roles->contains('name', 'Administrador')) {
                return redirect('/admin');
            }
        }

        // If no user is authenticated, continue with the request
        return $next($request);
    }
}
