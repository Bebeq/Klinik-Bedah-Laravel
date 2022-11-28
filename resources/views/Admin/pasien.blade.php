@extends('Layouts.dashboard')

@section('container')
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
          <form action="" method="POST">
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
          <h5 class="modal-title">Tambah Pasien</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="" method="POST">
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
          <h5 class="modal-title">Edit Pasien</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="" method="POST">
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
<div class="pd-20 card-box mb-30">
    <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#Add"><i class="icon-copy dw dw-add-user"></i></i> Tambah Pasien</button>
<table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">No</th>
        <th scope="col">Nama</th>
        <th scope="col">No HP</th>
        <th scope="col">NIK</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
    @foreach ($users as $user)
        <tr>
            <th>{{ $loop->iteration }}</th>
            <td>{{ $user->name }}</td>
            <td>{{ $user->no_hp }}</td>
            <td>{{ $user->nik }}</td>
            <td>
                <button onclick="Edit({{ $user->id }},'{{ $user->no_hp }}','{{ $user->name }}','{{ $user->nik }}','{{ $user->alamat }}')" class="btn btn-primary btn-sm"><i class="icon-copy dw dw-edit-1"></i></button>
                <button onclick="Delete({{ $user->id }},'{{ $user->nik }}')" class="btn btn-danger btn-sm"><i class="icon-copy dw dw-delete-3"></i></button>
            </td>
        </tr>
    @endforeach
    </tbody>
  </table>
</div>
@endsection

@section('javascript')
    <script>
        function Edit(id, nohp, nama, nik, alamat) {
            $('#modal-id-edit').val(id);
            $('#modal-nohp-edit').val(nohp);
            $('#modal-name-edit').val(nama);
            $('#modal-nik-edit').val(nik);
            $('#modal-alamat-edit').val(alamat);
            $('#Edit').modal('show');
        }
        function Delete(id, nik) {
            $('#modal-id-delete').val(id);
            $('#modal-nik').html(nik);
            $('#Delete').modal('show');
        }
    </script>
@endsection