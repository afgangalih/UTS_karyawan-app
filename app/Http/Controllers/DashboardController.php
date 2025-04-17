<?php

namespace App\Http\Controllers;

use App\Models\DepartemenModel;
use App\Models\JabatanModel;
use App\Models\Karyawan;
use App\Models\Departemen;
use App\Models\Jabatan;
use App\Models\KaryawanModel;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function admin()
    {
        // Pastikan query mengembalikan data
        $departemenCounts = DepartemenModel::withCount(['karyawan' => function($query) {
           
        }])->get();
    
        $jabatanCounts = JabatanModel::withCount('karyawan')->get();
    
        return view('admin.dashboard', [
            'departemenCounts' => $departemenCounts,
            'jabatanCounts' => $jabatanCounts,
            'totalKaryawan' => KaryawanModel::count(),
            'totalDepartemen' => DepartemenModel::count(),
            'totalJabatan' => JabatanModel::count(),
            'activeMenu' => 'dashboard',
            'breadcrumb' => (object) [
                'title' => 'Dashboard',
                'list' => ['Home', 'Dashboard']
            ]
            // Data lainnya...
        ]);
    }

    public function karyawan()
    {
        $karyawan = auth()->user()->karyawan;
        return view('karyawan.dashboard', [
            'karyawan' => $karyawan,
            'activeMenu' => 'dashboard',
            'breadcrumb' => (object) [
                'title' => 'Dashboard Karyawan',
                'list' => ['Home', 'Dashboard']
            ]
        ]);
    }
}
