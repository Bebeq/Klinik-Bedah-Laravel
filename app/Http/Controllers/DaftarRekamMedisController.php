<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Antrian;
use App\Models\RekamMedis;
use Illuminate\Http\Request;

class DaftarRekamMedisController extends Controller
{
    public function index() {
        return view('Dokter/DaftarPasien',[
            // 'pasiens' => Antrian::latest()->where('tanggal_antrian', Carbon::now()->format('Y-m-d'))->paginate(20)
            'pasiens' => User::with(['antrian','rekam_medis'])->latest()->whereHas('antrian')->paginate(20),
        ]);
    }

    public function store(Request $request) {
        $credentials = $request->validate([
            'user_id' => ['required'],
            'diagnosa' => ['required'],
            'keterangan' => ['nullable'],
            'created_at' => ['nullable']
        ]);
        if (isset($credentials['created_at'])) {
            $date = Carbon::createFromFormat('d F Y', $credentials['created_at'])->format('Y-m-d');
            $credentials['created_at'] = $date;
        }
        $credentials['created_id'] = auth()->user()->id;
        RekamMedis::create($credentials);
        return redirect()->back()->with(['success' => 'Rekam medis berhasil ditambahkan.']);
    }

    public function show($slug) {
        $user = User::findOrFail($slug);
        if ($user->count() == 0) {
            return "Error";
        } else {
            return view('Dokter.RekamMedisDetails', [
                'pasiens' => $user
            ]);
        }
    }
}
