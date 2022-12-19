@extends('Layouts/landing')
@section('container')
       <!-- Page Header Start -->
       <div class="container-fluid page-header mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container">
            <h1 class="display-3 mb-4 animated slideInDown">Services</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Pages</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Services</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Service Start -->
    <div class="container-xxl service py-5">
        <div class="container">
            <div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                <h1 class="display-5 mb-5">Our Surgery Service</h1>
            </div>
            <div class="row g-4 wow fadeInUp" data-wow-delay="0.3s">
                <div class="col-lg-4">
                    <div class="nav nav-pills d-flex justify-content-between w-100 h-100 me-4">
                        <button class="nav-link w-100 d-flex align-items-center text-start border p-4 mb-4 active"
                            data-bs-toggle="pill" data-bs-target="#tab-pane-1" type="button">
                            <h5 class="m-0"><i class="fa fa-bars text-primary me-3"></i>Hernia</h5>
                        </button>
                        <button class="nav-link w-100 d-flex align-items-center text-start border p-4 mb-4"
                            data-bs-toggle="pill" data-bs-target="#tab-pane-2" type="button">
                            <h5 class="m-0"><i class="fa fa-bars text-primary me-3"></i>Hemoroid</h5>
                        </button>
                        <button class="nav-link w-100 d-flex align-items-center text-start border p-4 mb-4"
                            data-bs-toggle="pill" data-bs-target="#tab-pane-3" type="button">
                            <h5 class="m-0"><i class="fa fa-bars text-primary me-3"></i>Tumor Mamme</h5>
                        </button>
                        <button class="nav-link w-100 d-flex align-items-center text-start border p-4 mb-0"
                            data-bs-toggle="pill" data-bs-target="#tab-pane-4" type="button">
                            <h5 class="m-0"><i class="fa fa-bars text-primary me-3"></i>Tumor Colli</h5>
                        </button>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="tab-content w-100">
                        <!--Tab 1-->
                        <div class="tab-pane fade show active" id="tab-pane-1">
                            <div class="row g-4">
                                <div class="col-md-6" style="min-height: 350px;">
                                    <div class="position-relative h-100">
                                        <img class="position-absolute rounded w-100 h-100" src="{{ asset('Home/img/hernia.jpg') }}"
                                            style="object-fit: cover;" alt="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h3 class="mb-4">Hernia</h3>
                                    <p class="mb-4" align="justify">
                                        Suatu tonjolan dari suatu organ atau jaringan melalui bukaan
                                        abnormal. Hernia biasanya meilbatkan perut atau usus. Gejala termasuk
                                        tonjolan, bengkak, atau sakit. Dalam beberapa kasus, tidak aada gejala.
                                        Pengobatan termasuk memantau kondisi. Jika diperlukan, operasi dapat
                                        mengembalikan jaringan ke lokasi dan menutup bukaan.
                                    </p>
                                    <p><i class="fa fa-check text-primary me-3"></i>Harga : Rp. 4 - 6 Juta Rupiah</p>
                                    <p><i class="fa fa-check text-primary me-3"></i>Proses Operasi : 30 – 60 Menit</p>
                                    <p><i class="fa fa-check text-primary me-3"></i>Proses Penyembuhan : 2 - 6 Minggu
                                    </p>

                                </div>
                            </div>
                        </div>
                        <!--Tab 2-->
                        <div class="tab-pane fade show" id="tab-pane-2">
                            <div class="row g-4">
                                <div class="col-md-6" style="min-height: 350px;">
                                    <div class="position-relative h-100">
                                        <img class="position-absolute rounded w-100 h-100" src="{{ asset('Home/img/hemoroid.jpg') }}"
                                            style="object-fit: cover;" alt="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h3 class="mb-4">Hemoroid</h3>
                                    <p class="mb-4" align="justify">
                                        Vena bengkak dan meradang di rectum dan anus yang menyebabkan ketidaknyamaman
                                        dan pendarahan. Wasir biasanya terjadi karena mengejang saat buang air besar,
                                        obesitas, atau kehamilan. Gejala umum yaitu ketidaknyamanan, terutama saat buang
                                        air besar atau ketika duduk. Gejala lainnya yaitu gagal dan pendarahan.
                                    </p>
                                    <p><i class="fa fa-check text-primary me-3"></i>Harga : Rp. 3 - 7 Juta Rupiah</p>
                                    <p><i class="fa fa-check text-primary me-3"></i>Proses Operasi : 1 - 2 Jam</p>
                                    <p><i class="fa fa-check text-primary me-3"></i>Proses Penyembuhan : 2 - 3 Minggu
                                    </p>

                                </div>
                            </div>
                        </div>
                        <!--Tab 3-->
                        <div class="tab-pane fade show" id="tab-pane-3">
                            <div class="row g-4">
                                <div class="col-md-6" style="min-height: 350px;">
                                    <div class="position-relative h-100">
                                        <img class="position-absolute rounded w-100 h-100" src="{{ asset('Home/img/tumormamme.jpg') }}"
                                            style="object-fit: cover;" alt="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h3 class="mb-4">Tumor Mamme</h3>
                                    <p class="mb-4" align="justify">
                                        Suatu kanker yang terbentuk di sel – sel payudara. Kanker payudara dapat terjadi
                                        pada Wanita dan jarang pada pria. Gejala kanker payudara termasuk benjolan di
                                        payudara, keluarnya cairan berdarah dari putting, dan perubahan bentuk atau
                                        tekstur putting atau payudara. Penanganan tergantung pada stadium kanker.
                                    </p>
                                    <p><i class="fa fa-check text-primary me-3"></i>Harga : Rp. 7 - 15 Juta Rupiah</p>
                                    <p><i class="fa fa-check text-primary me-3"></i>Proses Operasi : 1 - 2 Jam</p>
                                    <p><i class="fa fa-check text-primary me-3"></i>Proses Penyembuhan : 6 - 8 Minggu
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!--Tab 4-->
                        <div class="tab-pane fade show" id="tab-pane-4">
                            <div class="row g-4">
                                <div class="col-md-6" style="min-height: 350px;">
                                    <div class="position-relative h-100">
                                        <img class="position-absolute rounded w-100 h-100" src="{{ asset('Home/img/tumorcolli.jpg') }}"
                                            style="object-fit: cover;" alt="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h3 class="mb-4">Tumor Colli</h3>
                                    <p class="mb-4" align="justify">
                                        Tumor colli atau benjolan di leher yang paling umum adalah pembengkakan kelenjar
                                        getah bening. Pembengkakakn ini terjadi ketika tubuh sedang membantu melawqan
                                        infeksi virus atau bakteri, bahkan yang ringan sekalipun. Infeksi virus yang
                                        dapat menyebabkan ini antara lain mononucleosis dan gondongan.
                                    </p>
                                    <p><i class="fa fa-check text-primary me-3"></i>Harga : Rp. 3,5 - 8 Juta Rupiah</p>
                                    <p><i class="fa fa-check text-primary me-3"></i>Proses Operasi : 1 - 2 Jam</p>
                                    <p><i class="fa fa-check text-primary me-3"></i>Proses Penyembuhan : 1 - 3 Bulan
                                    </p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- Service End -->
            </div>
        </div>
        </div>
        </div>
@endsection