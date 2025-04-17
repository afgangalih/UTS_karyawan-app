<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\UserModel;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        // Jika user sudah login, redirect sesuai role
        if (Auth::check()) {
            if (Auth::user()->level_id == 1) { // Admin
                return redirect()->route('admin.dashboard');
            } else { // Pegawai
                return redirect()->route('pegawai.dashboard');
            }
        }
        
        return view('auth.login');
    }
    public function login(Request $request)
{
    $request->validate([
        'username' => 'required',
        'password' => 'required',
    ]);

    if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
        $request->session()->regenerate();
        $user = Auth::user();

        // Return JSON response sesuai level_id
        if ($user->level_id == 1) {
            return response()->json([
                'status' => true,
                'message' => 'Login berhasil sebagai admin',
                'redirect' => route('admin.dashboard')
            ]);
        } else {
            return response()->json([
                'status' => true,
                'message' => 'Login berhasil sebagai karyawan',
                'redirect' => route('pegawai.dashboard')
            ]);
        }
    }

    // Login gagal, kirim response JSON error
    return response()->json([
        'status' => false,
        'message' => 'Username atau password salah',
        'msgField' => [
            'username' => ['Username salah atau belum terdaftar'],
            'password' => ['Password tidak sesuai'],
        ]
    ]);
}

    
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('login');
    }
}