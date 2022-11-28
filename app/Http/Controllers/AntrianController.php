<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Antrian;
use Illuminate\Http\Request;

class AntrianController extends Controller
{
    // 1 : Verifikasi
    // 2 : Antri
    // 3 : Tidak Hadir
    // 4 : Hadir
    // 5 : Selesai
    // 6 : Sudah Di Check Dokter
    // 7 : Cancel
    public function store(Request $request) {
        $credentials = $request->validate([
            'tanggal_antrian' => ['required','date']
        ]);
        $date = Carbon::createFromFormat('d F Y', $credentials['tanggal_antrian'])->format('Y-m-d');
        $credentials['tanggal_antrian'] = $date;
        $credentials['user_id'] = auth()->user()->id;
        $credentials['status'] = 1;
        $date_antrian = Antrian::where('user_id', auth()->user()->id)->where('tanggal_antrian', $date)->whereIn('status', [1,2]);
        if ($date_antrian->count() > 0) {
            return redirect()->route('dashboard')->withErrors(['Kamu memiliki jadwal antrian atau sudah membuat jadwal antrian.']);
        }
        if ($date < Carbon::now()->format('Y-m-d')) {
            return redirect()->route('dashboard')->withErrors(['Kamu hanya dapat membuat antrian pada hari ini atau tanggal setelah hari ini.']);
        }
        Antrian::create($credentials);
        return redirect()->route('dashboard')->with(['success' => 'Antrian berhasil ditambahkan, tunggu hingga admin memverifikasi.']);
    }
}
