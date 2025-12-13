<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Dosens extends Model
{
    use HasFactory;

    protected $table = 'dosens';

    protected $fillable = [
        'user_id',
        'nama',
        'nidn',
        'bidang_keahlian',
        'foto',
        'email',
        'no_hp',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function mahasiswasBimbingan()
    {
        return $this->hasMany(Mahasiswa::class, 'dosen_pembimbing_id');
    }
}