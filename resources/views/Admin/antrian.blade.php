@extends('Layouts.dashboard')
@section('header')
<div class="pd-ltr-20 xs-pd-20-10">
    <div class="title">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="title">
                        <h4>Daftar Antrian</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item">
                                Admin
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Daftar Antrian
                            </li>
                        </ol>
                    </nav>
                </div>
                
            </div>
        </div>
</div>
@endsection

@section('container')
@livewire('daftar-antrian')
@endsection

@section('javascript')
    <script>
        window.addEventListener('addHide', event => {
            $('#Add').modal('hide');
        })
    </script>
    
@endsection