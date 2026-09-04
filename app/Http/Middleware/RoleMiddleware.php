<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        dd([
            'user' => auth()->user()->email,
            'role_received' => $role,
            'user_roles' => auth()->user()->roles->pluck('name')->toArray(),
        ]);

        return $next($request);
    }
}