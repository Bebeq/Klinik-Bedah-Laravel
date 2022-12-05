<div>
    @if (!empty($pasien_first))
<div class="row">
    <div class="col-lg-8">
        <div class="card-box pd-20">
            <button class="btn btn-info mb-2" wire:click="$emit('$refresh')"><i class="icon-copy fa fa-refresh" aria-hidden="true"></i> Refresh</button>
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
                <table class="table stripe hover nowrap">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th class="datatable-nosort">Diagnosa</th>
                            <th class="datatable-nosort">Keterangan</th>
                            <th class="datatable-nosort">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rekam_mediss->where('user_id', $pasien_first->user->id) as $rekam_medis)
                        <tr>
                            <td>{{ $loop->iteration}}</td>
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
                {{ $rekam_mediss->links() }}
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
    <button class="btn btn-info mb-2" wire:click="$emit('$refresh')"><i class="icon-copy fa fa-refresh" aria-hidden="true"></i> Refresh</button>
    <div class="alert alert-warning mt-1"><i class="icon-copy fa fa-exclamation-triangle" aria-hidden="true"></i> Tidak ada pasien.</div>
</div>
@endif
</div>
