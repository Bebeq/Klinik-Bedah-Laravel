<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Antrian;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Database\Eloquent\Builder;

class DaftarAntrian extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search;
    protected $updateQueryString = ['search'];
    public function updatingSearch() {
        $this->resetPage();
    }
    public function render()
    {
        if($this->search) {
            $antrian = Antrian::whereHas('user', function (Builder $query) {
                $query->where('name', 'like','%' . $this->search . '%')
                ->orWhere('no_hp', 'like','%' . $this->search . '%')
                ->orWhere('nik', 'like','%' . $this->search . '%')
                ->orWhere('alamat', 'like','%' . $this->search . '%');
            })->orderBy('tanggal_antrian','DESC')->orderBy('status')->orderBy('no','ASC')->latest()->whereIn('status', [2,3,4,5,6,7])
            ->paginate(20);
        } else {
            $antrian = Antrian::with(['user'])->orderBy('tanggal_antrian','DESC')->orderBy('status')->orderBy('no','ASC')->latest()->whereIn('status', [2,3,4,5,6,7])->paginate(20);
        }
        $total = Antrian::where('tanggal_antrian', Carbon::now()->format('Y-m-d'))
                ->selectRaw('COUNT(CASE WHEN status IN (2,3,4,5,6) THEN 1 END) AS total_count')
                ->selectRaw('COUNT(CASE WHEN status IN (3,4,5,6) THEN 1 END) AS total_no')
                ->selectRaw('COUNT(CASE WHEN status = 2 THEN 1 END) AS total_antrian')
                ->selectRaw('COUNT(CASE WHEN status = 3 THEN 1 END) AS total_tidakhadir')
                ->selectRaw('COUNT(CASE WHEN status = 5 THEN 1 END) AS total_selesai')
                ->selectRaw('COUNT(CASE WHEN status = 7 THEN 1 END) AS total_cancel')
                ->first();
        return view('livewire.daftar-antrian',[
            'antrians_verif_now' => Antrian::latest()->where('status', 1)->where('tanggal_antrian', Carbon::now()->format('Y-m-d'))->get(),
            'antrians_verif_expired' => Antrian::latest()->whereIn('status', [1])->where('tanggal_antrian','<' ,Carbon::now()->format('Y-m-d'))->get(),
            'antrians_expired' => Antrian::oldest()->whereIn('status', [2])->where('tanggal_antrian','<' ,Carbon::now()->format('Y-m-d'))->get(),
            'antrians' => $antrian,
            // 'antrians_info' => Antrian::latest()->where('tanggal_antrian', Carbon::now()->format('Y-m-d')),
            'users' => User::latest()->orderBy('id','ASC')->where('role',1)->get(),
            'pasien_first' => Antrian::oldest()->where('tanggal_antrian', Carbon::now()->format('Y-m-d'))->whereIn('status', [2])->first(),
            'total_count' => $total->total_count,
            'total_no' => $total->total_no,
            'total_antrian' => $total->total_antrian,
            'total_tidakhadir' => $total->total_tidakhadir,
            'total_selesai' => $total->total_selesai,
            // 'total_success' => Antrian::latest()->where('tanggal_antrian', Carbon::now()->format('Y-m-d'))->whereIn('status', [6])->count(),
            'total_cancel' => $total->total_cancel,
        ]);
    }
    public function addAntrian() {
        session()->flash('success', $this->id_add);
    }

    public function selesai() {
        $antrian = Antrian::oldest()->where('tanggal_antrian', Carbon::now()->format('Y-m-d'))->whereIn('status', [2])->first();
        if (empty($antrian)) {
            session()->flash('error', 'Tidak ada pasien yang tersedia.');
            return;
        }
        $antrian->status = 5;
        $antrian->save();
        session()->flash('success', 'Status pasien ' . $antrian->user->name . ' telah berubah menjadi selesai.');
    }

    public function tidakHadir() {
        $antrian = Antrian::oldest()->where('tanggal_antrian', Carbon::now()->format('Y-m-d'))->whereIn('status', [2])->first();
        if (empty($antrian)) {
            session()->flash('error', 'Tidak ada pasien yang tersedia.');
            return;
        }
        $antrian->status = 3;
        $antrian->save();
        session()->flash('success', 'Status pasien ' . $antrian->user->name . ' telah berubah menjadi tidak hadir.');
    }

    public function verifikasiPasien($id) {
        $antrian = Antrian::findOrFail($id);
        $antrian->status = 2;
        $date_now = Carbon::now()->format('Y-m-d');
        $antrian_count = Antrian::latest()->where('tanggal_antrian', $date_now)->whereIn('status', ['2','3','4','5','6','7'])->count();
        $antrian->no = $antrian_count + 1;
        $antrian->save();
        session()->flash('successVerif','Antrian pasien bernama ' . $antrian->user->name . ' berhasil diverifikasi pada tanggal ' . Carbon::createFromFormat('Y-m-d', $antrian->tanggal_antrian)->format('d F Y') .'.');
    }

    public function verifikasiCancel($id) {
        $antrian = Antrian::findOrFail($id);
        $antrian->status = 7;
        $antrian->save();
        session()->flash('successVerif', 'Antrian pasien bernama ' . $antrian->user->name . ' telah di cancel.');
    }

    public function verifikasiCancelSemua() {
        $date_now = Carbon::now()->format('Y-m-d');
        $antrians = Antrian::oldest()->where('tanggal_antrian', $date_now)->where('status', 1)->get();
        foreach ($antrians as $antrian) {
            $antrian->status = 7;
            $antrian->save();
        }
        session()->flash('successVerif', 'Semua verifikasi pasien telah dicancel.');
    }

    public function verifikasiSemua() {
        $date_now = Carbon::now()->format('Y-m-d');
        $antrians = Antrian::oldest()->where('tanggal_antrian', $date_now)->where('status', 1)->get();
        foreach ($antrians as $antrian) {
            $antrian->status = 2;
            $antrian->no = Antrian::latest()->where('tanggal_antrian', $date_now)->whereIn('status', ['2','3','4','5','6','7'])->count() + 1;
            $antrian->save();
        }
        session()->flash('successVerif', 'Semua verifikasi pasien telah diverifikasi.');
    }

    public function expiredCancel($id) {
        $antrian = Antrian::findOrFail($id);
        $antrian->status = 7;
        $antrian->save();
        session()->flash('successExp', 'Verifikasi expired pasien bernama ' . $antrian->user->name . ' telah di cancel.');
    }

    public function expiredCancelSemua() {
        $date_now = Carbon::now()->format('Y-m-d');
        $antrians = Antrian::oldest()->where('tanggal_antrian','<' ,Carbon::now()->format('Y-m-d'))->where('status', 1)->get();
        foreach ($antrians as $antrian) {
            $antrian->status = 7;
            $antrian->save();
        }
        session()->flash('successExp', 'Semua verifikasi expired telah dicancel.');
    }

    public function antrianExpTidakHadirSemua() {
        $date_now = Carbon::now()->format('Y-m-d');
        $antrians = Antrian::oldest()->where('tanggal_antrian','<' ,Carbon::now()->format('Y-m-d'))->where('status', 2)->get();
        foreach ($antrians as $antrian) {
            $antrian->status = 3;
            $antrian->save();
        }
        session()->flash('successAntrianExp', 'Semua antrian expired telah berubah menjadi Tidak Hadir.');
    }

    public function antrianExpTidakHadir($id) {
        $antrian = Antrian::findOrFail($id);
        $antrian->status = 3;
        $antrian->save();
        session()->flash('successAntrianExp', 'Antrian expired pasien bernama ' . $antrian->user->name . ' telah berubah menjadi tidak hadir.');
    }

    public function antrianExpSelesai($id) {
        $antrian = Antrian::findOrFail($id);
        $antrian->status = 5;
        $antrian->save();
        session()->flash('successAntrianExp', 'Antrian expired pasien bernama ' . $antrian->user->name . ' telah berubah menjadi selesai.');
    }
}
