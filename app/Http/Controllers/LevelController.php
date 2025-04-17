<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use App\Models\LevelModel; // Add this line to use the Eloquent model

class LevelController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Level Karyawan',
            'list'  => ['Home' => url('/'), 'Level Karyawan']
        ];
    
        return view('level.index', [
            'activeMenu' => 'level-karyawan',
            'breadcrumb' => $breadcrumb
        ]);
    }
    
    public function list()
    {
        $data = LevelModel::all(); // Changed to use Eloquent
    
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('aksi', function($level){
                return '
                    <div class="btn-group">
                        <a href="'.route('level.show', $level->level_id).'" class="btn btn-sm btn-info">Detail</a>
                        <a href="'.route('level.edit', $level->level_id).'" class="btn btn-sm btn-warning">Edit</a>
                        <form action="'.route('level.destroy', $level->level_id).'" method="POST" class="d-inline">
                            '.csrf_field().method_field("DELETE").'
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm(\'Yakin hapus data?\')">Hapus</button>
                        </form>
                    </div>
                ';
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah Level Karyawan',
            'list'  => ['Home' => url('/'), 'Level Karyawan', 'Tambah']
        ];

        return view('level.create', [
            'activeMenu' => 'level-karyawan',
            'breadcrumb' => $breadcrumb
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_level' => 'required|string|max:10|unique:m_level,kode_level',
            'nama_level' => 'required|string|max:100'
        ]);

        LevelModel::create([ // Using Eloquent
            'kode_level' => $request->kode_level,
            'nama_level' => $request->nama_level
        ]);

        return redirect()->route('level.index')
            ->with('success', 'Level karyawan berhasil ditambahkan');
    }

    public function show($id)
    {
        $level = LevelModel::find($id); // Using Eloquent

        if (!$level) {
            abort(404, 'Level tidak ditemukan');
        }

        $breadcrumb = (object) [
            'title' => 'Detail Level Karyawan',
            'list'  => ['Home' => url('/'), 'Level Karyawan', 'Detail']
        ];

        return view('level.show', [
            'level' => $level,
            'breadcrumb' => $breadcrumb,
            'activeMenu' => 'level-karyawan'
        ]);
    }

    public function edit($id)
    {
        $level = LevelModel::find($id); // Using Eloquent

        if (!$level) {
            abort(404, 'Level tidak ditemukan');
        }

        $breadcrumb = (object) [
            'title' => 'Edit Level Karyawan',
            'list'  => ['Home' => url('/'), 'Level Karyawan', 'Edit']
        ];

        return view('level.edit', [
            'level' => $level,
            'breadcrumb' => $breadcrumb,
            'activeMenu' => 'level-karyawan'
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kode_level' => "required|string|max:10|unique:m_level,kode_level,$id,level_id",
            'nama_level' => 'required|string|max:100'
        ]);

        LevelModel::where('level_id', $id)->update([ // Using Eloquent
            'kode_level' => $request->kode_level,
            'nama_level' => $request->nama_level
        ]);

        return redirect()->route('level.index')
            ->with('success', 'Level karyawan berhasil diperbarui');
    }

    public function destroy($id)
    {
        $level = LevelModel::find($id); // Using Eloquent
        
        if (!$level) {
            abort(404, 'Level tidak ditemukan');
        }

        $level->delete();

        return redirect()->route('level.index')
            ->with('success', 'Level karyawan berhasil dihapus');
    }
}