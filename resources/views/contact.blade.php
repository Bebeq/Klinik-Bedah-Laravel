@extends('Layouts/landing')
@section('container')
    <!-- Page Header Start -->
    <div class="container-fluid page-header mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container">
            <h1 class="display-3 mb-4 animated slideInDown">Contact</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Pages</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Contact</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->
       <!-- Contact Start -->
       <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5">

                <div class="col-lg-4">
                    <div class="h-100 bg-light rounded d-flex align-items-center p-5">
                        <div class="d-flex flex-shrink-0 align-items-center justify-content-center rounded-circle bg-white"
                            style="width: 50px; height: 50px;">
                            <i class="fa fa-map-marker text-primary"></i>
                        </div>
                        <div class="ms-2">
                            <p class="mb-2">Alamat</p>
                            <h5 class="mb-0">Gg. Buntu, Mlati Lor, Kec. Kota, Kab. Kudus</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="h-100 bg-light rounded d-flex align-items-center p-5">
                        <div class="d-flex flex-shrink-0 align-items-center justify-content-center rounded-circle bg-white"
                            style="width: 50px; height: 50px;">
                            <i class="fa fa-phone text-primary"></i>
                        </div>
                        <div class="ms-2">
                            <p class="mb-2">Telepon</p>
                            <h5 class="mb-0">085727928601</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="h-100 bg-light rounded d-flex align-items-center p-5">
                        <div class="d-flex flex-shrink-0 align-items-center justify-content-center rounded-circle bg-white"
                            style="width: 50px; height: 50px;">
                            <i class="fa fa-envelope-open text-primary"></i>
                        </div>
                        <div class="ms-2">
                            <p class="mb-2">Email</p>
                            <h5 class="mb-0">klinikbedahmelati@gmail.com</h5>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12 wow fadeIn" data-wow-delay="0.5s" style="min-height: 450px;">
                    <div class="position-relative rounded overflow-hidden h-100">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d1665.6750956898895!2d110.85317260058565!3d-6.810498222192564!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e70c5fc5119be01%3A0x5cc04ea42970807e!2sKlinik%20Bedah%20dr%20Rosich%20Attaqi%2CSp.B!5e0!3m2!1sen!2sbd!4v1670877891785!5m2!1sen!2sbd"
                            width="1300" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- Contact End -->
@endsection