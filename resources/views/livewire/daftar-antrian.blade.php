<div>
    <div wire:ignore.self class="modal fade" id="Add" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Antrian</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="needs-validation" wire:submit.prevent="addAntrian">
                    @if(Session::has('errorAdd'))
                    <div class="alert alert-danger"><i class="icon-copy fa fa-exclamation-triangle" aria-hidden="true"></i> {{Session::get('errorAdd')}}</div>
                    @endif
                    <div class="form-group" >
                        <div class="form-group">
                            <div class="form-row">
                                <div class="form-group col-8">
                                    <label>Cari Data Pasien</label>
                                    <input wire:model='search_data' type="text" class="form-control @error('id_add') is-invalid @enderror" placeholder="Pencarian data pasien">
                                </div>
                                <div class="form-group col-4">
                                    <label>Category</label>
                                    <select wire:model="categoryAdd" id="inputState" class="form-control">
                                        <option value="no">No RM</option>
                                        <option value="nik">NIK</option>
                                        <option value="nama">Nama</option>
                                    </select>
                                </div>
                            </div>
                            @empty($users)
                            @else
                            <select wire:model='id_add' class="custom-select @error('id_add') is-invalid @enderror" size="@if($users->count() > 5) 5 @elseif($users->count() == 1) 2 @else {{ $users->count() }} @endif" style="width: 100%">
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">No {{ $user->id }} - NIK {{ $user->nik }} : {{ $user->name }}</option>
                                @endforeach
                            </select>
                            @endempty
                            @error('id_add') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tanggal</label>
                            <input type="date" wire:model='tanggal_antrian' class="form-control date @error('tanggal_antrian') is-invalid @enderror" value="{{ Carbon\Carbon::now()->format('Y-m-d') }}" placeholder="Enter email">
                            @error('tanggal_antrian') <div class="invalid-feedback">{{ $message }}</div> @enderror
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
    @if(session()->has('successAntrianExp'))
        <div class="alert alert-success">
            <i class="icon-copy fa fa-check" aria-hidden="true"></i> {{ session()->get('successAntrianExp') }}
        </div>
    @endif
    @if ($antrians_expired->count() > 0)
    <div class="pd-20 card-box mb-30">
        <h4 class="mb-15 text-secondary h4">Daftar Antrian Kemarin</h4> 
        <div class="d-flex justify-content-start">
            <button wire:click="antrianExpTidakHadirSemua()" class="btn btn-danger btn-sm mr-2 mb-2"><i class="icon-copy bi bi-bookmark-x-fill"></i> Tidak Hadir Semua</button>
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
                    @foreach ($antrians_expired as $verif)
                    <tr>
                        <th scope="col">{{ $loop->iteration }}</th>
                        <td>{{ $verif->user->name }}</td>
                        <td>{{ $verif->user->nik }}</td>
                        <td>{{ $verif->tanggal_antrian }}</td>
                        <td>
                            <div class="table-actions">
                                <button wire:click="antrianExpSelesai({{ $verif->id }})" class="btn btn-success btn-sm mr-2"><i class="icon-copy bi bi-bookmark-check-fill"></i> Selesai</button>
                                <button wire:click="antrianExpTidakHadir({{ $verif->id }})" class="btn btn-danger btn-sm"><i class="icon-copy bi bi-bookmark-x-fill"></i> Tidak Hadir</button>
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
@if(session()->has('successVerif'))
    <div class="alert alert-success">
        <i class="icon-copy fa fa-check" aria-hidden="true"></i> {{ session()->get('successVerif') }}
    </div>
