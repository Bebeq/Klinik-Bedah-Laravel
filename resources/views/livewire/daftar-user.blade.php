<div>
    <div class="pd-20 card-box mb-30">
        @if(Session::has('errors'))
          <div class="alert alert-danger"><i class="icon-copy fa fa-exclamation-triangle" aria-hidden="true"></i> {{Session::get('errors')->first()}}</div>
        @endif
        @if(session()->has('success'))
            <div class="alert alert-success">
                <i class="icon-copy fa fa-check" aria-hidden="true"></i> {{ session()->get('success') }}
            </div>
        @endif
            <div class="row">
                <div class="col-md-6">
                    <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#Add"><i class="icon-copy dw dw-add-user"></i></i> Tambah User</button>
                </div>
                <div class="col-md-6">
                    <form class="form-row">
                        <div class="form-group col-md-8">
                        <input wire:model="search" type="text" class="form-control search-input" placeholder="Search Here">
                        </div>
                        <div class="form-group col-md-4">
                            <select wire:model="category" id="inputState" class="form-control">
                                <option value="no">No</option>
                                <option value="nik">NIK</option>
                                <option value="nama">Nama</option>
                                <option value="no_hp">No HP</option>
                                <option value="alamat">Alamat</option>
                            </select>
                        </div>
                    </form>
                </div>
            </div>
        <div class="table-responsive">
        <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">No</th>
                <th scope="col">Nomor Pasien</th>
                <th scope="col">Nama</th>
                <th scope="col">No HP</th>
                <th scope="col">Sebagai</th>
                <th scope="col">Tanggal Daftar</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($users as $user)
                <tr>
                    <th>{{ $loop->iteration }}</th>
                    <td>NO : {{ $user->id }}<br>NIK : {{ $user->nik }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->no_hp }}</td>
                    <td>@if ($user->role == 2)
                        <span class="badge badge-pill" style="color: rgb(38, 94, 215); background-color: rgb(231, 235, 245);">Admin</span> 
                        @elseif ($user->role == 3)
                        <span class="badge badge-pill" style="color: rgb(241, 80, 80); background-color: rgb(231, 235, 245);">Dokter</span> 
                         @else
                         <span class="badge badge-pill" style="color: rgb(0, 0, 0); background-color: rgb(231, 235, 245);">Pasien</span> 
                          @endif
                    </td>
                    <td>{{ $user->created_at->format('d F Y') }}</td>
                    <td>
                        <div class="table-actions">
                            <a onclick="Edit({{ $user->id }},'{{ $user->no_hp }}','{{ $user->name }}','{{ $user->nik }}','{{ $user->alamat }}',{{ $user->role }})"  href="#" data-color="#265ed7" style="color: rgb(38, 94, 215);"><i class="icon-copy dw dw-edit2"></i></a>
                            <a onclick="Delete({{ $user->id }},'{{ $user->nik }}')" href="#" data-color="#e95959" style="color: rgb(233, 89, 89);"><i class="icon-copy dw dw-delete-3"></i></a>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
          </table>
          <div class="mx-auto" style="width: 200px;">
              {{ $users->links() }}
          </div>
        </div>
        </div>
</div>
