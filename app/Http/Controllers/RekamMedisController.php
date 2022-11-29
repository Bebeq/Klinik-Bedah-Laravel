<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Antrian;
use App\Models\RekamMedis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class RekamMedisController extends Controller
{
    public function store(Request $request) {
        $credentials = $request->validate([
            'antrian_id' => ['nullable'],
            'diagnosa' => ['required'],
            'keterangan' => ['nullable'],
            'created_at' => ['nullable']
        ]);
        if (isset($credentials['created_at'])) {
            $date = Carbon::createFromFormat('d F Y', $credentials['created_at'])->format('Y-m-d');
            $credentials['created_at'] = $date;
        }
        $credentials['created_id'] = auth()->user()->id;
        $credentials['user_id'] = Antrian::findOrFail($request->antrian_id)->user->id;
        RekamMedis::create($credentials);
        return redirect()->back()->with(['success' => 'Rekam medis berhasil ditambahkan.']);
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
        return redirect()->back()->with(['success' => 'Rekam medis berhasil diubah.']);
    }

    public function destroy(Request $request) {
        $rekam_medis = RekamMedis::findOrFail($request->id);
        RekamMedis::destroy($rekam_medis->id);
        return redirect()->back()->with('success', 'Data Rekam Medis berhasil dihapus.');
    }
}
