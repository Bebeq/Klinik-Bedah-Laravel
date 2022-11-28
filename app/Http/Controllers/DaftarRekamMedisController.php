<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Antrian;
use Illuminate\Http\Request;

class DaftarRekamMedisController extends Controller
{
    public function index() {
        return view('rekammedis',[
            // 'pasiens' => Antrian::latest()->where('tanggal_antrian', Carbon::now()->format('Y-m-d'))->paginate(20)
            'pasiens' => User::with(['antrian','rekam_medis'])->latest()->whereHas('antrian')->paginate(20),
        ]);
    }
}
