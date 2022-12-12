<link rel="stylesheet" type="text/css" href="{{ asset('vendors/styles/core.css') }}" />
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet"/>
@if($users->count() > 0)
<body onload="window.print()">
<div class="row">
@php $length = 0 @endphp
@isset($gap)
    @foreach (range(1,$gap) as $var)
        @php $length = $length + 1 @endphp
        <div class="col-6">
            <div class="m-2" style="width: 450px; height: 260px;">
            </div>
        </div>
        @if ($length % 10)
        @else
        <div class="col-12">
            <div style="height: 128px;">
            </div>
        </div>
        @endif
    @endforeach
@endisset
@foreach ($users as $user)
<div class="col-6">
    <div class="card border-dark m-2" style="width: 450px; height: 260px;border: 3px solid black;">
        <div class="text-center mt-2" style="margin-bottom : -0.2rem;font-size : 20px">Klinik Bedah <strong>"Melati"</strong></div>
        <div class="text-center font-weight-bold" style="margin-bottom : -0.2rem;">Ds. Pramugara Niaga Rt.01/Rw.01</div>
        <div class="text-center font-weight-bold" style="font-size : 15px">Telp. 085155221416</div>
        <hr style="border-color: #343a40;margin-top : 0.5rem;margin-bottom : 0.2rem;border: 1px solid black;">
        <hr style="border-color: #343a40;margin-top : 0.1rem;border: 1px solid black;">
        <span class="ml-3 mb-2 font-weight-bold" style="font-size : 18px">Nama&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;<span style="font-weight: 500;">&nbsp;{{ \Illuminate\Support\Str::limit($user->name, 33) }}</span></span>
        <span class="ml-3 mb-2 font-weight-bold" style="font-size : 18px">Alamat&nbsp;&nbsp;:&nbsp;<span style="font-weight: 500;">&nbsp;{{ \Illuminate\Support\Str::limit($user->alamat, 33) }}</span></span>
        <span class="ml-3 mb-2 font-weight-bold" style="font-size : 18px">NO. RM&nbsp;:&nbsp;<span style="font-weight: 500;">&nbsp;{{ $user->id }}</span></span>
        <span class="ml-3 mt-2 mb-2 font-weight-bold text-center" style="font-size : 15px">Harap dibawa setiap kali periksa</span>
    </div>
</div> 
@php $length = $length + 1 @endphp
@if ($length % 10)
@else
<div class="col-12">
    <div style="height: 128px;">
    </div>
</div>
@endif
@endforeach
</div>
</body>
@else
<div class="container">
    <div class="alert alert-warning mt-3">Coba ulangi kembali, tidak ada data kartu yang di input.</div>
</div>
@endif
