<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class mata_kuliahs extends Model
{
    use HasFactory;

    protected $table = 'mata_kuliahs';

    protected $fillable = [
        'kode_mk',
        'nama_mk',
        'sks',
        'semester',
        'deskripsi',
    ];
}
