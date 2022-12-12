@extends('Layouts.dashboard')

@section('box')
@endsection

@section('header')
<div class="pd-ltr-20 xs-pd-20-10">
    <div class="title">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="title">
                        <h4>Daftar Pasien</h4>
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
                                Daftar Pasien
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
</div>
@endsection

@section('container')
@livewire('daftar-pasien')
@endsection

@section('javascript')
    <script>
        window.addEventListener('addHide', event => {
            $('#Add').modal('hide');
        });
        window.addEventListener('editHide', event => {
            $('#Edit').modal('hide');
        });
        window.addEventListener('deleteHide', event => {
            $('#Delete').modal('hide');
        });
    </script>
@endsection