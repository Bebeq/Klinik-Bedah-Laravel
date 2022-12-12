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
    public $tanggal_table;
    public $category = 'no';
    public $search_data;
    public $categoryAdd = 'no';
    public $id_add;
    public $tanggal_antrian;
    protected $updateQueryString = ['search','search_data'];
    public function updatingSearch() {
        $this->resetPage();
    }

    public function mount() {
        $this->tanggal_antrian = Carbon::now()->format('Y-m-d');
        $this->tanggal_table = Carbon::now()->format('Y-m-d');
    }
    public function render()
    {
        $users = null;
        if($this->search) {
            if($this->category == "nama") {
                $antrian = Antrian::whereHas('user', function (Builder $query) {
                    $query->where('name', 'like','%' . $this->search . '%');
                })->orderBy('tanggal_antrian','DESC')->orderBy('status')->orderBy('no','ASC')->latest()->whereIn('status', [2,3,4,5,6,7])->where('tanggal_antrian',$this->tanggal_table)->paginate(20);
            } elseif ($this->category == "no") {
                $antrian = Antrian::whereHas('user', function (Builder $query) {
                    $query->where('id', 'like','%' . $this->search . '%');
                })->orderBy('tanggal_antrian','DESC')->orderBy('status')->orderBy('no','ASC')->latest()->whereIn('status', [2,3,4,5,6,7])->where('tanggal_antrian',$this->tanggal_table)->paginate(20);
            } elseif ($this->category == "no_hp") {
                $antrian = Antrian::whereHas('user', function (Builder $query) {
                    $query->where('no_hp', 'like','%' . $this->search . '%');
                })->orderBy('tanggal_antrian','DESC')->orderBy('status')->orderBy('no','ASC')->latest()->whereIn('status', [2,3,4,5,6,7])->where('tanggal_antrian',$this->tanggal_table)->paginate(20);
            } elseif ($this->category == "nik") {
                $antrian = Antrian::whereHas('user', function (Builder $query) {
                    $query->where('nik', 'like','%' . $this->search . '%');
                })->orderBy('tanggal_antrian','DESC')->orderBy('status')->orderBy('no','ASC')->latest()->whereIn('status', [2,3,4,5,6,7])->where('tanggal_antrian',$this->tanggal_table)->paginate(20);
            } elseif ($this->category == "alamat") {
                $antrian = Antrian::whereHas('user', function (Builder $query) {
                    $query->where('alamat', 'like','%' . $this->search . '%');
                })->orderBy('tanggal_antrian','DESC')->orderBy('status')->orderBy('no','ASC')->latest()->whereIn('status', [2,3,4,5,6,7])->where('tanggal_antrian',$this->tanggal_table)->paginate(20);
            }
        } else {
            $antrian = Antrian::with(['user'])->orderBy('tanggal_antrian','DESC')->orderBy('status')->orderBy('no','ASC')->latest()->whereIn('status', [2,3,4,5,6,7])->where('tanggal_antrian',$this->tanggal_table)->paginate(20);
        }
        if($this->search_data) {
            if($this->categoryAdd == "nama") {
                $users = User::oldest()->where('name', 'like','%' . $this->search_data . '%')->orderBy('id','ASC')->where('role',1)->get();
            } elseif ($this->categoryAdd == "no") {
                $users = User::oldest()->where('id', 'like','%' . $this->search_data . '%')->orderBy('id','ASC')->where('role',1)->get();
            } elseif ($this->categoryAdd == "no_hp") {
                $users = User::oldest()->where('no_hp', 'like','%' . $this->search_data . '%')->orderBy('id','ASC')->where('role',1)->get();
            } elseif ($this->categoryAdd == "nik") {
                $users = User::oldest()->where('nik', 'like','%' . $this->search_data . '%')->orderBy('id','ASC')->where('role',1)->get();
            } elseif ($this->categoryAdd == "alamat") {
                $users = User::oldest()->where('alamat', 'like','%' . $this->search_data . '%')->orderBy('id','ASC')->where('role',1)->get();
            }
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
            'users' => $users,
            'pasien_first' => Antrian::oldest()->where('tanggal_antrian', Carbon::now()->format('Y-m-d'))->whereIn('status', [2])->first(),
            'total_count' => $total->total_count,
            'total_no' => $total->total_no,
            'total_antrian' => $total->total_antrian,
            'total_tidakhadir' => $total->total_tidakhadir,
            'total_selesai' => $total->total_selesai,
            'total_cancel' => $total->total_cancel,
        ]);
    }

    public function addAntrian() {
        $this->validate([
            'id_add' => ['required','numeric'],
            'tanggal_antrian' => ['required','date']
        ],[
            'id_add.required' => 'kamu belum memilih data'
        ]);
        $user = User::findOrFail($this->id_add);
        $date = $this->tanggal_antrian;
        $date_antrian = Antrian::where('user_id', $this->id_add)->where('tanggal_antrian', $date)->whereIn('status',[1,2]);
        $antrian_count = Antrian::where('tanggal_antrian', $date)->whereIn('status', ['2','3','4','5','6','7'])->count();
        $antrian = [
            'user_id' => $this->id_add,
            'status' => 2,
            'tanggal_antrian' => $date,
            'no' => $antrian_count + 1
        ];
        if ($date_antrian->count() > 0) {
            return session()->flash('errorAdd', 'User ini sudah memiliki jadwal antrian pada hari ini.');
        }
        if ($date < Carbon::now()->format('Y-m-d')) {
            return session()->flash('errorAdd', 'Kamu hanya dapat membuat antrian pada hari ini atau tanggal setelah hari ini.');
        }
        Antrian::create($antrian);
        $this->dispatchBrowserEvent('addHide');
        $this->reset(['id_add', 'search_data', 'tanggal_antrian']);
        $this->tanggal_antrian = Carbon::now()->format('Y-m-d');
        return session()->flash('success', 'Kamu berhasil mendaftarkan ' . $user->name . ' pada tanggal ' . $date . ' dan mendapat antrian nomor ' . $antrian['no']);
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
