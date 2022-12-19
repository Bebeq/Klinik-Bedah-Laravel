<link rel="stylesheet" href="{{ asset('vendors/styles/core.css') }}" >
<link rel="stylesheet" href="{{ asset('vendors/styles/invoice.css') }}" >
<link rel="stylesheet" type="text/css" href="{{ asset('vendors/styles/icon-font.min.css') }}" />
<style>
    table,tr, th, td {
    border: solid black 2px;
    }
</style>

<div class="container" style="border : 1px solid;">
    <div class="row gutters">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card">
                    <div class="card-body p-0">
                        <div class="invoice-container">
                            <div class="invoice-header">
                                <!-- Row start -->
                                <!-- Row end -->
                                <!-- Row start -->
                                <div class="row">
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                        <span class="invoice-logo navbar-brand mb-0 h3 ml-1"><i class="invoice-logo h3 dw dw-stethoscope"></i> {{ $settings->where('nama', 'logo')->first()->keterangan }}</span>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 mt-4">
                                        <address class="text-right">
                                            {{ $settings->where('nama','alamat')->first()->keterangan }} <br>
                                            {{ $settings->where('nama','email')->first()->keterangan }} <br>
                                            {{ $settings->where('nama','no_hp')->first()->keterangan }}
                                        </address>
                                    </div>
                                </div>
                                <!-- Row end -->
                                <!-- Row start -->
                                <div class="row gutters">
                                    <div class="col-6">
                                        <div class="invoice-details">
                                            <address class="font-weight-bold">
                                                Nama : {{ $pembayaran->user->name }}<br>
                                                Alamat : {{ $pembayaran->user->alamat }}<br>
                                                NO RM : {{ $pembayaran->user->id }}<br>
                                            </address>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="invoice-details">
                                            <div class="invoice-num">
                                                <div>Invoice - <span class="font-weight-bold">#{{ $pembayaran->no_pembayaran }}</span></div>
                                                <div>{{ Carbon\Carbon::create($pembayaran->tanggal_pembayaran)->format('d F Y') }}</div>
                                            </div>
                                        </div>													
                                    </div>
                                </div>
                                <!-- Row end -->
                            </div>
                            <div class="invoice-body">
                                <!-- Row start -->
                                <div class="row gutters">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <th class="text-center" style="width: 70%">Layanan</th>
                                                        <th class="text-center">Biaya Layanan</th>
                                                    </tr>
                                                    <tr>
                                                        <th>Biaya Dokter</th>
                                                        <td>@currency($pembayaran->biaya_dokter)</td> 
                                                    </tr>
                                                    <tr>
                                                        <th>Biaya Obat</th>
                                                        <td>@currency($pembayaran->biaya_obat)</td> 
                                                    </tr>
                                                    <tr>
                                                        <th>Biaya Tindakan</th>
                                                        <td>@currency($pembayaran->biaya_tindakan)</td> 
                                                    </tr>
                                                    <tr>
                                                        <th>Biaya Lainnya</th>
                                                        <td>@currency($pembayaran->biaya_lain)</td> 
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <h5 class="text-success"><strong>Total Biaya</strong></h5>
                                                        </td>			
                                                        <td>
                                                            <h5 class="text-success"><strong>@currency($pembayaran->biaya_jumlah)</strong></h5>
                                                        </td>	
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <!-- Row end -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>