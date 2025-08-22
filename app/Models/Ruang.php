<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ruang extends Model
{
    use HasFactory;

    // Field yang bisa diisi secara massal
    protected $fillable = [
        'nama',
        'lantai',
        'gedung_id',
        'img',
    ];

    /**
     * Relasi ke model Gedung
     * Satu ruang berada di satu gedung
     */
    public function gedung()
    {
        return $this->belongsTo(Gedung::class, 'gedung_id');
    }

    /**
     * Relasi ke model Jadwal
     * Satu ruang bisa memiliki banyak jadwal
     */
    public function jadwals()
    {
        return $this->hasMany(Jadwal::class, 'ruang_id');
    }

    // /**
    //  * Relasi ke model Fasilitas
    //  * Satu ruang bisa memiliki banyak fasilitas
    //  * dan fasilitas bisa digunakan di banyak ruang
    //  */
    // public function fasilitas()
    // {
    //     return $this->belongsToMany(Fasilitas::class, 'fasilitas_ruang', 'ruang_id', 'fasilitas_id');
    // }
}
