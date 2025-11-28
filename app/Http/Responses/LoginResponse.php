<?php

namespace App\Actions\Fortify;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
    public function toResponse($request)
    {
        $user = $request->user();

        // Admin
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        // Bidang E-Gov
        if ($user->role === 'bidang' && $user->bidang === 'egov') {
            return redirect()->route('bidang.dashboard');
        }

        // Bidang lain
        if ($user->role === 'bidang') {
            return redirect()->route('bidang.dashboard');
        }

        // Default user
        return redirect()->route('dashboard');
    }
}
