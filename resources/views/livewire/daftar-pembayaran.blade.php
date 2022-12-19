<div>
    <div wire:ignore.self class="modal fade" id="Delete" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Delete Data</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <span>Apakah kamu ingin menghapus data <strong>{{ $name_delete }}</strong>?</span>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button wire:click="removePembayaran()" type="button" class="btn btn-danger">Delete</button>
            </div>
          </div>
        </div>
      </div>
    <div wire:ignore.self class="modal fade" id="Add" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Pembayaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="needs-validation" wire:submit.prevent="addPembayaran">
                    <div class="row">
                        <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tanggal Pembayaran :</label>
                                    <input wire:model="tanggal_pembayaran" type="date" class="form-control @error('tanggal_pembayaran') is-invalid @enderror">
                                    @error('tanggal_pembayaran') 
                                    <div class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-8">
                                        <label>Cari Data Pasien</label>
                                        <input wire:model='search_data' type="text" class="form-control @error('id_add') is-invalid @enderror" placeholder="Pencarian data pasien">
                                        @error('id_add') 
                                        <div class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </div>
                                        @enderror
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
                                <div class="form-group">
                                <label>Pilih Data Pasien : </label>
                                <select wire:model='id_add' class="custom-select @error('id_add') is-invalid @enderror" size="@if($users->count() > 5) 5 @elseif($users->count() == 1) 2 @else {{ $users->count() }} @endif" style="width: 100%">
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">No RM {{ $user->id }} - NIK {{ $user->nik }} : {{ $user->name }}</option>
                                    @endforeach
                                </select>
                                @error('id_add') 
                                <div class="invalid-feedback" role="alert">
                                    {{ $message }}
                               </div>
                                @enderror
                            </div>
                                @endempty
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Biaya Dokter : </label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text bg-secondary text-white" id="basic-addon1">Rp</span>
                                    </div>
                                    <input onkeydown="javascript: return event.keyCode == 69 ? false : true" type="number" wire:change="updateTotal" wire:model="biaya_dokter" class="form-control @error('biaya_dokter') is-invalid @enderror">
                                    @error('biaya_dokter') 
                                    <div class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Biaya Obat : </label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text bg-secondary text-white" id="basic-addon1">Rp</span>
                                    </div>
                                    <input onkeydown="javascript: return event.keyCode == 69 ? false : true" type="number" wire:change="updateTotal" wire:model="biaya_obat" class="form-control @error('biaya_obat') is-invalid @enderror">
                                    @error('biaya_obat') 
                                    <div class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Biaya Tindakan : </label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text bg-secondary text-white" id="basic-addon1">Rp</span>
                                    </div>
                                    <input onkeydown="javascript: return event.keyCode == 69 ? false : true" type="number" wire:change="updateTotal" wire:model="biaya_tindakan" class="form-control @error('biaya_tindakan') is-invalid @enderror">
                                    @error('biaya_tindakan') 
                                    <div class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Biaya Lain : </label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text bg-secondary text-white" id="basic-addon1">Rp</span>
                                    </div>
                                    <input onkeydown="javascript: return event.keyCode == 69 ? false : true" type="number" wire:change="updateTotal" wire:model="biaya_lain" class="form-control @error('biaya_lain') is-invalid @enderror">
                                    @error('biaya_lain') 
                                    <div class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Total Biaya : </label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text bg-info text-white" id="basic-addon1">Rp</span>
                                    </div>
                                    <input onkeydown="javascript: return event.keyCode == 69 ? false : true" wire:model='biaya_jumlah' type="number" class="form-control text-bold @error('biaya_jumlah') is-invalid @enderror" readonly>
                                    @error('biaya_jumlah') 
                                    <div class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
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
    <div wire:ignore.self class="modal fade" id="Edit" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Pembayaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="needs-validation" wire:submit.prevent="editPembayaran">
                    <div class="row">
                        <div class="col-md-6">
                            <input type="hidden" wire:model="id_edit" name="">
                                <div class="form-group">
                                    <label>Tanggal Pembayaran :</label>
                                    <input wire:model="tanggal_pembayaran" type="date" class="form-control @error('tanggal_pembayaran') is-invalid @enderror">
                                    @error('tanggal_pembayaran') 
                                    <div class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-8">
                                        <label>Cari Data Pasien</label>
                                        <input wire:model='search_data' type="text" class="form-control @error('id_add') is-invalid @enderror" placeholder="Pencarian data pasien">
                                        @error('id_add') 
                                        <div class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </div>
                                        @enderror
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
                                <div class="form-group">
                                <label>Pilih Data Pasien : </label>
                                <select wire:model='id_add' class="custom-select @error('id_add') is-invalid @enderror" size="@if($users->count() > 5) 5 @elseif($users->count() == 1) 2 @else {{ $users->count() }} @endif" style="width: 100%">
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">No RM {{ $user->id }} - NIK {{ $user->nik }} : {{ $user->name }}</option>
                                    @endforeach
                                </select>
                                @error('id_add') 
                                <div class="invalid-feedback" role="alert">
                                    {{ $message }}
                               </div>
                                @enderror
                            </div>
                                @endempty
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Biaya Dokter : </label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text bg-secondary text-white" id="basic-addon1">Rp</span>
                                    </div>
                                    <input onkeydown="javascript: return event.keyCode == 69 ? false : true" type="number" wire:change="updateTotal" wire:model="biaya_dokter" class="form-control @error('biaya_dokter') is-invalid @enderror">
                                    @error('biaya_dokter') 
                                    <div class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Biaya Obat : </label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text bg-secondary text-white" id="basic-addon1">Rp</span>
                                    </div>
                                    <input onkeydown="javascript: return event.keyCode == 69 ? false : true" type="number" wire:change="updateTotal" wire:model="biaya_obat" class="form-control @error('biaya_obat') is-invalid @enderror">
                                    @error('biaya_obat') 
                                    <div class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Biaya Tindakan : </label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text bg-secondary text-white" id="basic-addon1">Rp</span>
                                    </div>
                                    <input onkeydown="javascript: return event.keyCode == 69 ? false : true" type="number" wire:change="updateTotal" wire:model="biaya_tindakan" class="form-control @error('biaya_tindakan') is-invalid @enderror">
                                    @error('biaya_tindakan') 
                                    <div class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Biaya Lain : </label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text bg-secondary text-white" id="basic-addon1">Rp</span>
                                    </div>
                                    <input onkeydown="javascript: return event.keyCode == 69 ? false : true" type="number" wire:change="updateTotal" wire:model="biaya_lain" class="form-control @error('biaya_lain') is-invalid @enderror">
                                    @error('biaya_lain') 
                                    <div class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Total Biaya : </label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text bg-info text-white" id="basic-addon1">Rp</span>
                                    </div>
                                    <input onkeydown="javascript: return event.keyCode == 69 ? false : true" wire:model='biaya_jumlah' type="number" class="form-control text-bold @error('biaya_jumlah') is-invalid @enderror" readonly>
                                    @error('biaya_jumlah') 
                                    <div class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
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
    <div class="pd-20 card-box mb-30">
        @if(session()->has('success'))
        <div class="alert alert-success">
            <i class="icon-copy fa fa-check" aria-hidden="true"></i> {{ session()->get('success') }}
        </div>
        @endif
        <div class="row">
            <div class="col-md-4">
                <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#Add"><i class="icon-copy bi bi-journal-plus"></i> Tambah Pembayaran</button>
                
            </div>
            <div class="col-md-8">
                <div class="form-row">
                    <div class="form-group col-md-2">
                        <input wire:model="tanggal_table" type="date" class="form-control" value="{{ $tanggal_table }}" placeholder="Tanggal Table">
                    </div>
                    <div class="form-group col-md-6">
                        <input wire:model="search" type="text" class="form-control" placeholder="Pencarian data pembayaran">
                    </div>
                    <div class="form-group col-md-4">
                        <select wire:model="category" id="inputState" class="form-control">
                            <option value="no_pembayaran">No Pembayaran</option>
                            <option value="no">No RM</option>
                            <option value="nik">NIK</option>
                            <option value="nama">Nama</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div wire:loading.delay.short wire:target='search'>
                <i class="text-center fa fa-spinner fa-spin" aria-hidden="true"></i> Loading...
        </div>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                    <th scope="col">No Pembayaran</th>
                    <th scope="col">Data User</th>
                    <th scope="col">Biaya Dokter</th>
                    <th scope="col">Biaya Obat</th>
                    <th scope="col">Biaya Tindakan</th>
                    <th scope="col">Biaya Lain</th>
                    <th scope="col">Total Biaya</th>
                    <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pembayarans as $pembayaran)
                        <tr>
                            <td>{{ $pembayaran->no_pembayaran }}</td>
                            <td>NO RM&nbsp;&nbsp;&nbsp;: {{ $pembayaran->user->id }}<br>
                                NIK&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{ $pembayaran->user->nik }}<br>
                                Nama&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{ $pembayaran->user->name }}</td>
                            <td>@currency($pembayaran->biaya_dokter)</td>
                            <td>@currency($pembayaran->biaya_obat)</td>
                            <td>@currency($pembayaran->biaya_tindakan)</td>
                            <td>@currency($pembayaran->biaya_lain)</td>
                            <td>@currency($pembayaran->biaya_jumlah)</td>
                            <td>
                                <div class="table-actions">
                                    <a target="_blank"  href="{{ route('admin.invoice') }}?id={{ $pembayaran->id }}" data-color="#ff9500" style="color: rgb(255, 149, 0);"><i class="icon-copy bi bi-printer"></i></a>
                                    <a wire:click="setEdit({{ $pembayaran->id }})" data-toggle="modal" data-target="#Edit"  data-color="#265ed7" style="color: rgb(38, 94, 215);"><i class="icon-copy dw dw-edit2"></i></a>
                                    <a wire:click="setDestroy({{ $pembayaran->id }}, '{{ $pembayaran->no_pembayaran }}')" data-toggle="modal" data-target="#Delete" href="#" data-color="#e95959" style="color: rgb(233, 89, 89);"><i class="icon-copy dw dw-delete-3"></i></a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
