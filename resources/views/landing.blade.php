@extends('Layouts/landing')
@section('container')
        <!-- Carousel Start -->
        <div class="container-fluid p-0 mb-5 wow fadeIn" data-wow-delay="0.1s">
            <div id="header-carousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="w-100 " style="max-height: 700px;object-fit:cover;" src="{{asset('Home/foto9.jpg') }}" alt="Image">
                        <div class="carousel-caption">
                            <div class="container">
                                <div class="row justify-content-start">
                                    <div class="col-lg-8">
                                        <h1 class="display-1 mb-4 animated slideInDown">Kesehatan Adalah Mukjizat Tuhan Yang
                                            Nikmat
                                        </h1>
                                        <a href="" class="btn btn-primary py-3 px-5 animated slideInDown">Daftar Berobat</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img class="w-100" style="max-height: 700px;object-fit:cover;" src="{{asset('Home/foto11.jpg') }}" alt="Image">
                        <div class="carousel-caption">
                            <div class="container">
                                <div class="row justify-content-start">
                                    <div class="col-lg-7">
                                        <h1 class="display-1 mb-4 animated slideInDown">Peliharalah kesehatanmu karena ia
                                            yang akan mewadahi umur panjangmu</h1>
                                        <a href="" class="btn btn-primary py-3 px-5 animated slideInDown">Daftar Berobat</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#header-carousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
        <!-- Carousel End -->
    
    
        <!-- About Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="row g-4 align-items-end mb-4">
                    <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                        <img class="img-fluid rounded" src="{{asset('Home/dokter.jpg') }}">
                    </div>
                    <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.3s">
                        <h1 class="display-3 mb-4">Kami Membantu keluhan penyakit Anda</h1>
                        <p class="mb-4">Dia yang sehat memiliki harapan, dan dia yang memiliki harapan memiliki segalanya.
                        </p>
                        <div class="border rounded p-4">
                            <nav>
                                <div class="nav nav-tabs mb-3" id="nav-tab" role="tablist">
                                    <button class="nav-link fw-semi-bold active" id="nav-story-tab" data-bs-toggle="tab"
                                        data-bs-target="#nav-story" type="button" role="tab" aria-controls="nav-story"
                                        aria-selected="true">Story</button>
                                    <button class="nav-link fw-semi-bold" id="nav-mission-tab" data-bs-toggle="tab"
                                        data-bs-target="#nav-mission" type="button" role="tab" aria-controls="nav-mission"
                                        aria-selected="false">Missi</button>
                                    <button class="nav-link fw-semi-bold" id="nav-vision-tab" data-bs-toggle="tab"
                                        data-bs-target="#nav-vision" type="button" role="tab" aria-controls="nav-vision"
                                        aria-selected="false">Visi</button>
                                </div>
                            </nav>
                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-story" role="tabpanel"
                                    aria-labelledby="nav-story-tab">
                                    <p>Klinik Bedah Melati berdiri sejak 22 November 2014. Klinik Bedah Melati dikelola oleh
                                        dr. Rosich Attaqi, Sp. B</p>
                                    <p class="mb-0">Sigap, Inovatif, Aman, Profesional.</p>
                                </div>
                                <div class="tab-pane fade" id="nav-mission" role="tabpanel"
                                    aria-labelledby="nav-mission-tab">
                                    <p>1. Menyelanggarakan pelayanan kesehatan yang bermutu dan terjangkau oleh semua
                                        lapisan masyarakat yang berorientasi pada keselamatan pasien.</p>
                                    <p>2. Berkontribusi kepada negara dengan memberikan pelayanan kesehtan dan mengembangkan
                                        tenaga kesehatan profesional.</p>
                                </div>
                                <div class="tab-pane fade" id="nav-vision" role="tabpanel" aria-labelledby="nav-vision-tab">
                                    <p>Menjadi Klinik Bedah yang memiliki kualitas prima dalam pelayanan, dan pengabdian
                                        kepada masyarakat dibidang kesehatan dengan tenaga medis profesional</p>
    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="border rounded p-4 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="row g-4">
                        <div class="col-lg-4 wow fadeIn" data-wow-delay="0.1s">
                            <div class="h-100">
                                <div class="d-flex">
                                    <div class="flex-shrink-0 btn-lg-square rounded-circle bg-primary">
                                        <i class="fa fa-times text-white"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h4>Tanpa Biaya Tambahan</h4>
                                        <p>Harga Akan Diberitahukan Detail</p>
    
                                    </div>
                                    <div class="border-end d-none d-lg-block"></div>
                                </div>
                                <div class="border-bottom mt-4 d-block d-lg-none"></div>
                            </div>
                        </div>
                        <div class="col-lg-4 wow fadeIn" data-wow-delay="0.3s">
                            <div class="h-100">
                                <div class="d-flex">
                                    <div class="flex-shrink-0 btn-lg-square rounded-circle bg-primary">
                                        <i class="fa fa-users text-white"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h4>Team Profesional</h4>
                                        <p>Team Memiliki Banyak Pengalaman</p>
                                    </div>
                                    <div class="border-end d-none d-lg-block"></div>
                                </div>
                                <div class="border-bottom mt-4 d-block d-lg-none"></div>
                            </div>
                        </div>
                        <div class="col-lg-4 wow fadeIn" data-wow-delay="0.5s">
                            <div class="h-100">
                                <div class="d-flex">
                                    <div class="flex-shrink-0 btn-lg-square rounded-circle bg-primary">
                                        <i class="fa fa-phone text-white"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h4>18/7 Answer Question</h4>
                                        <p>Akan Menjawab Segala Pertanyaan Anda</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- About End -->
    
    
        <!-- Testimonial Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                    <h1 class="display-5 mb-5">Testimoni Pasien</h1>
                </div>
                <div class="owl-carousel testimonial-carousel wow fadeInUp" data-wow-delay="0.3s">
                    <div class="testimonial-item">
                        <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                            <div class="btn-square bg-white border rounded-circle">
                                <i class="fa fa-quote-right fa-2x text-primary"></i>
                            </div>
                            Pelayanan Dokter dan Para Karyawan Klinik Sangat Ramah, Harga Juga Terhitung Murah Dibanding
                            Yang Lainnya
                        </div>
                        <img class="rounded-circle mb-3" src="{{ asset('Home/img/testimonial-1.jpg') }}" alt="">
                        <h4>Melissa Putri</h4>
                        <span>Pasien</span>
                    </div>
                    <div class="testimonial-item">
                        <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                            <div class="btn-square bg-white border rounded-circle">
                                <i class="fa fa-quote-right fa-2x text-primary"></i>
                            </div>
                            Dokter sangat ramah dan sangat peduli dengan kelanjutan pasca operasi diperhatikan betul fase
                            penyembuhan
                        </div>
                        <img class="rounded-circle mb-3" src="{{ asset('Home/img/testimonial-2.jpg') }}" alt="">
                        <h4>Budi Tabuti</h4>
                        <span>Pasien</span>
                    </div>
                    <div class="testimonial-item">
                        <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                            <div class="btn-square bg-white border rounded-circle">
                                <i class="fa fa-quote-right fa-2x text-primary"></i>
                            </div>
                            Walaupun harga tidak seperti yang lainnya tetapi pelayanan yang diberikan tetap maksimal
                            selayaknya pada Klinik Besar
                        </div>
                        <img class="rounded-circle mb-3" src="{{ asset('Home/img/testimonial-3.jpg') }}" alt="">
                        <h4>Maria Forger</h4>
                        <span>Pasien</span>
                    </div>
                </div>
            </div>
            <!-- Testimonial End -->
    
        </div>
@endsection