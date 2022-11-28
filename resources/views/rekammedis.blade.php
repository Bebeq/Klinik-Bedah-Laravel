@extends('Layouts.dashboard')

@section('box')
<div class="modal fade" id="Delete" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Delete Data</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <span>Apakah kamu ingin menghapus data <span class="font-weight-bold text-primary" id="modal-nik"></span>?</span>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <form action="{{ route('admin.users.destroy') }}" method="POST">
            @csrf
            <input type="hidden" name="id" id="modal-id-delete" value="">
            <button type="submit" class="btn btn-danger" id="modal-confirm_delete">Delete</button>
          </form>
        </div>
      </div>
    </div>
  </div>
<div class="modal fade" id="Add" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Tambah User</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('admin.users.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>No HP</label>
                    <input type="hidden" id="modal-id-add" name="id" value="">
                    <input type="text" id="modal-nohp-add" name="no_hp" class="form-control" placeholder="Masukkan No HP">
                </div>
                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" id="modal-name-add" name="name" class="form-control" placeholder="Masukkan Nama">
                </div>
                <div class="form-group">
                    <label>NIK</label>
                    <input type="text" id="modal-nik-add" name="nik" class="form-control" placeholder="Masukkan NIK">
                </div>
                <div class="form-group">
                    <label>Alamat</label>
                    <input type="text" id="modal-alamat-add" name="alamat" class="form-control" placeholder="Masukkan Alamat">
                </div>
                <div class="form-group">
                    <label>Sebagai</label>
                        <select name="role" id="modal-sebagai-add" class="form-control">
                            <option selected value="1">Pasien</option>
                            <option value="2">Admin</option>
                            <option value="3">Dokter</option>
                        </select>
                    </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="text" id="modal-password-add" name="password" class="form-control" placeholder="Masukkan Password">
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Tambah</button>
        </form>
        </div>
    </div>
    </div>
</div>
<div class="modal fade" id="Edit" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit User</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('admin.users.edit') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>No HP</label>
                    <input type="hidden" id="modal-id-edit" name="id" value="">
                    <input type="text" id="modal-nohp-edit" name="no_hp" class="form-control" placeholder="Masukkan No HP">
                </div>
                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" id="modal-name-edit" name="name" class="form-control" placeholder="Masukkan Nama">
                </div>
                <div class="form-group">
                    <label>NIK</label>
                    <input type="text" id="modal-nik-edit" name="nik" class="form-control" placeholder="Masukkan NIK">
                </div>
                <div class="form-group">
                    <label>Alamat</label>
                    <input type="text" id="modal-alamat-edit" name="alamat" class="form-control" placeholder="Masukkan Alamat">
                </div>
                <div class="form-group">
                    <label>Sebagai</label>
                      <select name="role" id="modal-role-edit" class="form-control">
                          <option selected value="1">Pasien</option>
                          <option value="2">Admin</option>
                          <option value="3">Dokter</option>
                      </select>
                  </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="text" id="modal-password-edit" name="password" class="form-control" placeholder="Masukkan Password">
                    <small>Kosongi jika tidak ingin mengganti password.</small>
                </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Edit</button>
        </form>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('header')
<div class="pd-ltr-20 xs-pd-20-10">
    <div class="title">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="title">
                        <h4>Daftar Users</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item">
                                Admin
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Daftar Users
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
</div>
@endsection

@section('container')
<div class="pd-20 card-box mb-30">
@if(Session::has('errors'))
  <div class="alert alert-danger"><i class="icon-copy fa fa-exclamation-triangle" aria-hidden="true"></i> {{Session::get('errors')->first()}}</div>
@endif
@if(session()->has('success'))
    <div class="alert alert-success">
        <i class="icon-copy fa fa-check" aria-hidden="true"></i> {{ session()->get('success') }}
    </div>
@endif
    <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#Add"><i class="icon-copy dw dw-add-user"></i></i> Tambah User</button>
        <form method="GET">
            <div class="input-group mb-2">
                <input type="text" name="search" class="form-control search-input" placeholder="Search Here">
                <div class="input-group-append">
                    <button type="submit" class="btn btn-outline-secondary">Search</button>
                  </div>
            </div>
        </form>
<div class="table-responsive">
<table class="table table-hover">
    <thead>
      <tr>
        <th scope="col">No</th>
        <th scope="col">Nama</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
    @foreach ($pasiens as $pasien)
        <tr>
            <th>{{ $loop->iteration }}</th>
            <td>{{ $pasien->name }}</td>
            <td>
                <button class="btn btn-info">Show</button>
            </td>
        </tr>
    @endforeach
    </tbody>
  </table>
  <div class="mx-auto" style="width: 200px;">
      {{ $pasiens->links() }}
  </div>
</div>
</div>
@endsection

@section('javascript')
    <script>
        function Edit(id, nohp, nama, nik, alamat,role) {
            $('#modal-id-edit').val(id);
            $('#modal-nohp-edit').val(nohp);
            $('#modal-name-edit').val(nama);
            $('#modal-nik-edit').val(nik);
            $('#modal-alamat-edit').val(alamat);
            document.querySelector("#modal-role-edit").value=role
            $('#Edit').modal('show');
        }
        function Delete(id, nik) {
            $('#modal-id-delete').val(id);
            $('#modal-nik').html(nik);
            $('#Delete').modal('show');
        }
    </script>
@endsection