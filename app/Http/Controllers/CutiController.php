<?php

namespace App\Http\Controllers;

use App\Models\CutiModel;
use App\Models\KaryawanModel;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;

class CutiController extends Controller
{
    public function index()
    {
        $page = (object)[
            'title' => 'Data Pengajuan Cuti',
        ];
    
        $breadcrumb = (object)[
            'title' => 'Data Pengajuan Cuti',
            'list' => ['Manajemen Cuti'] 
        ];
    
        $activeMenu = 'cuti';
        return view('cuti.index', compact('page', 'activeMenu', 'breadcrumb')); 
    }

    public function list(Request $request)
    {
        $cuti = CutiModel::with('karyawan');

        return DataTables::of($cuti)
            ->addIndexColumn()
            ->addColumn('nama_karyawan', fn($row) => $row->karyawan->nama ?? '-')
            ->addColumn('periode', fn($row) => Carbon::parse($row->tanggal_mulai)->translatedFormat('d F Y') . ' s/d ' . Carbon::parse($row->tanggal_selesai)->translatedFormat('d F Y'))
            ->addColumn('status', function($row) {
                if ($row->status === 'disetujui') return '<span class="badge badge-success"><i class="fa fa-check"></i> Disetujui</span>';
                if ($row->status === 'ditolak') return '<span class="badge badge-danger">Ditolak</span>';
                return '<span class="badge badge-warning">Pending</span>';
            })
            ->addColumn('aksi', function($row) {
                $button = '';
                if ($row->status === 'pending') {
                    // Tombol Setujui
                    $button .= '<form action="'.route('cuti.validasi', ['id' => $row->cuti_id]).'" method="POST" style="display:inline;">';
                    $button .= csrf_field();
                    $button .= '<input type="hidden" name="status" value="disetujui">';
                    $button .= '<button type="submit" class="btn btn-sm btn-success" onclick="return confirm(\'Setujui cuti ini?\')"><i class="fa fa-check"></i></button>';
                    $button .= '</form> ';
                    
                    // Tombol Tolak
                    $button .= '<form action="'.route('cuti.validasi', ['id' => $row->cuti_id]).'" method="POST" style="display:inline;">';
                    $button .= csrf_field();
                    $button .= '<input type="hidden" name="status" value="ditolak">';
                    $button .= '<button type="submit" class="btn btn-sm btn-danger" onclick="return confirm(\'Tolak cuti ini?\')"><i class="fa fa-times"></i></button>';
                    $button .= '</form> ';
                } else {
                    $button .= '<span class="text-muted">✔</span> ';
                }
                
                // Tombol Delete
                $button .= '<form action="'.route('cuti.destroy', ['cuti' => $row->cuti_id]).'" method="POST" style="display:inline;">';
                $button .= csrf_field();
                $button .= method_field('DELETE');
                $button .= '<button type="submit" class="btn btn-sm btn-danger" onclick="return confirm(\'Hapus cuti ini?\')"><i class="fa fa-trash"></i></button>';
                $button .= '</form>';
                
                return $button;
            })
            
            ->rawColumns(['status', 'aksi'])
            ->make(true);
    }

    public function create()
    {
        $page = (object)[
            'title' => 'Form Tambah Pengajuan Cuti',
            'breadcrumb' => ['Manajemen Cuti', 'Tambah'] // Ini tetap untuk keperluan lain, jika digunakan
        ];
        
        $breadcrumb = (object)[
            'title' => 'Form Tambah Pengajuan Cuti',
            'list' => ['Home', 'Manajemen Cuti', 'Tambah']
        ];
        
        $karyawan = KaryawanModel::all();
        $activeMenu = 'cuti';
        return view('cuti.create', compact('page', 'karyawan', 'activeMenu', 'breadcrumb')); // Tambahkan 'breadcrumb'
    }

    public function store(Request $request)
    {
        $request->validate([
            'karyawan_id' => 'required',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'jenis_cuti' => 'required|in:tahunan,sakit,izin',
            'alasan' => 'required|string',
        ]);

        CutiModel::create($request->all());

        return redirect()->route('cuti.index')->with('success', 'Pengajuan cuti berhasil disimpan');
    }

    public function validasi($id, Request $request)
    {
        $cuti = CutiModel::findOrFail($id);
    
        $request->validate([
            'status' => 'required|in:disetujui,ditolak',
            'catatan_admin' => 'nullable|string'
        ]);
    
        $cuti->update([
            'status' => $request->status,
            'catatan_admin' => $request->catatan_admin
        ]);
    
        return redirect()->route('cuti.index')->with('success', 'Status cuti berhasil diperbarui');
    }

    public function destroy($id)
{
    $cuti = CutiModel::findOrFail($id);
    $cuti->delete();

    return redirect()->route('cuti.index')->with('success', 'Cuti berhasil dihapus');
}
}

