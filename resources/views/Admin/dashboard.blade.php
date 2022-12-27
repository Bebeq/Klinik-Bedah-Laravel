@extends('Layouts.dashboard')
@section('header')
@endsection
@section('container')
<div class="pd-ltr-20 xs-pd-20-10">
<div class="row pb-10">
    <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
        <div class="card-box height-100-p widget-style3">
            <div class="d-flex flex-wrap">
                <div class="widget-data">
                    <div class="weight-700 font-24 text-dark">{{ $users }}</div>
                    <div class="font-14 text-secondary weight-500">
                        Total Pengguna
                    </div>
                </div>
                <div class="widget-icon">
                    <div class="icon" data-color="#00eccf" style="color: rgb(0, 236, 207);">
                        <i class="fa fa-user-o" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
        <div class="card-box height-100-p widget-style3">
            <div class="d-flex flex-wrap">
                <div class="widget-data">
                    <div class="weight-700 font-24 text-dark">{{ $antrians }}</div>
                    <div class="font-14 text-secondary weight-500">
                        Total Antrian Keseluruhan
                    </div>
                </div>
                <div class="widget-icon">
                    <div class="icon">
                        <i class="icon-copy fa fa-stethoscope" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
        <div class="card-box height-100-p widget-style3">
            <div class="d-flex flex-wrap">
                <div class="widget-data">
                    <div class="weight-700 font-24 text-dark">{{ $antrians_selesai }}</div>
                    <div class="font-14 text-secondary weight-500">
                        Total Antrian Selesai
                    </div>
                </div>
                <div class="widget-icon">
                    <div class="icon">
                        <div class="icon" data-color="#ff5b5b" style="color: rgb(255, 91, 91);">
                        <span class="icon-copy ti-heart"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
        <div class="card-box height-100-p widget-style3">
            <div class="d-flex flex-wrap">
                <div class="widget-data">
                    <div class="weight-700 font-24 text-dark">@currency($pendapatan)</div>
                    <div class="font-14 text-secondary weight-500">Total Pendapatan</div>
                </div>
                <div class="widget-icon">
                    <div class="icon" data-color="#09cc06" style="color: rgb(9, 204, 6);">
                        <i class="icon-copy fa fa-money" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <div class="bg-white pd-20 card-box mb-30" style="position: relative;">
    <div id="chart"></div>
    </div>
</div>
@endsection

@section('javascript')
    <script>
        var options2 = {
	series: [{
		name: 'Hadir',
		data: [@foreach ($antrians_hadir as $antrian_hadir)"{{ $antrian_hadir->total }}",@endforeach]
	}, {
		name: 'Tidak Hadir',
		data: [@foreach ($antrians_tidakhadir as $antrian_tidakhadir)"{{ $antrian_tidakhadir->total }}",@endforeach]
	}],
	chart: {
		height: 350,
		type: 'area',
		toolbar: {
			show: false,
		}
	},
	grid: {
		show: false,
		padding: {
			left: 0,
			right: 0
		}
	},
	dataLabels: {
		enabled: false
	},
	stroke: {
		curve: 'smooth'
	},
	xaxis: {
		type: 'datetime',
		categories: [@foreach ($antrians_log as $antrian_log)"{{ Carbon\Carbon::parse($antrian_log->date)->format('Y-m-d')." 00:00:00" }}",@endforeach]
	},
	tooltip: {
		x: {
			format: 'dd/MM/yy HH:mm'
		},
	},
};
var chart = new ApexCharts(document.querySelector("#chart"), options2);
chart.render();
    </script>
@endsection