<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DepartemenModel extends Model
{
    protected $table = 'm_departemen'; // Nama tabel di database

    protected $primaryKey = 'id'; // Primary key

    protected $fillable = [
        'kode_departemen',
        'nama_departemen',
    ];

    public function karyawan()
{
    return $this->hasMany(KaryawanModel::class, 'departemen_id', 'id');
}


    // Optional: jika kamu ingin mengatur agar tidak otomatis mengisi timestamps
    // public $timestamps = false;
}
