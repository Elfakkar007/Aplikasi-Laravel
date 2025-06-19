<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;

class Kendaraan extends Model
{
    use HasFactory;

    protected $fillable = [
        'jenis',
        'tahun_pembuatan',
        'status',
        'stok',
    ];

    public function pemesanans()
    {
        return $this->hasMany(Pemesanan::class);
    }
}
