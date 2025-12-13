<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Users extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users'; 

    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function mahasiswa()
    {
        return $this->hasOne(Mahasiswas::class, 'user_id');
    }

    public function dosen()
    {
        return $this->hasOne(Dosens::class, 'user_id');
    }

    public function beritas()
    {
        return $this->hasMany(Beritas::class, 'penulis_id');
    }
}
