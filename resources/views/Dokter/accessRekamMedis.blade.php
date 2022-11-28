@extends('Layouts.dashboard')
@section('box')
@if(Session::has('errors'))
        <div class="modal fade" id="alert-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm modal-dialog-centered">
                <div class="modal-content bg-danger text-white">
                    <div class="modal-body text-center">
                        <h3 class="text-white mb-15">
                            <i class="fa fa-exclamation-triangle"></i> Error!
                        </h3>
                        <p>
                            {{Session::get('errors')->first()}}
                        </p>
                        <button
                            type="button"
                            class="btn btn-light"
                            data-dismiss="modal"
                        >
                            Ok
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
    @if(session()->has('success'))
        <div class="modal fade" id="success-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body text-center font-18">
                        <h3 class="mb-20">Berhasil !</h3>
                        <div class="mb-30 text-center">
                            <img src="vendors/images/success.png" />
                        </div>
                        {{ session()->get('success') }}
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-primary"data-dismiss="modal"> Done </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
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
          <h5 class="modal-title">Edit Rekam Medis</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('dokter.rekamMedis.edit') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Tanggal</label>
                    <input type="text" readonly id="modal-tanggal-edit" class="form-control">
                </div>
                <div class="form-group">
                    <label>Diagnosa</label>
                    <input type="hidden" id="modal-id-edit" name="id" value="">
                    <input type="text" id="modal-diagnosa-edit" name="diagnosa" class="form-control" placeholder="Masukkan Diagnosa">
                </div>
                <div class="form-group">
                    <label>Keterangan</label>
                    <textarea id="modal-keterangan-edit" class="form-control" name="keterangan" rows="3">{{ old('keterangan') }}</textarea>
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
@section('container')
@if (!empty($pasien_first))
<div class="row">
    <div class="col-lg-8">
        <div class="card-box pd-20">
            <h4 class="text-center mb-30 weight-600 mt-30">Rekam Medis Pasien Saat Ini</h4>
            <div class="row pb-30">
                <div class="col-md-6">
                    <h5 class="mb-15">{{ $pasien_first->user->name }}</h5>
                    <p class="font-14 mb-5">
                        Tanggal <strong class="weight-600">{{ Carbon\Carbon::now()->format('d F Y') }}</strong>
                    </p>
                </div>
            </div>
            <div class="pb-20">
                <table class="data-table table stripe hover nowrap">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th class="datatable-nosort">Diagnosa</th>
                            <th class="datatable-nosort">Keterangan</th>
                            <th class="datatable-nosort">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pasien_first->rekam_medis as $rekam_medis)
                        <tr>
                            <td>{{ $rekam_medis->created_at->format('d F Y') }}</td>
                            <td>{{ $rekam_medis->diagnosa }}</td>
                            <td>{{ $rekam_medis->keterangan }}</td>
                            <td>
                                <div class="table-actions">
                                    <a onclick="Edit({{ $rekam_medis->id }},'{{ $rekam_medis->created_at->format('d F Y') }}','{{ $rekam_medis->diagnosa }}','{{ $rekam_medis->keterangan }}')"  href="#" data-color="#265ed7" style="color: rgb(38, 94, 215);"><i class="icon-copy dw dw-edit2"></i></a>
                                    <a onclick="Delete({{ $rekam_medis->id  }}, '{{ $rekam_medis->diagnosa }}')" href="#" data-color="#e95959" style="color: rgb(233, 89, 89);"><i class="icon-copy dw dw-delete-3"></i></a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
        </div>
    </div>
</div>
    <div class="col-lg-4">
        <div class="card-box pd-20">
            <form action="{{  route('dokter.rekamMedis.store') }}" method="post">
                @csrf
                <input type="hidden" name="antrian_id" value="{{ $pasien_first->id }}">
                <div class="form-group">
                    <label>Diagnosa</label>
                    <input type="text" name="diagnosa" value="{{ old('diagnosa') }}" class="form-control">
                </div>
                <div class="form-group">
                    <label>Keterangan <small>[Optional]</small></label>
                    <textarea class="form-control" name="keterangan" rows="3">{{ old('keterangan') }}</textarea>
                </div>
                <button class="btn btn-primary" type="submit">Tambah</button>
            </form>
        </div>
    </div>
</div>
@else
<div class="card-box pd-20">
    <div class="alert alert-warning mt-1"><i class="icon-copy fa fa-exclamation-triangle" aria-hidden="true"></i> Tidak ada pasien.</div>
</div>
@endif
@endsection

@section('javascript')
    @if(session()->has('success'))
        <script>
            $(document).ready(function(){
                $("#success-modal").modal('show');
            });
        </script>
    @endif
    @if(session()->has('errors'))
        <script>
            $(document).ready(function(){
                $("#alert-modal").modal('show');
            });
        </script>
    @endif

    <script>
        function Edit(id,tanggal, diagnosa, keterangan) {
            $('#modal-id-edit').val(id);
            $('#modal-tanggal-edit').val(tanggal);
            $('#modal-diagnosa-edit').val(diagnosa);
            $('#modal-keterangan-edit').val(keterangan);
            $('#Edit').modal('show');
        }
        function Delete(id, nik) {
            $('#modal-id-delete').val(id);
            $('#modal-nik').html(nik);
            $('#Delete').modal('show');
        }
    </script>
@endsection
