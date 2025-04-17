<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KaryawanModel extends Model
{
    use HasFactory;

    protected $table = 'm_karyawan';
    protected $primaryKey = 'karyawan_id';
    protected $guarded = [];

    public function departemen()
    {
        return $this->belongsTo(DepartemenModel::class, 'departemen_id', 'id');
    }

    public function jabatan()
    {
        return $this->belongsTo(JabatanModel::class, 'jabatan_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(UserModel::class, 'user_id', 'user_id');
    }
}
