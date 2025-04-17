<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JabatanModel;
use Yajra\DataTables\Facades\DataTables;

class JabatanController extends Controller
{
    public function index()
    {
        $breadcrumb = (object)[
            'title' => 'Data Jabatan',
            'list' => ['Home', 'Jabatan']
        ];

        $page = (object)[
            'title' => 'Daftar Jabatan'
        ];

        $activeMenu = 'jabatan';

        return view('jabatan.index', compact('breadcrumb', 'page', 'activeMenu'));
    }

    public function list(Request $request)
    {
        $data = JabatanModel::query();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('aksi', function ($data) {
                $btn = '<a href="' . url('/jabatan/' . $data->id . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> ';
                $btn .= '<form class="d-inline" method="POST" action="' . url('/jabatan/' . $data->id) . '">'
                    . csrf_field() . method_field('DELETE') .
                    '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Hapus data?\')">Hapus</button></form>';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function create()
    {
        $breadcrumb = (object)[
            'title' => 'Tambah Jabatan',
            'list' => ['Home', 'Jabatan', 'Tambah']
        ];

        $page = (object)[
            'title' => 'Form Tambah Jabatan'
        ];

        $activeMenu = 'jabatan';

        return view('jabatan.create', compact('breadcrumb', 'page', 'activeMenu'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_jabatan' => 'required|unique:m_jabatan,kode_jabatan|max:10',
            'nama_jabatan' => 'required|max:100',
        ]);

        JabatanModel::create($request->all());

        return redirect('jabatan')->with('success', 'Data berhasil disimpan.');
    }

    public function edit($id)
    {
        $jabatan = JabatanModel::findOrFail($id);

        $breadcrumb = (object)[
            'title' => 'Edit Jabatan',
            'list' => ['Home', 'Jabatan', 'Edit']
        ];

        $page = (object)[
            'title' => 'Form Edit Jabatan'
        ];

        $activeMenu = 'jabatan';

        return view('jabatan.edit', compact('breadcrumb', 'page', 'activeMenu', 'jabatan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kode_jabatan' => 'required|max:10|unique:m_jabatan,kode_jabatan,' . $id . ',id',
            'nama_jabatan' => 'required|max:100',
        ]);

        JabatanModel::findOrFail($id)->update($request->all());

        return redirect('jabatan')->with('success', 'Data berhasil diupdate.');
    }

    public function destroy($id)
    {
        JabatanModel::findOrFail($id)->delete();

        return redirect('jabatan')->with('success', 'Data berhasil dihapus.');
    }
}
