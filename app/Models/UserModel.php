<?php
namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserModel extends Authenticatable
{
    use HasFactory;
    protected $table = 'm_user';
    protected $primaryKey = 'user_id';
    protected $fillable = [
        'nama',
        'username',
        'password',
        'level_id',
    ];
    public $timestamps = true;
    
    public function getAuthIdentifierName()
    {
        return 'username';
    }
    
    public function level()
    {
        return $this->belongsTo(LevelModel::class, 'level_id', 'level_id');
    }
    
    public function karyawan()
    {
        return $this->hasOne(KaryawanModel::class, 'user_id', 'user_id');
    }
    
    // Tambahkan method untuk cek role
    public function isAdmin()
    {
        return $this->level_id == 1;
    }
    
    public function isPegawai()
    {
        return $this->level_id == 3;
    }
    
    // Tambahkan juga method umum untuk cek role
    public function hasRole($role)
    {
        if ($role == 'admin') return $this->isAdmin();
        if ($role == 'pegawai') return $this->isPegawai();
        return false;
    }
}