<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\User;
use Livewire\Component;
use App\Models\RekamMedis;
use Livewire\WithPagination;
use Illuminate\Database\Eloquent\Builder;

class DaftarPasien extends Component
{
    Use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $category = "no";
    public $search;
    public $user_id;
    public $id_edit;
    public $id_delete;
    public $created_at;
    public $diagnosa;
    public $keterangan;
    public $idDetails;
    public $searchDetails;
    public $details = [];
    public $details_nama;
    public $toggleTambah;
    public $toggleDaftar;
    
    public function render()
    {
        if($this->search) {
            if($this->category == "nama") {
                $users = User::with(['rekam_medis'])->latest()->where('role',1)->where('name', 'like','%' . $this->search . '%')->paginate(10);
            } elseif ($this->category == "no") {
                $users = User::with(['rekam_medis'])->latest()->where('role',1)->where('id', 'like','%' . $this->search . '%')->paginate(10);
            } elseif ($this->category == "no_hp") {
                $users = User::with(['rekam_medis'])->latest()->where('role',1)->where('no_hp', 'like','%' . $this->search . '%')->paginate(10);
            } elseif ($this->category == "nik") {
                $users = User::with(['rekam_medis'])->latest()->where('role',1)->where('nik', 'like','%' . $this->search . '%')->paginate(10);
            } elseif ($this->category == "alamat") {
                $users = User::with(['rekam_medis'])->latest()->where('role',1)->where('alamat', 'like','%' . $this->search . '%')->paginate(10);
            }
        } else {
            $users = User::with(['rekam_medis'])->latest()->where('role',1)->paginate(10);
        }
        if($this->idDetails) {
            if($this->searchDetails) {
                $idDetails = $this->idDetails;
                $this->details = RekamMedis::where('user_id', $this->idDetails)
                                            ->where(function ($query) {
                                                return $query->where('diagnosa', 'like','%' . $this->searchDetails . '%')
                                                      ->orWhere('keterangan', 'like','%' . $this->searchDetails . '%');
                                            })
                                            ->get();
            } else {
                $this->details = RekamMedis::where('user_id', $this->idDetails)->get();
            }
        }

        return view('livewire.daftar-pasien',[
            'pasiens' => $users,
        ]);
    }

    public function toggleDaftar() {
        if ($this->toggleDaftar == 0) {
            $this->toggleDaftar = 1;
        } else {
            $this->toggleDaftar = 0;
        }
    }
    public function toggleTambah() {
        if ($this->toggleTambah == 0) {
            $this->toggleTambah = 1;
        } else {
            $this->toggleTambah = 0;
        }
    }

    public function showDetails($id,$nama) {
        $this->reset(['details','searchDetails']);
        $this->created_at = Carbon::now()->format('Y-m-d');
        $this->idDetails = $id;
        $this->user_id = $id;
        $this->toggleDaftar = 1;
        $this->toggleTambah = 1;
        $this->details_nama = $nama;
    }

    public function addRM() {
        $credentials = $this->validate([
            'user_id' => ['required'],
            'diagnosa' => ['required'],
            'keterangan' => ['nullable'],
            'created_at' => ['nullable']
        ]);
        $credentials['created_id'] = auth()->user()->id;
        RekamMedis::create($credentials);
        $this->reset(['details','searchDetails','diagnosa','keterangan']);
        $this->dispatchBrowserEvent('addHide');
        return session()->flash('success', 'Rekam medis berhasil ditambahkan.');
    }

    public function showEditRM($id) {
        $rm = RekamMedis::findOrFail($id);
        $this->diagnosa = $rm->diagnosa;
        $this->keterangan = $rm->keterangan;
        $this->id_edit = $rm->id;
    }

    public function showDeleteRM($id) {
        $rm = RekamMedis::findOrFail($id);
        $this->id_delete = $id;
    }

    public function editRM() {
        $credentials = $this->validate([
            'id_edit' => ['required'],
            'diagnosa' => ['required'],
            'keterangan' => ['nullable']
        ]);

        $rekammedis = RekamMedis::findOrFail($this->id_edit);
        $rekammedis->diagnosa = $this->diagnosa;
        $rekammedis->keterangan = $this->keterangan;
        $rekammedis->save();
        $this->reset(['diagnosa','keterangan']);
        $this->dispatchBrowserEvent('editHide');
        return session()->flash('success', 'Rekam medis berhasil diubah.');
    }

    public function deleteRM() {
        $rekam_medis = RekamMedis::findOrFail($this->id_delete);
        RekamMedis::destroy($rekam_medis->id);
        $this->reset(['diagnosa','keterangan']);
        $this->dispatchBrowserEvent('deleteHide');
        return session()->flash('success', 'Data Rekam Medis berhasil dihapus.');
    }
}
