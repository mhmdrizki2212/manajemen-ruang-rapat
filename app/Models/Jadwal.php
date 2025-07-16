<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Jadwal extends Model
{
    use HasFactory;

    protected $fillable = [
        'ruang_id', 'user_admin_id',
        'nama_kegiatan', 'fungsi',
        'tanggal', 'jam_mulai', 'jam_selesai'
    ];

    public function ruang()
    {
        return $this->belongsTo(Ruang::class);
    }

    public function userAdmin()
    {
        return $this->belongsTo(UserAdmin::class);
    }
}
