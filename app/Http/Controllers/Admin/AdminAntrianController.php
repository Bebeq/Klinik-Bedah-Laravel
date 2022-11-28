<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Antrian;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Foreach_;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;

class AdminAntrianController extends Controller
{
    // 1 : Verifikasi
    // 2 : Antri
    // 3 : Tidak Hadir
    // 4 : Hadir
    // 5 : Selesai
    // 6 : Sudah Di Check Dokter
    // 7 : Cancel
    public function index() {

        return view('Admin/antrian',[
            'antrians_verif_now' => Antrian::latest()->where('status', 1)->where('tanggal_antrian', Carbon::now()->format('Y-m-d'))->get(),
            'antrians_verif_expired' => Antrian::latest()->whereIn('status', [1])->where('tanggal_antrian','<' ,Carbon::now()->format('Y-m-d'))->get(),
            'antrians' => Antrian::orderBy('tanggal_antrian','ASC')->orderBy('status')->orderBy('no','ASC')->latest()->whereIn('status', [2,3,4,5,6,7])->paginate(20)->withQueryString(),
            'antrians_info' => Antrian::latest()->where('tanggal_antrian', Carbon::now()->format('Y-m-d')),
            'users' => User::latest()->orderBy('id','ASC')->where('role',1)->get(),
            'pasien_first' => Antrian::oldest()->where('tanggal_antrian', Carbon::now()->format('Y-m-d'))->whereIn('status', [2])->first(),
            'total_count' => Antrian::latest()->where('tanggal_antrian', Carbon::now()->format('Y-m-d'))->whereIn('status', [2,3,4,5,6])->count(),
            'total_no' => Antrian::latest()->where('tanggal_antrian', Carbon::now()->format('Y-m-d'))->whereIn('status', [3,4,5,6])->count(),
            'total_antrian' => Antrian::latest()->where('tanggal_antrian', Carbon::now()->format('Y-m-d'))->where('status', 2)->count(),
            'total_tidakhadir' => Antrian::latest()->where('tanggal_antrian', Carbon::now()->format('Y-m-d'))->where('status', 3)->count(),
            'total_selesai' => Antrian::latest()->where('tanggal_antrian', Carbon::now()->format('Y-m-d'))->where('status', 5)->count(),
            // 'total_success' => Antrian::latest()->where('tanggal_antrian', Carbon::now()->format('Y-m-d'))->whereIn('status', [6])->count(),
            'total_cancel' => Antrian::latest()->where('tanggal_antrian', Carbon::now()->format('Y-m-d'))->whereIn('status', [7])->count(),
        ]);
    }

    public function store(Request $request) {
        $credentials = $request->validate([
            'id' => ['required','numeric'],
            'tanggal_antrian' => ['required','date']
        ]);
        $user = User::findOrFail($request->id);
        $date = Carbon::createFromFormat('d F Y', $credentials['tanggal_antrian'])->format('Y-m-d');
        $date_antrian = Antrian::where('user_id', $credentials['id'])->where('tanggal_antrian', $date)->whereIn('status',[1,2]);
        $antrian_count = Antrian::where('tanggal_antrian', $date)->whereIn('status', ['2','3','4','5','6','7'])->count();
        $antrian = [
            'user_id' => $request->id,
            'status' => 2,
            'tanggal_antrian' => $date,
            'no' => $antrian_count + 1
        ];
        if ($date_antrian->count() > 0) {
            return redirect()->route('admin.antrian.index')->withErrors(['User ini sudah memiliki jadwal antrian pada hari ini.']);
        }
        if ($date < Carbon::now()->format('Y-m-d')) {
            return redirect()->route('admin.antrian.index')->withErrors(['Kamu hanya dapat membuat antrian pada hari ini atau tanggal setelah hari ini.']);
        }
        Antrian::create($antrian);
        return redirect()->route('admin.antrian.index')->with(['success' => 'Kamu berhasil mendaftarkan ' . $user->name . ' pada tanggal ' . $date . ' dan mendapat antrian nomor ' . $antrian['no']]);
    }