@endif
@if ($antrians_verif_now->count() > 0)
<div class="pd-20 card-box mb-30">
    <h4 class="mb-15 text-blue h4">Daftar Antrian Verifikasi Hari Ini</h4> 
    <div class="d-flex justify-content-start">
        <button wire:click="verifikasiSemua()" type="button" class="btn btn-info btn-sm mr-2 mb-2"><i class="icon-copy bi bi-bookmark-check-fill "></i> Verifikasi Semua</button>
        <button wire:click="verifikasiCancelSemua()" class="btn btn-danger btn-sm mr-2 mb-2"><i class="icon-copy bi bi-trash-fill"></i> Cancel Semua</button>
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
                            <button wire:click="verifikasiPasien({{ $verif->id }})" class="btn btn-info btn-sm mr-2"><i class="icon-copy bi bi-bookmark-check-fill"></i> Verifikasi</button>
                            <button wire:click="verifikasiCancel({{ $verif->id }})" class="btn btn-danger btn-sm"><i class="icon-copy bi bi-trash-fill"></i>Cancel</button>
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
        <button wire:click="expiredCancelSemua()" class="btn btn-danger btn-sm mr-2 mb-2"><i class="icon-copy bi bi-trash-fill"></i> Cancel Semua</button>
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
                            <button wire:click="expiredCancel({{ $verif->id }})" class="btn btn-danger btn-sm"><i class="icon-copy bi bi-trash-fill"></i>Cancel</button>
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
            <div class="card-box min-height-200px pd-20 mb-20" data-bgcolor="@if($total_antrian > 0) #265ed7 @else #f56767  @endif" style="background-color: @if($total_antrian > 0) rgb(38, 94, 215) @else rgb(245, 103, 103)  @endif;" 
            wire:loading.class="fade"
            wire:target='selesai,tidakHadir'>
                <div class="d-flex justify-content-between pb-40 text-white">
                    <div class="icon h1 text-white">
                        <div class="d-flex justify-content-start">
                            <i class="mt-1 icon-copy fa fa-stethoscope" aria-hidden="true"></i>
                            <div class="ml-2">NO : @if($total_antrian > 0) {{ $total_no + 1  }} @else - @endif</div>
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
            <div class="card-box pd-20 mb-20">
                <button wire:click="selesai" wire:loading.attr="disabled" type="button" class="btn btn-success btn-block mb-2"><i class="bi bi-bookmark-check-fill" 
                                                                                                        wire:loading.class.remove="bi bi-bookmark-check-fill" 
                                                                                                        wire:loading.class="fa-spin fa fa-circle-o-notch"
                                                                                                        wire:target='selesai'>
                                                                                                    </i> Selesai</button>
                <button wire:click="tidakHadir" wire:loading.attr="disabled" type="button" class="btn btn-danger btn-block"><i class="icon-copy bi bi-bookmark-x-fill"
                                                                                                        wire:loading.class.remove="icon-copy bi bi-bookmark-x-fill" 
                                                                                                        wire:loading.class="fa-spin fa fa-circle-o-notch"
                                                                                                        wire:target='tidakHadir'>
                                                                                                    </i> Tidak Hadir</button>
            </div>
        </div>
</div>
<div class="pd-20 card-box mb-30">
    @if(session()->has('success'))
    <div class="alert alert-success">
        <i class="icon-copy fa fa-check" aria-hidden="true"></i> {{ session()->get('success') }}
    </div>
@endif
@if(Session::has('error'))
                    <div class="alert alert-danger"><i class="icon-copy fa fa-exclamation-triangle" aria-hidden="true"></i> {{Session::get('error')}}</div>
                    @endif
@if(Session::has('errors'))
                    <div class="alert alert-danger"><i class="icon-copy fa fa-exclamation-triangle" aria-hidden="true"></i> {{Session::get('errors')->first()}}</div>
                    @endif
            <div class="row">
                <div class="col-md-4">
                    <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#Add"><i class="icon-copy bi bi-journal-plus"></i> Tambah Antrian</button>
                </div>
                <div class="col-md-8">
                    <div class="form-row">
                        <div class="form-group col-md-2">
                            <input wire:model="tanggal_table" type="date" class="form-control" value="{{ $tanggal_table }}" placeholder="Tanggal Table">
                        </div>
                        <div class="form-group col-md-6">
                            <input wire:model="search" type="text" class="form-control" placeholder="Pencarian data pasien">
                        </div>
                        <div class="form-group col-md-4">
                            <select wire:model="category" id="inputState" class="form-control">
                                <option value="no">No RM</option>
                                <option value="nik">NIK</option>
                                <option value="nama">Nama</option>
                                <option value="no_hp">No HP</option>
                                <option value="alamat">Alamat</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
<div class="table-responsive">
<table class="table table-hover">
    <thead>
      <tr>
        <th scope="col">No</th>
        <th scope="col">No Antrian</th>
        <th scope="col">No RM</th>
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
            <th>@if (empty($antrian->no))
                -
                @else
                {{ $antrian->no }}
                @endif
            </th>    
            <td>{{ $antrian->user->id }}</td>
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
      {{-- {{  $antrians->links() }} --}}
</div>
</div>
</div>
