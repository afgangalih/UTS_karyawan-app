<?php
namespace App\Http\Controllers;

use App\Models\LevelModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    // Menampilkan halaman awal user
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar User',
            'list' => ['Home', 'User']
        ];

        $page = (object) [
            'title' => 'Daftar user yang terdaftar dalam sistem'
        ];

        $activeMenu = 'user'; // set menu yang sedang aktif
        
        $level = LevelModel::all(); // ambil data level utk filter

        return view ('user.index', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'level' => $level,
            'activeMenu' => $activeMenu
        ]);
       
    }


    // Ambil data user dalam bentuk JSON untuk DataTables
    public function list(Request $request) {
     $users = UserModel::select('user_id', 'username', 'nama', 'level_id')
        ->with('level');

        // Filter data user berdasarkan level_id
        if ($request->level_id) {
            $users->where('level_id', $request->level_id);
        }

     return DataTables::of($users)
        // Menambahkan kolom index / nomor urut (default nama kolom: DT_RowIndex)
        ->addIndexColumn()
        ->addColumn('aksi', function ($user) {
            // Menambahkan kolom aksi
            $btn = '<a href="' . url('/user/' . $user->user_id) . '" class="btn btn-info btn-sm">Detail</a> ';
            $btn .= '<a href="' . url('/user/' . $user->user_id . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> ';
            $btn .= '<form class="d-inline-block" method="POST" action="' . url('/user/' . $user->user_id) . '">'
                . csrf_field() . method_field('DELETE') .
                '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button>
             </form>';
               return $btn;
         })
        ->rawColumns(['aksi']) // Memberitahu bahwa kolom aksi berisi HTML
        ->make(true);
    }

    public function create() {
        $breadcrumb = (object) [
            'title' => 'Tambah User',
            'list' => ['Home', 'User', 'Tambah User']
        
        
        ];

        $page = (object) [
            'title' => 'Tambah user baru'
        ];

        $level = LevelModel::all(); //ambil data level untuk ditampilkan di from
        $activeMenu = 'user'; // set menu yang sedang aktif

        return view('user.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'level' => $level, 'activeMenu' => $activeMenu]);
    }

    public function store (Request $request) {
        $request->validate([
            'username' => 'required|string|min:3|unique:m_user,username', // Hapus spasi setelah koma
            'nama' => 'required|string|max:100',
            'password' => 'required|min:5',
            'level_id' => 'required|integer'
        ]);
        

        UserModel::create([
            'username' => $request->username,
            'nama' => $request->nama,
            'password' => bcrypt($request->password),
            'level_id' => $request->level_id
        ]);

        return redirect('/user')->with('success', 'Data user berhasil disimpan');
    }

    public function show(string $id) {
        $user = UserModel::with('level')->find($id);
    
        // Jika user tidak ditemukan, redirect dengan error message
        if (!$user) {
            return redirect('/user')->with('error', 'Data yang Anda cari tidak ditemukan.');
        }
    
        $breadcrumb = (object) [
            'title' => 'Detail User',
            'list' => ['Home', 'User', 'Detail User']
        ];
    
        $page = (object) [
            'title' => 'Detail User'
        ];
    
        $activeMenu = 'user';
    
        return view('user.show', [
            'user' => $user,
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu
        ]);
        
    }

    public function edit(string $id) {
        $user = UserModel::find($id);
        $level = LevelModel::all();

        $breadcrumb = (object) [
            'title' => 'Edit Data User',
            'list' => ['Home', 'User', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit User'
        ];

        $activeMenu = 'user';
        return view('user.edit', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'user' => $user,
            'level' => $level,
            'activeMenu' => $activeMenu,
        ]);
    }

    public function update(Request $request, string $id)
{
    $request->validate([
        'username' => 'required|string|min:3|unique:m_user,username,' . $id . ',user_id',
        'nama' => 'required|string|max:100',
        'password' => 'nullable|min:5',
        'level_id' => 'required|integer'
    ]);

    $user = UserModel::findOrFail($id);
    $user->update([
        'username' => $request->username,
        'nama' => $request->nama,
        'password' => $request->password ? bcrypt($request->password) : $user->password,
        'level_id' => $request->level_id
    ]);

    return redirect('/user')->with('success', 'Data user berhasil diubah');
}

public function destroy(string $id) {
    $check = UserModel::find($id);
    if (!$check) {
        return redirect('/user')->with('error', 'Data user tidak ditemukan');
    }
    
    try {
        UserModel::destroy($id); //Hapus data level

        return redirect('/user')->with('success', 'Data user berhasil dihapus');
    } catch (\Illuminate\Database\QueryException $e) {
        // kalo error waktu hapus, kembali ke halaman dengan membawa pesan error
        return redirect('/user')->with('eror', 'Data user gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
    }
}


    // Ajax
    public function create_ajax(){
        $level = LevelModel::select('level_id', 'level_nama')->get();

        return view('user.create_ajax')
        ->with('level', $level);
    }

    

    
}