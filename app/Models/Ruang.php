<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ruang extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'lantai', 'gedung_id'];

    public function gedung()
    {
        return $this->belongsTo(Gedung::class);
    }

    public function jadwal()
    {
        return $this->hasMany(Jadwal::class);
    }
}
