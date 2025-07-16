<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserAdmin extends Model
{
    use HasFactory;

    protected $fillable = ['username', 'password', 'name'];

    protected $hidden = ['password'];

    public function jadwals()
    {
        return $this->hasMany(Jadwal::class);
    }
}
