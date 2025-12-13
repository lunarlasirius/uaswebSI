<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswas extends Model
{
    protected $table = 'mahasiswas';

    protected $fillable = [
        'user_id',
        'foto',
        'npm',
        'nama',
        'alamat',
        'angkatan',
        'dosen_pembimbing', 
        'no_hp', 
    ];

    public function user()
    {
        return $this->belongsTo(Users::class, 'user_id');
    }
}
