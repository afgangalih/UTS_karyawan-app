<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JabatanModel extends Model
{
    protected $table = 'm_jabatan'; // <--- ini penting!
    protected $primaryKey = 'id';
    protected $guarded = [];
    public $timestamps = true;

    public function karyawan()
{
    return $this->hasMany(KaryawanModel::class, 'jabatan_id', 'id');
}

}
