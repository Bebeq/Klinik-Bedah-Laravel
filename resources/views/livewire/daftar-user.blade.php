<div>
  @foreach ($selected as $key => $value)
    @if ($value !== false)
    @php
        $count_selected = $count_selected + 1
    @endphp
    @endif
  @endforeach
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
            <button wire:click="removeUser({{ $id_delete }})" type="button" class="btn btn-danger">Delete</button>
        </div>
      </div>
    </div>
  </div>
  <div wire:ignore.self class="modal fade" id="MassDelete" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Delete Data Terpilih</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <span>Apakah kamu ingin menghapus data dibawah ini?</span><br>
              @foreach ($selected as $key => $value)
                @if ($value !== false)
                <li>{{ $value }}</li>
                @endif
              @endforeach
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button wire:click="removeMassUser()" type="button" class="btn btn-danger">Delete</button>
        </div>
      </div>
    </div>
  </div>
  <div wire:ignore.self  class="modal fade" id="Edit" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit User</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form class="needs-validation" wire:submit.prevent="editUser">
                <div class="form-group">
                    <label>No RM</label>
                    <input class="form-control" type="number" wire:model="id_edit" id="modal-id-edit" disabled>
                </div>
                <div class="form-group">
                    <label>No HP</label>
                    <input type="text" id="modal-nohp-edit" wire:model="no_hp" class="form-control" placeholder="Masukkan No HP">
                </div>
                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" id="modal-name-edit" wire:model="name" class="form-control" placeholder="Masukkan Nama">
                </div>
                <div class="form-group">
                    <label>NIK</label>
                    <input type="text" id="modal-nik-edit" wire:model="nik" class="form-control" placeholder="Masukkan NIK">
                </div>
                <div class="form-group">
                    <label>Alamat</label>
                    <input type="text" id="modal-alamat-edit" wire:model="alamat" class="form-control" placeholder="Masukkan Alamat">
                </div>
                <div class="form-group">
                    <label>Sebagai</label>
                      <select wire:model="role" id="modal-role-edit" class="form-control">
                          <option selected value="1">Pasien</option>
                          <option value="2">Admin</option>
                          <option value="3">Dokter</option>
                      </select>
                  </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="text" id="modal-password-edit" wire:model="password" class="form-control" placeholder="Masukkan Password">
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
  <div wire:ignore.self  class="modal fade" id="Add" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title">Tambah User</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
              <form class="needs-validation" wire:submit.prevent="addUser">
                  <div class="form-group">
                      <label>No HP</label>
                      <input type="text" id="modal-nohp-add" wire:model="no_hp" class="form-control @error('no_hp') is-invalid @enderror" placeholder="Masukkan No HP">
                      @error('no_hp') <div class="invalid-feedback">{{ $message }}</div> @enderror
                  </div>
                  <div class="form-group">
                      <label>Nama</label>
                      <input type="text" id="modal-name-add" wire:model="name" class="form-control @error('name') is-invalid @enderror" placeholder="Masukkan Nama">
                      @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                  </div>
                  <div class="form-group">
                      <label>NIK</label>
                      <input type="text" id="modal-nik-add" wire:model="nik" class="form-control @error('nik') is-invalid @enderror" placeholder="Masukkan NIK">
                      @error('nik') <div class="invalid-feedback">{{ $message }}</div> @enderror
                  </div>
                  <div class="form-group">
                      <label>Alamat</label>
                      <input type="text" id="modal-alamat-add" wire:model="alamat" class="form-control @error('alamat') is-invalid @enderror" placeholder="Masukkan Alamat">
                      @error('alamat') <div class="invalid-feedback">{{ $message }}</div> @enderror
                  </div>
                  <div class="form-group">
                      <label>Sebagai</label>
                          <select wire:model="role" id="modal-sebagai-add" class="form-control @error('role') is-invalid @enderror">
                              <option selected value="1">Pasien</option>
                              <option value="2">Admin</option>
                              <option value="3">Dokter</option>
                          </select>
                        @error('role') <div class="invalid-feedback">{{ $message }}</div> @enderror
                      </div>
                  <div class="form-group">
                      <label>Password</label>
                      <input type="text" id="modal-password-add" wire:model="password" class="form-control @error('password') is-invalid @enderror" placeholder="Masukkan Password">
                      @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
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
    <div wire:ignore.self class="modal fade" id="Cetak" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Cetak Kartu</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div style="font-weight: 500;font-size: 15px;">Pilih Letak Cetak</div>
              <table class="table table-bordered">
                <tbody>
                  <tr>
                    <th style="width: 50%;" onclick="$('label[for=checked1]')[0].click()">
                      <input wire:model="gap"  type="radio" name="checked" value="1" id="checked1">
                      <label class="form-check-label" for="checked1">Layout 1</label>
                    </th>
                    <th style="width: 50%;" onclick="$('label[for=checked2]')[0].click()">
                      <input wire:model="gap" type="radio" name="checked" value="2" id="checked2">
                      <label class="form-check-label" for="checked2">Layout 2</label>
                    </th>
                  </tr>
                  <tr>
                    <th onclick="$('label[for=checked3]')[0].click()">
                      <input wire:model="gap"  type="radio" name="checked" value="3" id="checked3">
                      <label class="form-check-label" for="checked3">Layout 3</label>
                    </th>
                    <th onclick="$('label[for=checked4]')[0].click()">
                      <input wire:model="gap" type="radio" name="checked" value="4" id="checked4">
                      <label class="form-check-label" for="checked4">Layout 4</label>
                    </th>
                  </tr>
                  <tr>
                    <th onclick="$('label[for=checked5]')[0].click()">
                      <input wire:model="gap"  type="radio" name="checked" value="5" id="checked5">
                      <label class="form-check-label" for="checked5">Layout 5</label>
                    </th>
                    <th onclick="$('label[for=checked6]')[0].click()">
                      <input wire:model="gap" type="radio" name="checked" value="6" id="checked6">
                      <label class="form-check-label" for="checked6">Layout 6</label>
                    </th>
                  </tr>
                  <tr>
                    <th onclick="$('label[for=checked7]')[0].click()">
                      <input wire:model="gap"  type="radio" name="checked" value="7" id="checked7">
                      <label class="form-check-label" for="checked7">Layout 7</label>
                    </th>
                    <th onclick="$('label[for=checked8]')[0].click()">
                      <input wire:model="gap" type="radio" name="checked" value="8" id="checked8">
                      <label class="form-check-label" for="checked8">Layout 8</label>
                    </th>
                  </tr>
                  <tr>
                    <th onclick="$('label[for=checked9]')[0].click()">
                      <input wire:model="gap"  type="radio" name="checked" value="9" id="checked9">
                      <label class="form-check-label" for="checked9">Layout 9</label>
                    </th>
                    <th onclick="$('label[for=checked10]')[0].click()">
                      <input wire:model="gap" type="radio" name="checked" value="10" id="checked10">
                      <label class="form-check-label" for="checked10">Layout 10</label>
                    </th>
                  </tr>
                </tbody>
              </table>
                <div style="font-weight: 500;font-size: 15px;">Preview</div>
                <div class="row">
                  <div class="col-12 scrolls">
                  <div class="card border-dark mr-2 ml-2" style="width: 450px; height: 260px;border: 3px solid black;">
                    <div class="text-center mt-2" style="margin-bottom : -0.2rem;font-size : 20px">Klinik Bedah <strong>"Melati"</strong></div>
                    <div class="text-center font-weight-bold" style="margin-bottom : -0.2rem;">Ds. Pramugara Niaga Rt.01/Rw.01</div>
                    <div class="text-center font-weight-bold" style="font-size : 15px">Telp. 085155221416</div>
                    <hr style="border-color: #343a40;margin-top : 0.5rem;margin-bottom : 0.2rem;border: 1px solid black;">
                    <hr style="border-color: #343a40;margin-top : 0.1rem;border: 1px solid black;">
                    <span class="ml-3 mb-2 font-weight-bold" style="font-size : 18px">Nama&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;<span style="font-weight: 500;">&nbsp;{{ \Illuminate\Support\Str::limit($name_card, 33) }}</span></span>
                    <span class="ml-3 mb-2 font-weight-bold" style="font-size : 18px">Alamat&nbsp;&nbsp;:&nbsp;<span style="font-weight: 500;">&nbsp;{{ \Illuminate\Support\Str::limit($alamat_card, 33) }}</span></span>
                    <span class="ml-3 mb-2 font-weight-bold" style="font-size : 18px">NO. RM&nbsp;:&nbsp;<span style="font-weight: 500;">&nbsp;{{ $id_card }}</span></span>
                    <span class="ml-3 mt-2 mb-2 font-weight-bold text-center" style="font-size : 15px">Harap dibawa setiap kali periksa</span>
                </div>
              </div>
                  </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <a href="{{ route('admin.kartu') }}?id={{ $id_card }}@if($gap > 1)&gap={{ $gap - 1 }}@endif" target="_blank" on type="submit" class="btn btn-success" id="modal-confirm_delete">Cetak</a>
            </div>
          </div>
        </div>
      </div>
    <div class="pd-20 card-box mb-30">
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
                    <button type="button" wire:click="resetData()" class="btn btn-primary mb-2" data-toggle="modal" data-target="#Add"><i class="icon-copy dw dw-add-user"></i></i> Tambah User</button>
            <a  href="{{ route('admin.kartu') }}?id=@foreach ($selected as $select){{ $select }},@endforeach " target="_blank" type="button" class="btn btn-warning text-white mb-2 @if(!$count_selected) disabled @endif"><i class="icon-copy dw dw-print"></i> Cetak Kartu Tercentang</a>
            <button data-toggle="modal" data-target="#MassDelete" type="button" class="btn btn-danger mb-2" @if(!$count_selected) disabled @endif><i class="icon-copy dw dw-trash1"></i> Delete Data Tercentang</button>
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
                <th scope="col">Check</th>
                <th scope="col">Nomor User</th>
                <th scope="col">Nama</th>
                <th scope="col">No HP</th>
                <th scope="col">Alamat</th>
                <th scope="col">Sebagai</th>
                <th scope="col">Tanggal Daftar</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($users as $user)
                <tr>
                    <td><input class="custom-control" wire:model="selected.{{ $user->id }}" value="{{ $user->id }}" type="checkbox"></td>
                    <td>NO : {{ $user->id }}<br>NIK : {{ $user->nik }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->no_hp }}</td>
                    <td>{{ $user->alamat }}</td>
                    <td>@if ($user->role == 2)
                        <span class="badge badge-pill" style="color: rgb(38, 94, 215); background-color: rgb(231, 235, 245);">Admin</span> 
                        @elseif ($user->role == 3)
                        <span class="badge badge-pill" style="color: rgb(241, 80, 80); background-color: rgb(231, 235, 245);">Dokter</span> 
                         @else
                         <span class="badge badge-pill" style="color: rgb(0, 0, 0); background-color: rgb(231, 235, 245);">Pasien</span> 
                          @endif
                    </td>
                    <td>{{ $user->created_at->format('d F Y') }}</td>
                    <td>
                        <div class="table-actions">
                            <a wire:click="setIDCard({{ $user->id }})" data-toggle="modal" data-target="#Cetak" data-color="#ff9500" style="color: rgb(255, 149, 0);"><i class="icon-copy dw dw-id-card2"></i></a>
                            <a wire:click="setEdit({{ $user->id }})" data-toggle="modal" data-target="#Edit"  data-color="#265ed7" style="color: rgb(38, 94, 215);"><i class="icon-copy dw dw-edit2"></i></a>
                            <a wire:click="removeShow({{ $user->id }}, '{{ $user->name }}')" data-toggle="modal" data-target="#Delete" href="#" data-color="#e95959" style="color: rgb(233, 89, 89);"><i class="icon-copy dw dw-delete-3"></i></a>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
          </table>
          <div class="mx-auto" style="width: 200px;">
              {{ $users->links() }}
          </div>
        </div>
        </div>
</div>
