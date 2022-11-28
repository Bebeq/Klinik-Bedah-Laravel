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
    @endsection
@can('pasien')
    @section('container')
    <div class="pl-20 pr-20 pt-20">
    @if (!empty($antrian_now_pending))
        <div class="alert alert-warning"><i class="icon-copy fa fa-exclamation-triangle" aria-hidden="true"></i> Kamu memiliki antrian pending, tunggu hingga admin memverifikasi.</div>
    @endif
    @if (!empty($antrian_now_verif))
        <div class="alert alert-info"><i class="icon-copy fa fa-exclamation-triangle" aria-hidden="true"></i> Kamu memiliki antrian pada hari ini dengan <strong>nomor urut {{ $antrian_now_verif->no }}</strong></div>
    @endif
    </div>
    <div class="row pl-20 pr-20">
        <div class="col-lg-6">
            <div class="card-box min-height-200px pd-30 mb-20" data-bgcolor="#455a64" style="background-color: rgb(69, 90, 100);">
                <div class="d-flex justify-content-between pb-40 text-white">
                    <div class="icon h1 text-white">
                        <i class="fa fa-calendar" aria-hidden="true"></i>
                    </div>
                    <div class="font-14 text-right">
                        <div class="font-18">Mendaftar Antrian</div>
                        <div class="badge badge-secondary badge-pill">
                            <div class="font-11">Tanggal Sekarang : {{ Carbon\Carbon::now()->format('d F Y') }}</div>
                        </div>
                    </div>
                </div>
                <form action="{{ route('pasien.antrian.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label class="text-white" for="exampleInputEmail1">Tanggal</label>
                        <input type="text" name="tanggal_antrian" readonly class="form-control date-picker" value="{{ Carbon\Carbon::now()->format('d F Y') }}" placeholder="Enter email">
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-success btn-sm">Daftar Antrian</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card-box min-height-200px pd-20 mb-20" data-bgcolor="#265ed7" style="background-color: rgb(38, 94, 215);">
                <div class="d-flex justify-content-between pb-40 text-white">
                    <div class="icon h1 text-white">
                        <div class="d-flex justify-content-start">
                            <i class="mt-1 icon-copy fa fa-stethoscope" aria-hidden="true"></i>
                            <div class="ml-2">NO : {{ $total_no + 1  }}</div>
                        </div>
                    </div>
                    <div class="font-14 text-right">
                        <div class="font-18">Antrian Hari Ini</div>
                        <div class="badge badge-secondary badge-pill">
                            <div class="font-11">Tanggal : {{ Carbon\Carbon::now()->format('d F Y') }}</div>
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
        <div class="col-lg-6">
            <div class="pd-20 card-box mb-30">
                <div class="d-flex justify-content-between pb-10">
                    <h4 class="text-secondary h4"><i class="icon-copy fa fa-address-book-o mr-2" aria-hidden="true"></i> Daftar Antrian</h4>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover ">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nomor Antrian</th>
                            <th scope="col">Status</th>
                            <th scope="col">Keterangan</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($antrians as $antrian)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    @if ($antrian->no == null)
                                        -
                                    @else
                                    {{ $antrian->no }}
                                    @endif
                                </td>
                                <td>
                                    @if ($antrian->status == 1)
                                    <span class="badge badge-pill text-warning" data-bgcolor="#e7ebf5" style="background-color: rgb(231, 235, 245);">Pending</span>
                                    @elseif ($antrian->status == 2)
                                    <span class="badge badge-pill text-info" data-bgcolor="#e7ebf5" style="background-color: rgb(231, 235, 245);">Menunggu Antrian</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($antrian->status == 1)
                                        Nomor antrian kamu menunggu di verifikasi.
                                    @elseif ($antrian->status == 2)
                                        Kamu telah masuk kedalam nomor antrian. 
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@endcan

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
@endsection

@can('dokter')
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
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pasien_first->rekam_medis as $rekam_medis)
                            <tr>
                                <td>{{ $rekam_medis->created_at->format('d F Y') }}</td>
                                <td>{{ $rekam_medis->diagnosa }}</td>
                                <td>{{ $rekam_medis->keterangan }}</td>
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
@endcan