<?php

namespace App\Models;

use App\Models\User;
use App\Models\Antrian;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RekamMedis extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function antrian() {
        return $this->belongsTo(Antrian::class);
    }

    public function user() {
        return $this->hasMany(User::class);
    }

}
