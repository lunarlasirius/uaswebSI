<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class prestasis extends Model
{
    use HasFactory;

    protected $table = 'prestases';

    protected $fillable = [
        'judul',
        'deskripsi',
        'tanggal',
        'tingkat',
        'kategori',
        'foto',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];
}
