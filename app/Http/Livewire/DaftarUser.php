<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Hash;

class DaftarUser extends Component
{
    public $id_delete;
    public $name_delete;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search;
    public $category = "no";
    public $selected = [];
    public $count_selected;
    public $gap = 1;
    public $id_card;
    public $name_card;
    public $alamat_card;

    public $id_edit;
    public $no_hp;
    public $name;
    public $nik;
    public $alamat;
    public $role;
    public $password;

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

    public function addUser() {
        $credentials = $this->validate([
            'no_hp' => ['required','numeric','unique:users,no_hp'],
            'name' => ['required'],
            'nik' => ['required','digits:16','numeric','unique:users,nik'],
            'alamat' => ['required'],
            'role' => ['required','numeric','digits:1'],
            'password' => ['required']
        ]);
        $credentials['password'] = Hash::make($credentials['password']);
        User::create($credentials);
        $this->dispatchBrowserEvent('addHide');
        $this->reset(['no_hp', 'name', 'nik','alamat','role','password']);
        return session()->flash('success', 'Data user berhasil ditambahkan.');
    }

    public function editUser() {
        $credentials = $this->validate([
            'id_edit' => ['required','numeric'],
            'no_hp' => 'required|numeric|unique:users,no_hp,' . $this->id_edit,
            'name' => ['required'],
            'nik' => ['required','digits:16','numeric','unique:users,nik,' . $this->id_edit],
            'alamat' => ['required'],
            'role' => ['required','numeric','digits:1'],
            'password' => []
        ]);
        $user = User::findOrFail($this->id_edit);
        $user->no_hp = $this->no_hp;
        $user->name = $this->name;
        $user->nik = $this->nik;
        if (empty($this->password)) {
            $user->password = $user->password;
        } else {
            $user->password = Hash::make($this->password);
        }
        $user->alamat = $this->alamat;
        $user->role = $this->role;
        $user->save();
        $this->dispatchBrowserEvent('editHide');
        $this->reset(['no_hp', 'name', 'nik','alamat','role','password']);
        session()->flash('success', 'Data user berhasil diubah.');
    }

    public function setEdit($id) {
        $this->reset(['no_hp', 'name', 'nik','alamat','role','password']);
        $this->id_edit = $id;
        $getUser = User::findOrFail($id);
        $this->no_hp = $getUser->no_hp;
        $this->nik = $getUser->nik;
        $this->name = $getUser->name;
        $this->alamat = $getUser->alamat;
        $this->role = $getUser->role;
    }

    public function resetData() {
        $this->reset(['no_hp', 'name', 'nik','alamat','role','password']);
    }
    public function setIDCard($id) {
        $this->reset(['no_hp', 'name', 'nik','alamat','role','password']);
        $this->id_card = $id;
        $getUser = User::findOrFail($id);
        $this->name_card = $getUser->name;
        $this->alamat_card = $getUser->alamat;
    }

    public function removeShow($id,$name) {
        $this->id_delete = $id;
        $this->name_delete = $name;
    }

    public function removeUser($id) {
        $user = User::findOrFail($id);
        User::destroy($id);
        $this->dispatchBrowserEvent('deleteHide');
        session()->flash('success', 'Data user berhasil dihapus.');
    }
    public function removeMassUser() {
        foreach ($this->selected as $key => $value) {
            if ($value !== false) {
                User::destroy($value);
            }
        }
        $this->reset(['selected']);
        $this->dispatchBrowserEvent('deleteMassHide');
        session()->flash('success', 'Data user berhasil dihapus.');
    }
}
