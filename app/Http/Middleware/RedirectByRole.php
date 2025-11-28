<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectByRole
{
    public function handle($request, Closure $next)
    {
        if (!Auth::check()) {
            return $next($request);
        }

        $user = Auth::user();

        // Arahkan sesuai role saat login ke /dashboard
        if ($request->is('dashboard')) {
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            if ($user->role === 'bidang') {
                return redirect()->route('bidang.dashboard');
            }
        }

        return $next($request);
    }
}
