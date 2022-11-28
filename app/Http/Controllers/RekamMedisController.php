<?php

namespace App\Http\Controllers;

use App\Models\RekamMedis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class RekamMedisController extends Controller
{
    public function store(Request $request) {
        $credentials = $request->validate([
            'antrian_id' => ['required'],
            'diagnosa' => ['required'],
            'keterangan' => ['nullable']
        ]);
        RekamMedis::create($credentials);
        return redirect()->route('dashboard')->with(['success' => 'Rekam medis berhasil ditambahkan.']);
    }
}
