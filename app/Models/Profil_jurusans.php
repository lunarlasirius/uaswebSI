<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Profil_jurusans extends Model
{
    use HasFactory;

    protected $table = 'profil_jurusans';

    protected $fillable = [
        'nama_jurusan',
        'visi',
        'misi',
        'sejarah',
        'sambutan_ketua',
        'nama_ketua',
        'foto_ketua',
        'logo_jurusan',
    ];
}
