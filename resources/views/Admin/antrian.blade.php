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
            <h5 class="modal-title">Tambah Antrian</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('admin.antrian.store') }}" method="POST">
                @csrf
                <div class="form-group" >
                    <div class="form-group">
                        <label>Data Pasien</label>
                        <select id="mySelect2"
                            class="form-control"
                            name="id"
                            style="width: 100%; height: 38px"
                        >
                            <optgroup label="Data Pasien">
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->nik }} - {{ $user->no_hp }} : {{ $user->name }}</option>
                                @endforeach
                            </optgroup>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tanggal</label>
                        <input type="text" name="tanggal_antrian" readonly class="form-control date-picker" value="{{ Carbon\Carbon::now()->format('d F Y') }}" placeholder="Enter email">
                    </div>
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
                        <h4>Daftar Antrian</h4>
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
                                Daftar Antrian
                            </li>
                        </ol>
                    </nav>
                </div>
                
            </div>
        </div>
</div>
@endsection

@section('container')
@if(session()->has('successVerif'))
    <div class="alert alert-success">
        <i class="icon-copy fa fa-check" aria-hidden="true"></i> {{ session()->get('successVerif') }}
    </div>
@endif
@if ($antrians_verif_now->count() > 0)
<div class="pd-20 card-box mb-30">
    <h4 class="mb-15 text-blue h4">Daftar Antrian Verifikasi Hari Ini</h4> 
    <div class="d-flex justify-content-start">

        <form action="{{ route('admin.antrian.verifikasiSemua') }}" method="post">
            @csrf
        <button type="submit" class="btn btn-info btn-sm mr-2 mb-2"><i class="icon-copy bi bi-bookmark-check-fill "></i> Verifikasi Semua</button>
        </form>
        <form action="{{ route('admin.antrian.verifikasiCancelSemua') }}" method="post">
            @csrf
            <button class="btn btn-danger btn-sm mr-2 mb-2"><i class="icon-copy bi bi-trash-fill"></i> Cancel Semua</button>
        </form>
    </div>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">No</th>
                <th scope="col">Nama Pasien</th>
                <th scope="col">NIK Pasien</th>
                <th scope="col">Tanggal Antrian</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($antrians_verif_now as $verif)
                <tr>
                    <th scope="col">{{ $loop->iteration }}</th>
                    <td>{{ $verif->user->name }}</td>
                    <td>{{ $verif->user->nik }}</td>
                    <td>{{ $verif->tanggal_antrian }}</td>
                    <td>
                        <div class="table-actions">
                        <form action="{{ route('admin.antrian.verifikasiPasien') }}" method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{ $verif->id }}">
                            <button class="btn btn-info btn-sm mr-2"><i class="icon-copy bi bi-bookmark-check-fill"></i> Verifikasi</button>
                        </form>
                        <form action="{{ route('admin.antrian.verifikasiCancel') }}" method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{ $verif->id }}">
                            <button class="btn btn-danger btn-sm"><i class="icon-copy bi bi-trash-fill"></i>Cancel</button>
                        </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif
@if(session()->has('successExp'))
    <div class="alert alert-success">
        <i class="icon-copy fa fa-check" aria-hidden="true"></i> {{ session()->get('successExp') }}
    </div>
@endif
@if ($antrians_verif_expired->count() > 0)
<div class="pd-20 card-box mb-30">
        <h4 class="mb-15 text-danger h4 mr-3">Daftar Antrian Verifikasi Expired</h4> 
        <form action="{{ route('admin.antrian.expiredCancelSemua') }}" method="POST">
            @csrf
            <button class="btn btn-danger btn-sm mr-2 mb-2"><i class="icon-copy bi bi-trash-fill"></i> Cancel Semua</button>
        </form>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama Pasien</th>
                <th scope="col">NIK Pasien</th>
                <th scope="col">Tanggal Antrian</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($antrians_verif_expired as $verif)
                <tr>
                    <th scope="col">{{ $loop->iteration }}</th>
                    <td>{{ $verif->user->name }}</td>
                    <td>{{ $verif->user->nik }}</td>
                    <td>{{ $verif->tanggal_antrian }}</td>
                    <td>
                        <div class="table-actions">
                            <form action="{{ route('admin.antrian.expiredCancel') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{ $verif->id }}">
                                <button class="btn btn-danger btn-sm"><i class="icon-copy bi bi-trash-fill"></i>Cancel</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif
