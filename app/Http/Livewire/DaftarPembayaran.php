<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\RiwayatPembayaran;
use Illuminate\Database\Eloquent\Builder;

class DaftarPembayaran extends Component
{
    public $tanggal_table;
    public $search;
    public $category = 'no_pembayaran';
    
    public $tanggal_pembayaran;
    public $biaya_dokter = 0;
    public $biaya_obat = 0;
    public $biaya_tindakan = 0;
    public $biaya_lain = 0;
    public $biaya_jumlah;
    public $id_add;
    public $id_edit;
    public $id_delete;
    public $name_delete;

    public $search_data;
    public $categoryAdd = 'no';


    public function setEdit($id) {
        $this->reset(['id_add', 'tanggal_pembayaran', 'biaya_dokter','biaya_tindakan','biaya_obat','biaya_lain','biaya_jumlah', 'search_data']);
        $pembayaran = RiwayatPembayaran::findOrFail($id);
        $this->categoryAdd = 'no';
        $this->id_edit = $pembayaran->id;
        $this->id_add = $pembayaran->user->id;
        $this->tanggal_pembayaran = $pembayaran->tanggal_pembayaran;
        $this->search_data = $pembayaran->user->id;
        $this->biaya_dokter = $pembayaran->biaya_dokter;
        $this->biaya_obat = $pembayaran->biaya_obat;
        $this->biaya_tindakan = $pembayaran->biaya_tindakan;
        $this->biaya_lain = $pembayaran->biaya_lain;
        $this->biaya_jumlah = $pembayaran->biaya_jumlah;
    }

    public function addPembayaran() {
        $credentials = $this->validate([
            'id_add' => ['required','numeric'],
            'tanggal_pembayaran' => ['required','date'],
            'biaya_dokter' => ['nullable', 'integer'],
            'biaya_tindakan' => ['nullable', 'integer'],
            'biaya_obat' => ['nullable', 'integer'],
            'biaya_lain' => ['nullable', 'integer'],
            'biaya_jumlah' => ['required','integer'],
        ],[
            'id_add.required' => 'kamu belum memilih data',
            'biaya_jumlah.required' => 'kamu harus mengisi salah satu biaya diatas',
        ]);
        if ($this->biaya_jumlah == 0) {
            $this->addError('biaya_jumlah', 'Harus di isi.');
            return;
        }

        $user = User::findOrFail($this->id_add);
        $credentials['user_id'] = $this->id_add;
        $credentials['no_pembayaran'] = 'NP' . Str::upper(Str::random(10));
        $credentials['created_id'] = auth()->user()->id;
        RiwayatPembayaran::create($credentials);
        $this->dispatchBrowserEvent('addHide');
        $this->reset(['id_add', 'tanggal_pembayaran', 'biaya_dokter','biaya_tindakan','biaya_obat','biaya_lain','biaya_jumlah', 'search_data']);
        return session()->flash('success', 'Data pembayaran berhasil ditambahkan dengan No Pembayaran ' . $credentials['no_pembayaran']);
    }

    public function editPembayaran() {
        $credentials = $this->validate([
            'id_edit' => ['required','numeric'],
            'id_add' => ['required','numeric'],
            'tanggal_pembayaran' => ['required','date'],
            'biaya_dokter' => ['nullable', 'integer'],
            'biaya_tindakan' => ['nullable', 'integer'],
            'biaya_obat' => ['nullable', 'integer'],
            'biaya_lain' => ['nullable', 'integer'],
            'biaya_jumlah' => ['required','integer'],
        ]);
        $pembayaran = RiwayatPembayaran::findOrFail($this->id_edit);
        $pembayaran->user_id = $this->id_add;
        $pembayaran->tanggal_pembayaran = $this->tanggal_pembayaran;
        $pembayaran->biaya_dokter = $this->biaya_dokter;
        $pembayaran->biaya_tindakan = $this->biaya_tindakan;
        $pembayaran->biaya_obat = $this->biaya_obat;
        $pembayaran->biaya_lain = $this->biaya_lain;
        $pembayaran->biaya_jumlah = $this->biaya_jumlah;
        $pembayaran->save();
        $this->dispatchBrowserEvent('editHide');
        $this->reset(['id_add','id_edit', 'tanggal_pembayaran', 'biaya_dokter','biaya_tindakan','biaya_obat','biaya_lain','biaya_jumlah', 'search_data']);
        session()->flash('success', 'Data pembayaran berhasil diubah.');
    }

    public function removePembayaran() {
        RiwayatPembayaran::findOrFail($this->id_delete)->destroy($this->id_delete);
        $this->dispatchBrowserEvent('deleteHide');
        session()->flash('success', 'Data pembayaran berhasil dihapus.');
    }

    public function setDestroy($id,$name) {
        $this->id_delete = $id;
        $this->name_delete = $name;
    }

    public function updateTotal() {
        if (is_numeric($this->biaya_dokter) && is_numeric($this->biaya_jumlah) && is_numeric($this->biaya_tindakan) && is_numeric($this->biaya_obat)) {
            $this->biaya_jumlah = $this->biaya_dokter + $this->biaya_lain + $this->biaya_tindakan + $this->biaya_obat;
        } else { 
            $this->biaya_jumlah = 0;
        }
    }
    public function mount() {
        $this->tanggal_pembayaran = Carbon::now()->format('Y-m-d');
    }

    public function render()
    {
        if($this->search) {
            if($this->category == "nama") {
                if ($this->tanggal_table) {
                    $pembayarans = RiwayatPembayaran::whereHas('user', function (Builder $query) {
                        $query->where('name', 'like','%' . $this->search . '%');
                    })->latest()->where('tanggal_pembayaran',$this->tanggal_table)->paginate(20);
                } else {
                    $pembayarans = RiwayatPembayaran::whereHas('user', function (Builder $query) {
                        $query->where('name', 'like','%' . $this->search . '%');
                    })->latest()->paginate(20);
                }
            } elseif ($this->category == "no") {
                if ($this->tanggal_table) {
                    $pembayarans = RiwayatPembayaran::whereHas('user', function (Builder $query) {
                        $query->where('id', 'like','%' . $this->search . '%');
                    })->latest()->where('tanggal_pembayaran',$this->tanggal_table)->paginate(20);
                } else {
                    $pembayarans = RiwayatPembayaran::whereHas('user', function (Builder $query) {
                        $query->where('id', 'like','%' . $this->search . '%');
                    })->latest()->paginate(20);
                }
            } elseif ($this->category == "nik") {
                $pembayarans = RiwayatPembayaran::whereHas('user', function (Builder $query) {
                    $query->where('nik', 'like','%' . $this->search . '%');
                })->latest();
            } elseif ($this->category == "no_pembayaran") {
                if ($this->tanggal_table) {
                    $pembayarans = RiwayatPembayaran::where('no_pembayaran',  'like','%' . $this->search. '%')->where('tanggal_pembayaran',$this->tanggal_table)->paginate(20);
                } else {
                    $pembayarans = RiwayatPembayaran::where('no_pembayaran', 'like','%' .$this->search. '%')->paginate(20);
                }
            }
        } else {
            if ($this->tanggal_table) {
                $pembayarans = RiwayatPembayaran::latest()->where('tanggal_pembayaran',$this->tanggal_table)->paginate(20);
            } else {
                $pembayarans = RiwayatPembayaran::latest()->paginate(20);
            }
        }
        $users = null;
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
        return view('livewire.daftar-pembayaran', [
            'users' => $users,
            'pembayarans' => $pembayarans
        ]);
    }
}
