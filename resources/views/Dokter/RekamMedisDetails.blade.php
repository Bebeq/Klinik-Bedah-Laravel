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
                            <img src="{{ asset('vendors/images/success.png') }}" />
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
          <form action="{{ route('dokter.rekamMedis.destroy') }}" method="POST">
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
            <h5 class="modal-title">Tambah Rekam Medis</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('dokter.DaftarRekamMedis.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Tanggal</label>
                    <input type="text" name="created_at" readonly class="form-control date-picker" value="{{ Carbon\Carbon::now()->format('d F Y') }}" placeholder="Enter email">
                </div>
                <div class="form-group">
                    <label>Diagnosa</label>
                    <input type="hidden" value="{{ $pasiens->id }}" name="user_id" value="">
                    <input type="text" id="modal-diagnosa-edit" name="diagnosa" class="form-control" placeholder="Masukkan Diagnosa">
                </div>
                <div class="form-group">
                    <label>Keterangan</label>
                    <textarea id="modal-keterangan-edit" class="form-control" name="keterangan" rows="3">{{ old('keterangan') }}</textarea>
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

@section('header')
<div class="pd-ltr-20 xs-pd-20-10">
    <div class="title">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="title">
                        <h4>Rekam Medis <span class="text-primary">{{ $pasiens->name }}</span></h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item">
                                Admin
                            </li>
                            <li class="breadcrumb-item">
                                Rekam Medis
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Details
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
    <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#Add"><i class="icon-copy bi bi-plus-circle"></i> Tambah Rekam Medis</button>
    <div class="table-responsive">
        <table class="data-table table table-hover">
            <thead>
                <tr>
                  <th scope="col">No</th>
                  <th scope="col">Tanggal</th>
                  <th scope="col">Diagnosa</th>
                  <th scope="col">Keterangan</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
              @foreach ($pasiens->rekam_medis as $rekam_medis)
                  <tr>
                      <th>{{ $loop->iteration }}</th>
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