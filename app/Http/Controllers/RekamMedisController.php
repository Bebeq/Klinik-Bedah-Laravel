<?php

namespace App\Http\Controllers;

use App\Models\Antrian;
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
        $credentials['created_id'] = auth()->user()->id;
        $credentials['user_id'] = Antrian::findOrFail($request->antrian_id)->user->id;
        RekamMedis::create($credentials);
        return redirect()->route('dashboard')->with(['success' => 'Rekam medis berhasil ditambahkan.']);
    }

    public function edit(Request $request) {
        $credentials = $request->validate([
            'id' => ['required'],
            'diagnosa' => ['required'],
            'keterangan' => ['nullable']
        ]);

        $rekammedis = RekamMedis::findOrFail($request->id);
        $rekammedis->diagnosa = $request->diagnosa;
        $rekammedis->keterangan = $request->keterangan;
        $rekammedis->save();
        return redirect()->route('dashboard')->with(['success' => 'Rekam medis berhasil diubah.']);
    }
}
