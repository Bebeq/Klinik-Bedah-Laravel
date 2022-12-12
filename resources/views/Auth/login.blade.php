@extends('LayoutsLanding.layout')
@section('container')
<div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
<div class="container">
	<div class="row align-items-center">
		<div class="col-md-6 col-lg-7">
			<img src="{{ asset('vendors/images/medicine-bro.svg') }}" alt="" />
		</div>
		<div class="col-md-6 col-lg-5">
			<div class="login-box bg-white box-shadow border-radius-10">
				<div class="login-title">
					<h2 class="text-center text-info">Login <span class="text-dark">{{ $settings->where('nama', 'title')->first()->keterangan }}</span></h2>
				</div>
				@if (session('success'))
					<div class="alert alert-success"><i class="fa fa-check"></i>
						{!! session('success') !!}
					</div>
				@endif
				@if($errors->any())
					<div class="alert alert-danger"><i class="icon-copy fa fa-exclamation-triangle" aria-hidden="true"></i>
						{!! $errors->first() !!}
					</div>
				@endif
				
				<form action="{{ route('auth.login.store') }}" method="post">
					@csrf
					<div class="input-group custom">
						<input type="text" name="no_hp" class="form-control form-control-lg @error('no_hp') form-control-danger @enderror" placeholder="085123456789" />
						@error('no_hp')
						@else
						<div class="input-group-append custom">
							<span class="input-group-text"><i class="icon-copy dw dw-phone-call"></i></span>
						</div>
						@enderror
					</div>
					<div class="input-group custom">
						<input
							type="password"
							class="form-control form-control-lg @error('password') form-control-danger @enderror"
							placeholder="**********"
							name="password"
						/>
						@error('password')
						@else
						<div class="input-group-append custom">
							<span class="input-group-text"
								><i class="dw dw-padlock1"></i
							></span>
						</div>
						@enderror
					</div>
					<div class="row pb-30">
						<div class="col-6">
							<div class="custom-control custom-checkbox">
								<input
									type="checkbox"
									class="custom-control-input"
									id="customCheck1"
									name="remember"
								/>
								<label class="custom-control-label" for="customCheck1"
									>Remember</label
								>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<div class="input-group mb-0">
								<!--
								use code for form submit
								<input class="btn btn-primary btn-lg btn-block" type="submit" value="Sign In">
							-->
								<button type="submit" class="btn btn-primary btn-lg btn-block">Sign In</button>
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
									href="{{ route('auth.register.index') }}"
									>Register To Create Account</a
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