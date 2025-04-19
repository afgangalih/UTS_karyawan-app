<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\DepartemenController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CutiController;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', [WelcomeController::class, 'index']);

// Auth Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'admin'])->name('admin.dashboard');

    
    // Karyawan Routes (hanya bisa diakses admin)
    Route::resource('karyawan', KaryawanController::class);
    Route::get('/karyawan/list', [KaryawanController::class, 'list'])->name('karyawan.list');
    
    // Tambahkan route admin lainnya di sini
});

// Pegawai Routes
Route::middleware(['auth', 'role:pegawai'])->prefix('pegawai')->group(function () {
    Route::get('/dashboard', [PegawaiController::class, 'dashboard'])->name('pegawai.dashboard');
    
    // Tambahkan route pegawai lainnya di sini
});

// Redirect root ke login atau dashboard sesuai role
Route::get('/', function () {
    if (Auth::check()) {
        if (Auth::user()->level_id == 1) {
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->route('pegawai.dashboard');
        }
    }
    
    return redirect()->route('login');
});



Route::prefix('user')->group(function () {
    Route::post('/user/list', [UserController::class, 'list'])->name('user.list');
    Route::get('/', [UserController::class, 'index'])->name('user.index');
    Route::get('/create', [UserController::class, 'create'])->name('user.create');
    Route::post('/', [UserController::class, 'store'])->name('user.store');
    Route::get('/{id}', [UserController::class, 'show'])->name('user.show');
    Route::get('/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/{id}', [UserController::class, 'update'])->name('user.update');
    Route::delete('/{id}', [UserController::class, 'destroy'])->name('user.destroy');
});


// Level Route
// Route untuk DataTables AJAX
Route::post('/level/list', [LevelController::class, 'list'])->name('level.list');

// Route untuk CRUD Level (sudah mencakup index, create, store, show, edit, update, destroy)
Route::resource('level', LevelController::class);



Route::prefix('departemen')->group(function () {
    Route::get('/', [DepartemenController::class, 'index'])->name('departemen.index');
    Route::post('/list', [DepartemenController::class, 'list'])->name('departemen.list');
    Route::get('/create', [DepartemenController::class, 'create'])->name('departemen.create');
    Route::post('/', [DepartemenController::class, 'store'])->name('departemen.store');
    Route::get('/{id}', [DepartemenController::class, 'show'])->name('departemen.show');
    Route::get('/{id}/edit', [DepartemenController::class, 'edit'])->name('departemen.edit');
    Route::put('/{id}', [DepartemenController::class, 'update'])->name('departemen.update');
    Route::delete('/{id}', [DepartemenController::class, 'destroy'])->name('departemen.destroy');
});

Route::prefix('jabatan')->group(function () {
    Route::get('/', [App\Http\Controllers\JabatanController::class, 'index']);
    Route::get('/create', [App\Http\Controllers\JabatanController::class, 'create']);
    Route::post('/', [App\Http\Controllers\JabatanController::class, 'store']);
    Route::get('/{id}/edit', [App\Http\Controllers\JabatanController::class, 'edit']);
    Route::put('/{id}', [App\Http\Controllers\JabatanController::class, 'update']);
    Route::delete('/{id}', [App\Http\Controllers\JabatanController::class, 'destroy']);
    Route::post('/list', [App\Http\Controllers\JabatanController::class, 'list'])->name('jabatan.list');
});





Route::prefix('karyawan')->group(function () {
    Route::get('/', [KaryawanController::class, 'index'])->name('karyawan.index');
    Route::post('/list', [KaryawanController::class, 'list'])->name('karyawan.list');
    Route::get('/create', [KaryawanController::class, 'create'])->name('karyawan.create');
    Route::post('/', [KaryawanController::class, 'store'])->name('karyawan.store');
    Route::get('/{id}', [KaryawanController::class, 'show'])->name('karyawan.show');
    Route::get('/{id}/edit', [KaryawanController::class, 'edit'])->name('karyawan.edit');
    Route::put('/{id}', [KaryawanController::class, 'update'])->name('karyawan.update');
    Route::delete('/{id}', [KaryawanController::class, 'destroy'])->name('karyawan.destroy');
});


Route::prefix('cuti')->group(function () {
    Route::get('/', [CutiController::class, 'index'])->name('cuti.index');
    Route::post('/', [CutiController::class, 'store'])->name('cuti.store'); // Changed from '/store'
    Route::post('/list', [CutiController::class, 'list'])->name('cuti.list');
    Route::get('/create', [CutiController::class, 'create'])->name('cuti.create');
    //Route::post('/validasi/{id}', [CutiController::class, 'validasi'])->name('cuti.validasi');
    Route::post('/cuti/{id}/validasi', [CutiController::class, 'validasi'])->name('cuti.validasi');
    Route::delete('/cuti/{cuti}', [CutiController::class, 'destroy'])->name('cuti.destroy');
});





