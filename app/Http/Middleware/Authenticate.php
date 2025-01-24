<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class Authenticate
{
    public function handle(Request $request, Closure $next, string $role = '', ...$guards): Response
    {
        if (Auth::guard($guards)->guest()) {
            return redirect()->route('login');
        } else {
            if ($role=='') {
                return $next($request);
            }
            if (!$request->user()->hasRole($role)) {
                abort(403, 'No tienes permiso para acceder a esta página.');
            }
        }

        return $next($request);
    }
}
