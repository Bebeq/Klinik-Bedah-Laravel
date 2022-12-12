
<!DOCTYPE html>
<html>
	<head>
        <!-- Basic Page Info -->
        <meta charset="utf-8" />
        <title>{{ $settings->where('nama', 'title')->first()->keterangan }} - Login</title>

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
		<nav class="navbar navbar-expand-sm navbar-light bg-light mb-2">
			<a class="navbar-brand h3" href="#"><i class="h3 dw dw-stethoscope mt-1"></i> {{ $settings->where('nama', 'logo')->first()->keterangan }}</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-collapse">☰</button> 
			<div class="collapse navbar-collapse" id="navbar-collapse">
				<ul class="nav navbar-nav ml-auto">
					<li class="nav-item {{ Route::is('auth.login.index') ? 'active' : '' }}"> <a class="nav-link" href="{{ route('auth.login.index') }}">Login</a>
					</li>
					<li class="nav-item {{ Route::is('auth.register.index') ? 'active' : '' }}"> <a class="nav-link" href="{{ route('auth.register.index') }}">Register</a>
					</li>
				</ul>
			</div>
		</nav>
			@yield('container')
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