<div class="row">
    <div class="col-lg-8">
            <div class="card-box min-height-200px pd-20 mb-20" data-bgcolor="#265ed7" style="background-color: rgb(38, 94, 215);">
                <div class="d-flex justify-content-between pb-40 text-white">
                    <div class="icon h1 text-white">
                        <div class="d-flex justify-content-start">
                            <i class="mt-1 icon-copy fa fa-stethoscope" aria-hidden="true"></i>
                            <div class="ml-2">NO : {{ $total_no + 1  }}</div>
                        </div>
                    </div>
                        <div class="font-14 text-right">
                            <div class="font-18">Nama Pasien</div>
                            <div class="card-box pd-10">
                            <h6 class="font-11 title">
                                @if ($total_antrian > 0)
                                {{ $pasien_first->user->name }}
                                @else
                                Tidak Ada Pasien
                                @endif</h6>
                            </div>
                        </div>
                </div>
                <div class="d-flex justify-content-between align-items-end mt-3">
                    <div class="text-white">
                        <div class="font-14">Jumlah Antrian</div>
                        <div class="font-24 weight-500">{{ $total_antrian }}</div>
                    </div>
                    <div class="text-white">
                        <div class="font-14">Jumlah Tidak Hadir</div>
                        <div class="font-24 weight-500">{{ $total_tidakhadir }}</div>
                    </div>
                    <div class="text-white">
                        <div class="font-14">Jumlah Selesai</div>
                        <div class="font-24 weight-500">{{ $total_selesai }}</div>
                    </div>
                    <div class="text-white">
                        <div class="font-14">Jumlah Cancel</div>
                        <div class="font-24 weight-500">{{ $total_cancel }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <form action="{{ route('admin.antrian.next') }}" method="post">
                @csrf
                <button type="submit" class="btn btn-success btn-block mb-2">Selesai</button>
            </form>
            <form action="{{ route('admin.antrian.notComing') }}" method="post">
                @csrf
            <button type="submit" class="btn btn-danger btn-block">Tidak Hadir</button>
            </form>
        </div>
</div>
<div class="pd-20 card-box mb-30">
    @if(session()->has('success'))
    <div class="alert alert-success">
        <i class="icon-copy fa fa-check" aria-hidden="true"></i> {{ session()->get('success') }}
    </div>
@endif
@if(Session::has('errors'))
                    <div class="alert alert-danger"><i class="icon-copy fa fa-exclamation-triangle" aria-hidden="true"></i> {{Session::get('errors')->first()}}</div>
                    @endif
    <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#Add"><i class="icon-copy bi bi-journal-plus"></i> Tambah Antrian</button>
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
        <th scope="col">No Antrian</th>
        <th scope="col">Nama Pasien</th>
        <th scope="col">NIK</th>
        <th scope="col">Tanggal Antrian</th>
        <th scope="col">Status</th>
      </tr>
    </thead>
    <tbody>
    @foreach ($antrians as $antrian)
        <tr>
            <th>{{ $loop->iteration }}</th>
            <td>@if (empty($antrian->no))
                -
                @else
                {{ $antrian->no }}
                @endif
            </td>    
            <td>{{ $antrian->user->name }}</td>
            <td>{{ $antrian->user->nik }}</td>
            <td>{{ $antrian->tanggal_antrian }}</td>
            <td>@if ($antrian->status == 2)
                <span class="badge badge-pill text-info" data-bgcolor="#e7ebf5" style="background-color: rgb(231, 235, 245);">Antri</span>
            @elseif($antrian->status == 3)  
                <span class="badge badge-pill text-pink" data-bgcolor="#e7ebf5" style="background-color: rgb(231, 235, 245);">Tidak Hadir</span>
            @elseif($antrian->status == 4)  
                <span class="badge badge-pill text-success" data-bgcolor="#e7ebf5" style="background-color: rgb(231, 235, 245);">Hadir</span>
            @elseif($antrian->status == 5 || $antrian->status == 6)  
                <span class="badge badge-pill text-success" data-bgcolor="#e7ebf5" style="background-color: rgb(231, 235, 245);">Selesai</span>
            @elseif($antrian->status == 7)  
                <span class="badge badge-pill text-danger" data-bgcolor="#e7ebf5" style="background-color: rgb(231, 235, 245);">Cancel</span>
            @endif
        </td>
        </tr>
    @endforeach
    </tbody>
  </table>
      {{  $antrians->links() }}
</div>
</div>
@endsection

@section('javascript')
    <script>
        $('#mySelect2').select2({
            dropdownParent: $('#Add')
        });
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