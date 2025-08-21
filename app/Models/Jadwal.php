<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;

class Jadwal extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_admin_id',
        'nama_kegiatan',
        'jumlah_peserta',
        'ruang_id',
        'penanggung_jawab',
        'fungsi',
        'tanggal',
        'fasilitas',
        'catatan_pelaksanaan'
    ];
    

    /**
     * Relasi ke model Ruang
     */
    public function ruang()
    {
        return $this->belongsTo(Ruang::class);
    }

    /**
     * Relasi ke model User sebagai admin yang membuat jadwal
     */
    public function userAdmin()
    {
        return $this->belongsTo(User::class, 'user_admin_id');
    }

        // App\Models\Jadwal.php
    protected $casts = [
        'fasilitas' => 'array',
    ];


}
