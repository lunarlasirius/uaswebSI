<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;

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

    /*
    |--------------------------------------------------------------------------
    | ACCESSOR & MUTATOR ALIAS
    |--------------------------------------------------------------------------
    | Agar blade admin tetap bisa memakai:
    | - $prestasi->tahun
    | - $prestasi->keterangan
    | Walaupun kolom asli di database adalah:
    | - tanggal
    | - deskripsi
    */

    // =====================
    // ALIAS: tahun -> tanggal
    // =====================
    public function getTahunAttribute()
    {
        return $this->tanggal
            ? Carbon::parse($this->tanggal)->year
            : null;
    }

    public function setTahunAttribute($value)
    {
        $this->attributes['tanggal'] = $value
            ? $value . '-01-01'
            : null;
    }

    // ==========================
    // ALIAS: keterangan -> deskripsi
    // ==========================
    public function getKeteranganAttribute()
    {
        return $this->deskripsi;
    }

    public function setKeteranganAttribute($value)
    {
        $this->attributes['deskripsi'] = $value ?? '';
    }
}
