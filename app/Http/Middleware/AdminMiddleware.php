<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('login'); // Si non connecté
        }

        if (Auth::user()->role !== 'admin') {
            abort(403); // Accès refusé si ce n'est pas un admin
        }

        return $next($request);
    }
}
