<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\Antrian;
use Livewire\Component;
use App\Models\RekamMedis as RM;
use Livewire\WithPagination;

class RekamMedis extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = [
        '$refresh'
    ];
    public $user_id;
    public $diagnosa;
    public $keterangan;
    public $id_edit;
    public $id_delete;
    public $created_at;
    public function render()
    {
        $pasien = Antrian::oldest()->where('tanggal_antrian', Carbon::now()->format('Y-m-d'))->whereIn('status', [2])->first();
        if(isset($pasien->user->id)) {
            $this->user_id = $pasien->user->id;
        }
        return view('livewire.rekam-medis', [
            'pasien_first' => $pasien,
            'rekam_mediss' => RM::latest()->paginate(10)
        ]);
    }

    public function addRM() {
        $credentials = $this->validate([
            'user_id' => ['required'],
            'diagnosa' => ['required'],
            'keterangan' => ['nullable'],
        ]);
        $credentials['created_at'] = Carbon::now();
        $credentials['created_id'] = auth()->user()->id;
        RM::create($credentials);
        $this->dispatchBrowserEvent('addHide');
        $this->reset(['user_id','diagnosa','keterangan']);
        return session()->flash('success', 'Rekam medis berhasil ditambahkan.');
    }

    public function showEdit($id) {
        $this->reset(['user_id','diagnosa','keterangan']);
        $this->id_edit = $id;
        $rm = RM::findOrFail($id);
        $this->diagnosa = $rm->diagnosa;
        $this->keterangan = $rm->keterangan;
        $this->created_at = $rm->created_at->format('Y-m-d');
    }

    public function showDelete($id,$diagnosa) {
        $this->reset(['user_id','diagnosa','keterangan']);
        $this->id_delete = $id;
        $this->diagnosa = $diagnosa;
    }

    public function editRM() {
        $credentials = $this->validate([
            'id_edit' => ['required'],
            'diagnosa' => ['required'],
            'keterangan' => ['nullable']
        ]);

        $rekammedis = RM::findOrFail($this->id_edit);
        $rekammedis->diagnosa = $this->diagnosa;
        $rekammedis->keterangan = $this->keterangan;
        $rekammedis->save();
        $this->dispatchBrowserEvent('editHide');
        $this->reset(['user_id','diagnosa','keterangan']);
        return session()->flash('success', 'Rekam medis berhasil diubah.');
    }

    public function deleteRM() {
        $rekam_medis = RM::findOrFail($this->id_delete);
        RM::destroy($rekam_medis->id);
        $this->dispatchBrowserEvent('deleteHide');
        return session()->flash('success', 'Rekam medis berhasil dihapus.');
    }
}
