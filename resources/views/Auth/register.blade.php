@extends('LayoutsLanding.layout')
@section('container')
		<div
			class="login-wrap d-flex align-items-center flex-wrap justify-content-center"
		>
			<div class="container">
				<div class="row align-items-center">
					<div class="col-md-6 col-lg-7">
						<img src="{{ asset('vendors/images/register-page-img.png') }}" alt="" />
					</div>
					<div class="col-md-6 col-lg-5">
						<div class="login-box bg-white box-shadow border-radius-10">
							<div class="login-title">
								<h2 class="text-center text-info">Register <span class="text-dark">{{ $settings->where('nama', 'title')->first()->keterangan }}</span></h2>
							</div>
							@if (session('success'))
								<div class="alert alert-success"><i class="fa fa-check"></i>
									{!! session('success') !!}
								</div>
							@endif
							@if($errors->any())
								<div class="alert alert-danger">
									<span class="font-weight-bold"><i class="icon-copy fa fa-exclamation-triangle" aria-hidden="true"></i> Masukkanlah data dengan benar!</span>
									@foreach ($errors->all() as $error)
										<li>{{ $error }}</li>
									@endforeach
									</div>
							@endif
							
							<form action="{{ route('auth.register.store') }}" method="post">
								@csrf
								<div class="input-group custom">
									<input type="number" value="{{ old('no_hp') }}" name="no_hp" class="form-control form-control-lg @error('no_hp') form-control-danger @enderror" placeholder="Masukkan nomor HP aktif" />
									@error('no_hp')
									@else
									<div class="input-group-append custom">
										<span class="input-group-text"><i class="icon-copy dw dw-phone-call"></i></span>
									</div>
									@enderror
								</div>
                                <div class="input-group custom">
									<input type="text" value="{{ old('name') }}" name="name" class="form-control form-control-lg @error('name') form-control-danger @enderror" placeholder="Nama lengkap sesuai KTP" />
									@error('name')
									@else
									<div class="input-group-append custom">
										<span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>
									</div>
									@enderror
								</div>
                                <div class="input-group custom">
									<input type="number" value="{{ old('nik') }}" name="nik" class="form-control form-control-lg @error('nik') form-control-danger @enderror" placeholder="Nomor NIK sesuai KTP" />
									@error('nik')
									@else
									<div class="input-group-append custom">
										<span class="input-group-text"><i class="icon-copy dw dw-id-card2"></i></span>
									</div>
									@enderror
								</div>
                                <div class="input-group custom">
									<input type="text" value="{{ old('alamat') }}" name="alamat" class="form-control form-control-lg @error('alamat') form-control-danger @enderror" placeholder="Alamat rumah" />
									@error('alamat')
									@else
									<div class="input-group-append custom">
										<span class="input-group-text"><i class="icon-copy dw dw-home"></i></span>
									</div>
									@enderror
								</div>
								<div class="input-group custom">
									<input type="password" class="form-control form-control-lg @error('password') form-control-danger @enderror" placeholder="Masukkan password" name="password" />
									@error('password')
									@else
									<div class="input-group-append custom">
										<span class="input-group-text"
											><i class="dw dw-padlock1"></i
										></span>
									</div>
									@enderror
								</div>
                                <div class="input-group custom">
									<input type="password" class="form-control form-control-lg @error('password') form-control-danger @enderror" placeholder="Masukkan ulang password" name="password_confirmation" />
									@error('password')
									@else
									<div class="input-group-append custom">
										<span class="input-group-text"
											><i class="dw dw-padlock1"></i
										></span>
									</div>
									@enderror
								</div>
								<div class="row">
									<div class="col-sm-12">
										<div class="input-group mb-0">
											<!--
											use code for form submit
											<input class="btn btn-primary btn-lg btn-block" type="submit" value="Sign In">
										-->
											<button type="submit" class="btn btn-primary btn-lg btn-block">Sign Up</button>
										</div>
										<div
											class="font-16 weight-600 pt-10 pb-10 text-center"
											data-color="#707373"
										>
											OR
										</div>
										<div class="input-group mb-0">
											<a
												class="btn btn-outline-primary btn-lg btn-block"
												href="{{ route('auth.login.index') }}"
												>Back To Login</a
											>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			@endsection