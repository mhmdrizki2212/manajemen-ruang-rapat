<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Gedung extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'lokasi'];

    public function ruang()
    {
        return $this->hasMany(Ruang::class);
    }
}
