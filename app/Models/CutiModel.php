<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CutiModel extends Model
{
    use HasFactory;

    protected $table = 't_cuti';
    protected $primaryKey = 'cuti_id';

    protected $fillable = [
        'karyawan_id',
        'tanggal_mulai',
        'tanggal_selesai',
        'jenis_cuti',
        'alasan',
        'status',
        'catatan_admin'
    ];

    public function karyawan()
    {
        return $this->belongsTo(KaryawanModel::class, 'karyawan_id');
    }
}
