<?php

namespace App\Http\Controllers;

use App\Models\KaryawanModel;
use App\Models\DepartemenModel;
use App\Models\JabatanModel;
use App\Models\UserModel; // Impor UserModel untuk mengakses m_user
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class KaryawanController extends Controller
{

    
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Data Karyawan',
            'list' => ['Home', 'Karyawan']
        ];

        $page = (object) [
            'title' => 'Daftar karyawan yang terdaftar'
        ];

        $activeMenu = 'karyawan';
        $departemen = DepartemenModel::all();
        $jabatan = JabatanModel::all();
        $user = UserModel::all(); // Ambil semua pengguna untuk filter (opsional)

        return view('karyawan.index', compact('breadcrumb', 'page', 'activeMenu', 'departemen', 'jabatan', 'user'));
    }

    public function list(Request $request)
    {
        $karyawan = KaryawanModel::with(['departemen', 'jabatan', 'user']); // Sertakan relasi user

        if ($request->departemen_id) {
            $karyawan->where('departemen_id', $request->departemen_id);
        }

        if ($request->user_id) { // Tambahkan filter berdasarkan user_id (opsional)
            $karyawan->where('user_id', $request->user_id);
        }

        return DataTables::of($karyawan)
            ->addIndexColumn()
            ->addColumn('nama_departemen', function ($data) {
                return $data->departemen ? $data->departemen->nama_departemen : '-';
            })
            ->addColumn('nama_jabatan', function ($data) {
                return $data->jabatan ? $data->jabatan->nama_jabatan : '-';
            })
            ->addColumn('nama_user', function ($data) { // Tampilkan nama pengguna
                return $data->user ? $data->user->nama : '-';
            })
            ->addColumn('aksi', function ($data) {
                $btn = '<a href="' . url('/karyawan/' . $data->karyawan_id) . '" class="btn btn-info btn-sm">Detail</a> ';
                $btn .= '<a href="' . url('/karyawan/' . $data->karyawan_id . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> ';
                $btn .= '<form class="d-inline-block" method="POST" action="' . url('/karyawan/' . $data->karyawan_id) . '">'
                    . csrf_field()
                    . method_field('DELETE')
                    . '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Yakin ingin menghapus?\')">Hapus</button>'
                    . '</form>';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah Karyawan',
            'list' => ['Home', 'Karyawan', 'Tambah']
        ];
    
        $page = (object) [
            'title' => 'Form tambah data karyawan'
        ];
    
        $departemen = DepartemenModel::all();
        $jabatan = JabatanModel::all();
        $user = UserModel::all(); // Tetap gunakan $user
        $activeMenu = 'karyawan';
    
        return view('karyawan.create', compact('breadcrumb', 'page', 'departemen', 'jabatan', 'user', 'activeMenu'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:m_user,user_id', // Validasi user_id
            'nik' => 'required|unique:m_karyawan,nik',
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat' => 'required|string',
            'email' => 'required|email|max:255',
            'no_telepon' => 'required|string|max:255',
            'departemen_id' => 'required|exists:m_departemen,id',
            'jabatan_id' => 'required|exists:m_jabatan,id',
            'tanggal_masuk' => 'required|date',
        ]);

        KaryawanModel::create($request->all());

        return redirect()->route('karyawan.index')->with('success', 'Data berhasil ditambahkan.');
    }

    public function show($id)
    {
        $karyawan = KaryawanModel::with(['departemen', 'jabatan', 'user'])->findOrFail($id); // Sertakan relasi user
        $breadcrumb = (object) [
            'title' => 'Detail Karyawan',
            'list' => ['Home', 'Karyawan', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail karyawan'
        ];

        $activeMenu = 'karyawan';

        return view('karyawan.show', compact('karyawan', 'breadcrumb', 'page', 'activeMenu'));
    }

    public function edit($id)
    {
        $karyawan = KaryawanModel::findOrFail($id);
        $breadcrumb = (object) [
            'title' => 'Edit Karyawan',
            'list' => ['Home', 'Karyawan', 'Edit']
        ];

        $page = (object) [
            'title' => 'Form edit data karyawan'
        ];

        $departemen = DepartemenModel::all();
        $jabatan = JabatanModel::all();
        $user = UserModel::all(); // Ambil semua pengguna untuk dropdown
        $activeMenu = 'karyawan';

        return view('karyawan.edit', compact('karyawan', 'breadcrumb', 'page', 'departemen', 'jabatan', 'user', 'activeMenu'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required|exists:m_user,user_id', // Validasi user_id
            'nik' => 'required|unique:m_karyawan,nik,' . $id . ',karyawan_id',
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat' => 'required|string',
            'email' => 'required|email|max:255',
            'no_telepon' => 'required|string|max:255',
            'departemen_id' => 'required|exists:m_departemen,id',
            'jabatan_id' => 'required|exists:m_jabatan,id',
            'tanggal_masuk' => 'required|date',
        ]);

        $karyawan = KaryawanModel::findOrFail($id);
        $karyawan->update($request->all());

        return redirect()->route('karyawan.index')->with('success', 'Data berhasil diupdate.');
    }

    public function destroy($id)
    {
        $karyawan = KaryawanModel::findOrFail($id);
        $karyawan->delete();

        return redirect()->route('karyawan.index')->with('success', 'Data berhasil dihapus.');
    }
}