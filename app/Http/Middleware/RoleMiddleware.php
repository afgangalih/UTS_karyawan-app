<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        
        $user = Auth::user();
        
        // Cek role
        if ($role == 'admin' && $user->level_id != 1) {
            return redirect()->route('pegawai.dashboard')
                ->with('error', 'Anda tidak memiliki akses ke halaman tersebut');
        }
        
        if ($role == 'pegawai' && $user->level_id != 3) {
            return redirect()->route('admin.dashboard')
                ->with('error', 'Anda tidak memiliki akses ke halaman tersebut');
        }
        
        return $next($request);
    }
}