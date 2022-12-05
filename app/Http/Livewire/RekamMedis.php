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
    public function render()
    {
        return view('livewire.rekam-medis', [
            'pasien_first' => Antrian::oldest()->where('tanggal_antrian', Carbon::now()->format('Y-m-d'))->whereIn('status', [2])->first(),
            'rekam_mediss' => RM::latest()->paginate(10)
        ]);
    }
}
