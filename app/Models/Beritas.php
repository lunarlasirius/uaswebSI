<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Beritas extends Model
{
    use HasFactory;

    protected $table = 'beritas';

    protected $fillable = [
        'judul',
        'slug',
        'gambar',
        'tanggal_publish',
        'isi',
        'penulis_id',
    ];

    protected $casts = [
        'tanggal_publish' => 'date',
    ];

    public function penulis()
    {
        return $this->belongsTo(Users::class, 'penulis_id');
    }
}
