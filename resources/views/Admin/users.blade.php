@extends('Layouts.dashboard')

@section('header')
<div class="pd-ltr-20 xs-pd-20-10">
    <div class="title">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="title">
                        <h4>Daftar Users</h4>
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
                                Daftar Users
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
</div>
@endsection

@section('container')
<style type="text/css">
    .scrolls {
        display: inline-block;
        max-width: 100%;
        height: 100%;
        width: 100%;
        overflow: auto;
    }
    </style>
@livewire('daftar-user')
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
        window.addEventListener('deleteMassHide', event => {
            $('#MassDelete').modal('hide');
        });
    </script>
@endsection