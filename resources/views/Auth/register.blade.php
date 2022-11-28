
<!DOCTYPE html>
<html>
	<head>
        <!-- Basic Page Info -->
        <meta charset="utf-8" />
        <title>DeskApp - Bootstrap Admin Dashboard HTML Template</title>

        <!-- Site favicon -->
        <link rel="apple-touch-icon" sizes="180x180" href="vendors/images/apple-touch-icon.png" />
        <link rel="icon" type="image/png" sizes="32x32" href="vendors/images/favicon-32x32.png" />
        <link rel="icon" type="image/png" sizes="16x16" href="vendors/images/favicon-16x16.png" />

        <!-- Mobile Specific Metas -->
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

        <!-- Google Font -->
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet"
        />
        <!-- CSS -->
        <link rel="stylesheet" type="text/css" href="{{ asset('vendors/styles/core.css') }}" />
        <link rel="stylesheet" type="text/css" href="{{ asset('vendors/styles/icon-font.min.css') }}" />
        <link rel="stylesheet" type="text/css" href="{{ asset('src/plugins/datatables/css/dataTables.bootstrap4.min.css') }}" />
        <link rel="stylesheet" type="text/css" href="{{ asset('src/plugins/datatables/css/responsive.bootstrap4.min.css') }}" />
        <link rel="stylesheet" type="text/css" href="{{ asset('vendors/styles/style.css') }}" />

        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script
            async
            src="https://www.googletagmanager.com/gtag/js?id=G-GBZ3SGGX85"
        ></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag() {
                dataLayer.push(arguments);
            }
            gtag("js", new Date());

            gtag("config", "G-GBZ3SGGX85");
        </script>
        <!-- Google Tag Manager -->
        <script>
            (function (w, d, s, l, i) {
                w[l] = w[l] || [];
                w[l].push({ "gtm.start": new Date().getTime(), event: "gtm.js" });
                var f = d.getElementsByTagName(s)[0],
                    j = d.createElement(s),
                    dl = l != "dataLayer" ? "&l=" + l : "";
                j.async = true;
                j.src = "https://www.googletagmanager.com/gtm.js?id=" + i + dl;
                f.parentNode.insertBefore(j, f);
            })(window, document, "script", "dataLayer", "GTM-NXZMQSS");
        </script>
        <!-- End Google Tag Manager -->
        </head>

	<body class="login-page">
		<div class="login-header box-shadow">
			<div
				class="container-fluid d-flex justify-content-between align-items-center"
			>
				<div class="brand-logo">
					<a href="login.html">
						<img src="{{ asset('vendors/images/deskapp-logo.svg') }}" alt="" />
					</a>
				</div>
			</div>
		</div>
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
								<h2 class="text-center text-info">Register To {{ env('WEB_TITLE') }}</h2>
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
		</div>
		<!-- js -->
		<script src="{{ asset('vendors/scripts/core.js') }}"></script>
		<script>
			$('#success-modal').modal('show'); 
			</script>
		<script src="{{ asset('vendors/scripts/script.min.js') }}"></script>
		<script src="{{ asset('vendors/scripts/process.js') }}"></script>
		<script src="{{ asset('vendors/scripts/layout-settings.js') }}"></script>
		<script src="{{ asset('src/plugins/apexcharts/apexcharts.min.js') }}"></script>
		<script src="{{ asset('src/plugins/datatables/js/jquery.dataTables.min.js') }}"></script>
		<script src="{{ asset('src/plugins/datatables/js/dataTables.bootstrap4.min.js') }}"></script>
		<script src="{{ asset('src/plugins/datatables/js/dataTables.responsive.min.js') }}"></script>
		<script src="{{ asset('src/plugins/datatables/js/responsive.bootstrap4.min.js') }}"></script>
		<script src="{{ asset('vendors/scripts/dashboard3.js') }}"></script>
		<!-- Google Tag Manager (noscript) -->
		<noscript
			><iframe
				src="https://www.googletagmanager.com/ns.html?id=GTM-NXZMQSS"
				height="0"
				width="0"
				style="display: none; visibility: hidden"
			></iframe
		></noscript>
		<!-- End Google Tag Manager (noscript) -->
	</body>
</html>
