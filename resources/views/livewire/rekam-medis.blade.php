<div>
    @if (!empty($pasien_first))
    <div wire:ignore.self  class="modal fade" id="Delete" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Delete Data</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <span>Apakah kamu ingin menghapus data <span class="font-weight-bold text-primary">{{$diagnosa}}</span>?</span>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" wire:click="deleteRM({{$id_delete}})" class="btn btn-danger" id="modal-confirm_delete">Delete</button>
            </div>
          </div>
        </div>
      </div>
    <div wire:ignore.self  class="modal fade" id="Add" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Rekam Medis</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="needs-validation" wire:submit.prevent="addRM">
                    <div class="form-group">
                        <label>Diagnosa</label>
                        <input type="text" wire:model="diagnosa" value="{{ old('diagnosa') }}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Keterangan <small>[Optional]</small></label>
                        <textarea class="form-control" wire:model="keterangan" rows="3">{{ old('keterangan') }}</textarea>
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
    <div wire:ignore.self class="modal fade" id="Edit" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Edit Rekam Medis</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form class="needs-validation" wire:submit.prevent="editRM">
                    @csrf
                    <div class="form-group">
                        <label>Tanggal</label>
                        <input type="date" readonly wire:model="created_at" id="modal-tanggal-edit" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Diagnosa</label>
                        <input type="text" id="modal-diagnosa-edit" wire:model="diagnosa" class="form-control" placeholder="Masukkan Diagnosa">
                    </div>
                    <div class="form-group">
                        <label>Keterangan</label>
                        <textarea id="modal-keterangan-edit" class="form-control" wire:model="keterangan" rows="3">{{ old('keterangan') }}</textarea>
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
        <div class="card-box pd-20">
            <button class="btn btn-info mb-2" wire:click="$emit('$refresh')"><i class="icon-copy fa fa-refresh" aria-hidden="true"></i> Refresh</button>
            <h4 class="text-center mb-30 weight-600 mt-30">Rekam Medis Pasien Saat Ini</h4>
            <div class="row pb-30">
                <div class="col-md-6">
                    <h5 class="mb-15">{{ $pasien_first->user->name }}</h5>
                    <p class="font-14 mb-5">
                        No. RM <strong class="weight-600">{{ $pasien_first->user->id }}</strong>
                    </p>
                    <p class="font-14 mb-5">
                        Alamat <strong class="weight-600">{{ $pasien_first->user->alamat }}</strong>
                    </p>
                    <p class="font-14 mb-5">
                        Tanggal <strong class="weight-600">{{ Carbon\Carbon::now()->format('d F Y') }}</strong>
                    </p>
                </div>
            </div>
            <div class="pb-20">
                @if(Session::has('errors'))
            <div class="alert alert-danger"><i class="icon-copy fa fa-exclamation-triangle" aria-hidden="true"></i> {{Session::get('errors')->first()}}</div>
          @endif
          @if(session()->has('success'))
              <div class="alert alert-success">
                  <i class="icon-copy fa fa-check" aria-hidden="true"></i> {{ session()->get('success') }}
              </div>
          @endif
          <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#Add"><i class="icon-copy bi bi-plus-circle"></i> Tambah Rekam Medis</button>
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
                                    <a wire:click="showEdit({{ $rekam_medis->id }})" data-target="#Edit" data-toggle="modal"  href="#" data-color="#265ed7" style="color: rgb(38, 94, 215);"><i class="icon-copy dw dw-edit2"></i></a>
                                    <a wire:click="showDelete({{ $rekam_medis->id  }}, '{{ $rekam_medis->diagnosa }}')" data-target="#Delete" data-toggle="modal" href="#" data-color="#e95959" style="color: rgb(233, 89, 89);"><i class="icon-copy dw dw-delete-3"></i></a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $rekam_mediss->links() }}
        </div>
    </div>
@else
<div class="card-box pd-20">
    <button class="btn btn-info mb-2" wire:click="$emit('$refresh')"><i class="icon-copy fa fa-refresh" aria-hidden="true"></i> Refresh</button>
    <div class="alert alert-warning mt-1"><i class="icon-copy fa fa-exclamation-triangle" aria-hidden="true"></i> Tidak ada pasien.</div>
</div>
@endif
</div>
