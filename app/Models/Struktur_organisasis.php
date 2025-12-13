<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Struktur_organisasis extends Model
{
    use HasFactory;

    protected $table = 'struktur_organisasis';
    protected $primaryKey = 'nidn';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'NIDN',
        'nama',
        'jabatan',
        'urutan',
        'parent_id',
    ];

    public function parent()
    {
        return $this->belongsTo(StrukturOrganisasi::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(StrukturOrganisasi::class, 'parent_id');
    }
}
