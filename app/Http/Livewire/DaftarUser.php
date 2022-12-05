<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class DaftarUser extends Component
{
    public $id_delete;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search;
    public $category = "no";
    protected $updateQueryString = ['search'];
    public function updatingSearch() {
        $this->resetPage();
    }

    public function render()
    {
        if($this->search) {
            if($this->category == "nama") {
                $users = User::latest()->where('name', 'like','%' . $this->search . '%')->paginate(20);
            } elseif ($this->category == "no") {
                $users = User::latest()->where('id', 'like','%' . $this->search . '%')->paginate(20);
            } elseif ($this->category == "no_hp") {
                $users = User::latest()->where('no_hp', 'like','%' . $this->search . '%')->paginate(20);
            } elseif ($this->category == "nik") {
                $users = User::latest()->where('nik', 'like','%' . $this->search . '%')->paginate(20);
            } elseif ($this->category == "alamat") {
                $users = User::latest()->where('alamat', 'like','%' . $this->search . '%')->paginate(20);
            }
        } else {
            $users = User::latest()->paginate(20);
        }
        return view('livewire.daftar-user',[
            'users' => $users
        ]);
    }
}
