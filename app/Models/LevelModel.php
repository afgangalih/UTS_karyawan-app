<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LevelModel extends Model
{
    use HasFactory;

    protected $table = 'm_level';
    protected $primaryKey = 'level_id'; // Dipaksa menggunakan 'level_id' sebagai PK
    protected $fillable = ['level_id', 'kode_level', 'nama_level'];
    public $timestamps = true;

    // Jika kolom PK bukan auto-increment, tambahkan:
    // public $incrementing = false;
    
    // Jika PK bukan integer (misal UUID):
    // protected $keyType = 'string';
}