<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Check if user is authenticated first
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Then check if user is admin
        if (!Auth::user()->is_admin) {
            abort(403, 'Access denied. Admin privileges required.');
        }

        return $next($request);
    }
}
