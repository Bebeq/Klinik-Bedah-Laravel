<?php

namespace App\Models;

use App\Models\RekamMedis;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Antrian extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    // 1 : Verifikasi
    // 2 : Antri
    // 3 : Tidak Hadir
    // 4 : Hadir
    // 5 : Selesai
    // 6 : Sudah Di Check Dokter

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function rekam_medis() {
        return $this->hasMany(RekamMedis::class);
    }
}