    public function verifikasiPasien(Request $request) {
        $credentials = $request->validate([
            'id' => ['required','numeric']
        ]);
        $antrian = Antrian::findOrFail($request->id);
        $antrian->status = 2;
        $date_now = Carbon::now()->format('Y-m-d');
        $antrian_count = Antrian::latest()->where('tanggal_antrian', $date_now)->whereIn('status', ['2','3','4','5','6','7'])->count();
        $antrian->no = $antrian_count + 1;
        $antrian->save();
        return redirect()->route('admin.antrian.index')->with(['successVerif' => 'Antrian pasien bernama ' . $antrian->user->name . ' berhasil diverifikasi pada tanggal ' . Carbon::createFromFormat('Y-m-d', $antrian->tanggal_antrian)->format('d F Y') .'.']);
    }

    public function next() {
        $antrian = Antrian::oldest()->where('tanggal_antrian', Carbon::now()->format('Y-m-d'))->whereIn('status', [2])->first();
        if (empty($antrian)) {
            return redirect()->route('admin.antrian.index')->withErrors(['Tidak ada pasien yang tersedia.']);
        }
        $antrian->status = 5;
        $antrian->save();
        return redirect()->route('admin.antrian.index')->with(['success' => 'Status pasien ' . $antrian->user->name . ' telah berubah menjadi selesai.']);
    }

    public function notComing() {
        $antrian = Antrian::oldest()->where('tanggal_antrian', Carbon::now()->format('Y-m-d'))->whereIn('status', [2])->first();
        if (empty($antrian)) {
            return redirect()->route('admin.antrian.index')->withErrors(['Tidak ada pasien yang tersedia.']);
        }
        $antrian->status = 3;
        $antrian->save();
        return redirect()->route('admin.antrian.index')->with(['success' => 'Status pasien ' . $antrian->user->name . ' telah berubah menjadi tidak hadir.']);
    }

    public function verifikasiSemua() {
        $date_now = Carbon::now()->format('Y-m-d');
        $antrians = Antrian::oldest()->where('tanggal_antrian', $date_now)->where('status', 1)->get();
        foreach ($antrians as $antrian) {
            $antrian->status = 2;
            $antrian->no = Antrian::latest()->where('tanggal_antrian', $date_now)->whereIn('status', ['2','3','4','5','6','7'])->count() + 1;
            $antrian->save();
        }
        return redirect()->route('admin.antrian.index')->with(['successVerif' => 'Semua antrian pada tanggal ' . Carbon::createFromFormat('Y-m-d', $antrian->tanggal_antrian)->format('d F Y') .' telah diverifikasi.']);
    }

    public function verifikasiCancel(Request $request) {
        $credentials = $request->validate([
            'id' => ['required','numeric']
        ]);
        $antrian = Antrian::findOrFail($request->id);
        $antrian->status = 7;
        $antrian->save();
        return redirect()->route('admin.antrian.index')->with(['successVerif' => 'Antrian pasien bernama ' . $antrian->user->name . ' telah di cancel.']);
    }

    public function verifikasiCancelSemua() {
        $date_now = Carbon::now()->format('Y-m-d');
        $antrians = Antrian::oldest()->where('tanggal_antrian', $date_now)->where('status', 1)->get();
        foreach ($antrians as $antrian) {
            $antrian->status = 7;
            $antrian->save();
        }
        return redirect()->route('admin.antrian.index')->with(['successVerif' => 'Semua antrian expired pada tanggal ' . Carbon::createFromFormat('Y-m-d', $antrian->tanggal_antrian)->format('d F Y') .' telah dicancel.']);
    }


    public function expiredCancel(Request $request) {
        $credentials = $request->validate([
            'id' => ['required','numeric']
        ]);
        $antrian = Antrian::findOrFail($request->id);
        $antrian->status = 7;
        $antrian->save();
        return redirect()->route('admin.antrian.index')->with(['successExp' => 'Antrian expired pasien bernama ' . $antrian->user->name . ' telah di cancel.']);
    }

    public function expiredCancelSemua() {
        $date_now = Carbon::now()->format('Y-m-d');
        $antrians = Antrian::oldest()->where('tanggal_antrian','<' ,Carbon::now()->format('Y-m-d'))->where('status', 1)->get();
        foreach ($antrians as $antrian) {
            $antrian->status = 7;
            $antrian->save();
        }
        return redirect()->route('admin.antrian.index')->with(['successExp' => 'Semua antrian expired telah dicancel.']);
    }
}
