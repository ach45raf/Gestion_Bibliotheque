<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // L'utilisateur n'est pas connecté
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // L'utilisateur n'a pas le rôle User
        if (Auth::user()->role !== 'user') {
            abort(403, 'Accès refusé');
        }

        return $next($request);
    }
}
