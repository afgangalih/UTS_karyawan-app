<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use App\Models\DepartemenModel;

class DepartemenController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Departemen',
            'list'  => ['Home' => url('/'), 'Departemen']
        ];

        return view('departemen.index', [
            'activeMenu' => 'departemen',
            'breadcrumb' => $breadcrumb
        ]);
    }

    public function list()
    {
        $data = DepartemenModel::all();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('aksi', function($departemen){
                return '
                    <div class="btn-group">
                        <a href="'.route('departemen.show', $departemen->id).'" class="btn btn-sm btn-info">Detail</a>
                        <a href="'.route('departemen.edit', $departemen->id).'" class="btn btn-sm btn-warning">Edit</a>
                        <form action="'.route('departemen.destroy', $departemen->id).'" method="POST" class="d-inline">
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
            'title' => 'Tambah Departemen',
            'list'  => ['Home' => url('/'), 'Departemen', 'Tambah']
        ];

        return view('departemen.create', [
            'activeMenu' => 'departemen',
            'breadcrumb' => $breadcrumb
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_departemen' => 'required|string|max:10|unique:m_departemen,kode_departemen',
            'nama_departemen' => 'required|string|max:100'
        ], [
            'kode_departemen.required' => 'Kode departemen wajib diisi.',
            'kode_departemen.string'   => 'Kode departemen harus berupa teks.',
            'kode_departemen.max'      => 'Kode departemen maksimal 10 karakter.',
            'kode_departemen.unique'   => 'Kode departemen sudah digunakan.',
    
            'nama_departemen.required' => 'Nama departemen wajib diisi.',
            'nama_departemen.string'   => 'Nama departemen harus berupa teks.',
            'nama_departemen.max'      => 'Nama departemen maksimal 100 karakter.',
        ]);
    
        DepartemenModel::create([
            'kode_departemen' => $request->kode_departemen,
            'nama_departemen' => $request->nama_departemen
        ]);
    
        return redirect()->route('departemen.index')
            ->with('success', 'Departemen berhasil ditambahkan');
    }
    

    public function show($id)
    {
        $departemen = DepartemenModel::find($id);

        if (!$departemen) {
            abort(404, 'Departemen tidak ditemukan');
        }

        $breadcrumb = (object) [
            'title' => 'Detail Departemen',
            'list'  => ['Home' => url('/'), 'Departemen', 'Detail']
        ];

        return view('departemen.show', [
            'departemen' => $departemen,
            'breadcrumb' => $breadcrumb,
            'activeMenu' => 'departemen'
        ]);
    }

    public function edit($id)
    {
        $departemen = DepartemenModel::find($id);

        if (!$departemen) {
            abort(404, 'Departemen tidak ditemukan');
        }

        $breadcrumb = (object) [
            'title' => 'Edit Departemen',
            'list'  => ['Home' => url('/'), 'Departemen', 'Edit']
        ];

        return view('departemen.edit', [
            'departemen' => $departemen,
            'breadcrumb' => $breadcrumb,
            'activeMenu' => 'departemen'
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kode_departemen' => "required|string|max:10|unique:m_departemen,kode_departemen,$id,id",
            'nama_departemen' => 'required|string|max:100'
        ]);

        DepartemenModel::where('id', $id)->update([
            'kode_departemen' => $request->kode_departemen,
            'nama_departemen' => $request->nama_departemen
        ]);

        return redirect()->route('departemen.index')
            ->with('success', 'Departemen berhasil diperbarui');
    }

    public function destroy($id)
    {
        $departemen = DepartemenModel::find($id);

        if (!$departemen) {
            abort(404, 'Departemen tidak ditemukan');
        }

        $departemen->delete();

        return redirect()->route('departemen.index')
            ->with('success', 'Departemen berhasil dihapus');
    }
}
