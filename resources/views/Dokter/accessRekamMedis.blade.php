@extends('Layouts.dashboard')
@section('box')
@if(Session::has('errors'))
        <div class="modal fade" id="alert-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm modal-dialog-centered">
                <div class="modal-content bg-danger text-white">
                    <div class="modal-body text-center">
                        <h3 class="text-white mb-15">
                            <i class="fa fa-exclamation-triangle"></i> Error!
                        </h3>
                        <p>
                            {{Session::get('errors')->first()}}
                        </p>
                        <button
                            type="button"
                            class="btn btn-light"
                            data-dismiss="modal"
                        >
                            Ok
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
    @if(session()->has('success'))
        <div class="modal fade" id="success-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body text-center font-18">
                        <h3 class="mb-20">Berhasil !</h3>
                        <div class="mb-30 text-center">
                            <img src="{{ asset('vendors/images/success.png') }}" />
                        </div>
                        {{ session()->get('success') }}
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-primary"data-dismiss="modal"> Done </button>
                    </div>
                </div>
            </div>
        </div>
    @endif

@endsection
@section('container')
@livewire('rekam-medis')
@endsection

@section('javascript')
    @if(session()->has('success'))
        <script>
            $(document).ready(function(){
                $("#success-modal").modal('show');
            });
        </script>
    @endif
    @if(session()->has('errors'))
        <script>
            $(document).ready(function(){
                $("#alert-modal").modal('show');
            });
        </script>
    @endif

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
