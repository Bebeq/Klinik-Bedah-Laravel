<div>
      <div wire:ignore.self class="modal fade" id="Add" tabindex="-1" role="dialog" aria-hidden="true">
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
                    @csrf
                    <div class="form-group">
                        <label>Tanggal</label>
                        <input type="date" wire:model="created_at" class="form-control" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label>Diagnosa</label>
                        <input type="hidden" value="" wire:model="user_id" value="">
                        <input type="text" id="modal-diagnosa-edit" wire:model="diagnosa" class="form-control" placeholder="Masukkan Diagnosa">
                    </div>
                    <div class="form-group">
                        <label>Keterangan</label>
                        <textarea id="modal-keterangan-edit" class="form-control" wire:model="keterangan" rows="3">{{ old('keterangan') }}</textarea>
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
<div wire:ignore.self  class="modal fade" id="Delete" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Delete Rekam Medis</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <span>Apakah kamu ingin menghapus rekam medis ini?</span>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button wire:click="deleteRM({{$id_delete}})" type="submit" class="btn btn-danger" id="modal-confirm_delete">Delete</button>
        </div>
      </div>
    </div>
  </div>
    <div wire:ignore.self  class="modal fade" id="Edit" tabindex="-1" role="dialog" aria-hidden="true">
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
                    <input type="date" wire:model="created_at" class="form-control" placeholder="Enter email">
                </div>
                <div class="form-group">
                    <label>Diagnosa</label>
                    <input type="hidden" id="modal-id-edit" wire:model="id_edit" value="">
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
    <div class="row">
      <div class="col-md-6" data-effect="fadeOut">
        @if ($toggleDaftar == '1')
        <div class="pd-20 card-box mb-30">
          <span wire:click="toggleDaftar()" class="pull-right clickable close-icon pd-10"><i class="fa fa-times fa-1x"></i></span>
          <div class="h5 pd-10 mb-2">Daftar Rekam Medis <span class="text-primary">{{ $details_nama }}</span></div>
          <hr>
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
              <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#Add"><i class="icon-copy bi bi-plus-circle"></i> Tambah Rekam Medis</button>
            </div>
            <div class="col-md-6">
              <input wire:model="searchDetails" type="text" class="form-control search-input" placeholder="Search Here">
            </div>
          </div>
          <div class="table-responsive">
            <table class="table table-hover">
              <thead>
                <th>Tanggal</th>
                <th>Diagnosa</th>
                <th>Keterangan</th>
                <th>Action</th>
              </thead>
              <tbody>
                @if ($details)
                  @foreach ($details as $detail)
                    <tr>
                      <td>{{ $detail->created_at }}</td>
                      <td>{{ $detail->diagnosa }}</td>
                      <td>{{ $detail->keterangan }}</td>
                      <td>
                      <div class="table-actions">
                            <a wire:click="showEditRM({{$detail->id}})" data-target="#Edit" data-toggle="modal"  href="#" data-color="#265ed7" style="color: rgb(38, 94, 215);"><i class="icon-copy dw dw-edit2"></i></a>
                            <a wire:click="showDeleteRM({{$detail->id}})" data-target="#Delete" data-toggle="modal" href="#" data-color="#e95959" style="color: rgb(233, 89, 89);"><i class="icon-copy dw dw-delete-3"></i></a>
                        </div>
                      </td>
                    </tr>
                  @endforeach
                  @else
                  <td class="text-center" colspan="4">Tidak ada data tersedia.</td>
                @endif
              </tbody>
            </table>
          </div>
        </div>
        @endif
      </div>
      <div class="@if ($toggleDaftar == '1')col-md-6 @else col-md-12 @endif">
        <div class="pd-20 card-box mb-30">
          <div class="row">
              <div class="col-md-6">
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
                  <th scope="col">Nomor Pasien</th>
                  <th scope="col">Nama</th>
                  <th scope="col">No HP</th>
                  <th scope="col">Alamat</th>
                  <th scope="col">Jumlah RM</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
              @foreach ($pasiens as $pasien)
                  <tr>
                      <td>NO : {{ $pasien->id }}<br>NIK : {{ $pasien->nik }}</td>
                      <td>{{ $pasien->name }}</td>
                      <td>{{ $pasien->no_hp }}</td>
                      <td>{{ Str::limit($pasien->alamat,33) }}</td>
                      <td>{{ $pasien->rekam_medis->count() }}</td>
                      <td>
                          <div class="table-actions">
                          <a wire:click="showDetails({{$pasien->id}}, '{{$pasien->name}}')" data-color="#498cbb;" style="color:rgb(73, 140, 187);"><i class="icon-copy dw dw-eye"></i></i>
                          </a>
                          </div>
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
      </div>
    </div>
</div>
