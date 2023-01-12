<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>{{ $settings['judul'] }}</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="{{ asset('assets') }}/img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('assets') }}/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('assets') }}/css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Topbar Start -->
    <div class="container-fluid">
        <div class="row bg-secondary py-2 px-xl-5">
            <div class="col-lg-6 d-none d-lg-block">
                {{-- <div class="d-inline-flex align-items-center">
                    <a class="text-dark" href="">FAQs</a>
                    <span class="text-muted px-2">|</span>
                    <a class="text-dark" href="">Help</a>
                    <span class="text-muted px-2">|</span>
                    <a class="text-dark" href="">Support</a>
                </div> --}}
            </div>
            <div class="col-lg-6 text-center text-lg-right">
                <div class="d-inline-flex align-items-center">
                    <a class="text-dark px-2" href="{{ $settings['facebook'] }}">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a class="text-dark px-2" href="https://wa.me/62{{ $settings['whatsapp'] }}">
                        <i class="fab fa-whatsapp"></i>
                    </a>
                    {{-- <a class="text-dark px-2" href="">
                        <i class="fab fa-linkedin-in"></i>
                    </a> --}}
                    <a class="text-dark px-2" href="{{ $settings['instagram'] }}">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a class="text-dark pl-2" href="{{ $settings['youtube'] }}">
                        <i class="fab fa-youtube"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="row align-items-center py-3 px-xl-5">
            <div class="col-lg-9 d-none d-lg-block">
                <a href="{{ url('') }}" class="text-decoration-none">
                    <h1 class="m-0 display-5 font-weight-semi-bold"><span
                            class="text-primary font-weight-bold border px-3 mr-1">{{ substr($settings['judul'], 0, 1) }}</span>{{ $settings['judul'] }}
                    </h1>
                </a>
            </div>
            {{-- <div class="col-lg-6 col-6 text-left">
                <form action="">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search for products">
                        <div class="input-group-append">
                            <span class="input-group-text bg-transparent text-primary">
                                <i class="fa fa-search"></i>
                            </span>
                        </div>
                    </div>
                </form>
            </div> --}}
            <div class="col-lg-3 col-12 text-right">
                <a href="" class="btn border" data-toggle="modal" data-target="#exampleModal">
                    <i class="fas fa-shopping-cart text-primary"></i>
                    <span class="badge">{{ Session::has('cart') ? COUNT(Session::get('cart')) : 0 }}</span>
                </a>
            </div>
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <div class="container-fluid">
        <div class="row border-top px-xl-5">
            <div class="col-lg-3 d-none d-lg-block">
                <a class="btn shadow-none d-flex align-items-center justify-content-between bg-primary text-white w-100"
                    data-toggle="collapse" href="#navbar-vertical"
                    style="height: 65px; margin-top: -1px; padding: 0 30px;">
                    <h6 class="m-0">Kategori</h6>
                    <i class="fa fa-angle-down text-dark"></i>
                </a>
                <nav class="collapse position-absolute navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0 bg-light"
                    id="navbar-vertical" style="width: calc(100% - 30px); z-index: 1;">
                    <div class="navbar-nav w-100 overflow-hidden" style="height: auto">
                        @foreach ($category as $item)
                            <a href="" class="nav-item nav-link">{{ $item->name }}</a>
                        @endforeach
                    </div>
                </nav>
            </div>
            <div class="col-lg-9">
                <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0">
                    <a href="" class="text-decoration-none d-block d-lg-none">
                        <h1 class="m-0 display-5 font-weight-semi-bold"><span
                                class="text-primary font-weight-bold border px-3 mr-1">{{ substr($settings['judul'], 0, 1) }}</span>{{ $settings['judul'] }}
                        </h1>
                    </a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav mr-auto py-0">
                            <a href="{{ url('') }}" class="nav-item nav-link">Home</a>
                            <a href="{{ route('landing.aboutus') }}" class="nav-item nav-link">Tentang</a>
                            <a href="{{ route('landing.caraorder') }}" class="nav-item nav-link">Cara Order</a>
                        </div>
                        {{-- <div class="navbar-nav ml-auto py-0">
                            <a href="" class="nav-item nav-link">Login</a>
                            <a href="" class="nav-item nav-link">Register</a>
                        </div> --}}
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <!-- Navbar End -->


    <!-- Page Header Start -->
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">{{ $settings['judul'] }}</h1>
            <div class="d-inline-flex">
                <p class="m-0">{{ $settings['sub_judul'] }}</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    @yield('content')


    <!-- Footer Start -->
    <div class="container-fluid bg-secondary text-dark mt-5 pt-5">
        <div class="row px-xl-5 pt-5">
            <div class="col-lg-12 col-md-12 mb-5 pr-3 pr-xl-5">
                <a href="" class="text-decoration-none">
                    <h1 class="mb-4 display-5 font-weight-semi-bold"><span
                            class="text-primary font-weight-bold border border-white px-3 mr-1">{{ substr($settings['judul'], 0, 1) }}</span>{{ $settings['judul'] }}
                    </h1>
                </a>
                <p class="mb-2"><i
                        class="fa fa-map-marker-alt text-primary mr-3"></i>{{ $settings['alamat'] }}</p>
                <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>{{ $settings['email'] }}
                </p>
                <p class="mb-0"><i
                        class="fa fa-phone-alt text-primary mr-3"></i>{{ $settings['whatsapp'] }}</p>
            </div>
        </div>
        <div class="row border-top border-light mx-xl-5 py-4">
            <div class="col-md-6 px-xl-0">
                <p class="mb-md-0 text-center text-md-left text-dark">
                    &copy; <a class="text-dark font-weight-semi-bold" href="#">{{ $settings['footer'] }}</a>. All
                    Rights Reserved.
                    Designed
                    by
                    <a class="text-dark font-weight-semi-bold" href="https://htmlcodex.com">HTML Codex</a><br>
                    Distributed By <a href="https://themewagon.com" target="_blank">ThemeWagon</a>
                </p>
            </div>
            <div class="col-md-6 px-xl-0 text-center text-md-right">
                <img class="img-fluid" src="{{ asset('assets') }}/img/payments.png" alt="">
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js">
    </script>
    <script src="{{ asset('assets') }}/lib/easing/easing.min.js"></script>
    <script src="{{ asset('assets') }}/lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Contact Javascript File -->
    <script src="{{ asset('assets') }}/mail/jqBootstrapValidation.min.js"></script>
    <script src="{{ asset('assets') }}/mail/contact.js"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('assets') }}/js/main.js"></script>
    @yield('script')
</body>

</html>
