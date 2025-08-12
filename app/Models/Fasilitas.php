<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class fasilitas extends Model
{
    public function ruangs()
    {
        return $this->belongsToMany(Ruang::class, 'fasilitas_ruang');
    }

}
