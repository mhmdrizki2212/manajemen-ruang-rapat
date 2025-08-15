<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;

class Jadwal extends Model
{
    use HasFactory;

    protected $fillable = [
        'ruang_id',
        'user_admin_id',
        'nama_kegiatan',
        'fungsi',
        'tanggal',
        'jam_mulai',
        'jam_selesai'
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

    /**
     * Atribut tambahan untuk status real-time
     */
    public function getStatusAttribute()
    {
        $now = Carbon::now('Asia/Jakarta');
        $start = Carbon::parse("{$this->tanggal} {$this->jam_mulai}", 'Asia/Jakarta');
        $end = Carbon::parse("{$this->tanggal} {$this->jam_selesai}", 'Asia/Jakarta');

        if ($now->lt($start)) {
            return [
                'text'  => 'Belum Mulai',
                'class' => 'bg-red-100 text-red-600 px-2 py-0.5 rounded-full text-xs font-medium'
            ];
        } elseif ($now->between($start, $end)) {
            return [
                'text'  => 'Berlangsung',
                'class' => 'bg-blue-100 text-blue-600 px-2 py-0.5 rounded-full text-xs font-medium'
            ];
        } else {
            return [
                'text'  => 'Selesai',
                'class' => 'bg-green-100 text-green-600 px-2 py-0.5 rounded-full text-xs font-medium'
            ];
        }
    }
}
