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

    public static function index() {
        $total = Antrian::where('tanggal_antrian', Carbon::now()->format('Y-m-d'))
                ->selectRaw('COUNT(CASE WHEN status IN (2,3,4,5,6) THEN 1 END) AS total_count')
                ->selectRaw('COUNT(CASE WHEN status IN (3,4,5,6) THEN 1 END) AS total_no')
                ->selectRaw('COUNT(CASE WHEN status = 2 THEN 1 END) AS total_antrian')
                ->selectRaw('COUNT(CASE WHEN status = 3 THEN 1 END) AS total_tidakhadir')
                ->selectRaw('COUNT(CASE WHEN status = 5 THEN 1 END) AS total_selesai')
                ->selectRaw('COUNT(CASE WHEN status = 7 THEN 1 END) AS total_cancel')
                ->first();
        return view('Pasien/accessAntrian',[
            'antrians' => Antrian::latest()->where('user_id', auth()->user()->id)->whereIn('status',[1,2])->get(),
            'antrian_now_pending' => Antrian::latest()->where('tanggal_antrian', Carbon::now()->format('Y-m-d'))->where('user_id', auth()->user()->id)->whereIn('status',[1])->first(),
            'antrian_now_verif' => Antrian::latest()->where('tanggal_antrian', Carbon::now()->format('Y-m-d'))->where('user_id', auth()->user()->id)->whereIn('status',[2])->first(),
            'total_antrian' => $total->total_antrian,
            'total_no' => $total->total_no,
            'total_tidakhadir' => $total->total_tidakhadir,
            'total_selesai' => $total->total_selesai,
            'total_cancel' => $total->total_cancel,
        ]);
    }
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
