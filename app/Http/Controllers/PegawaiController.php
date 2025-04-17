<?php

namespace App\Http\Controllers;

use App\Models\KaryawanModel;
use Illuminate\Support\Facades\Auth;

class PegawaiController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:pegawai');
    }
    
    public function dashboard()
    {
        $breadcrumb = (object) [
            'title' => 'Dashboard Pegawai',
            'list' => ['Home', 'Dashboard']
        ];

        $page = (object) [
            'title' => 'Panel Kontrol Pegawai'
        ];

        $activeMenu = 'dashboard';
        
        // Ambil data karyawan yang terkait dengan user yang login
        $karyawan = KaryawanModel::where('user_id', Auth::id())->first();
        
        return view('pegawai.dashboard', compact('breadcrumb', 'page', 'activeMenu', 'karyawan'));
    }
}