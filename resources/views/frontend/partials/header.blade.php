<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{Session::get('judul')}}</title>
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('public/assets-front/css-front/css/font-awesome.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{ asset('public/assets-front/css-front/css/elegant-icons.css')}}" type="text/css">
    <link rel="stylesheet" href="{{ asset('public/assets-front/css-front/css/nice-select.css')}}" type="text/css">
    <link rel="stylesheet" href="{{ asset('public/assets-front/css-front/css/magnific-popup.css')}}" type="text/css">
    <link rel="stylesheet" href="{{ asset('public/assets-front/css-front/css/jquery-ui.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{ asset('public/assets-front/css-front/css/owl.carousel.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{ asset('public/assets-front/css-front/css/slicknav.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{ asset('public/assets-front/css-front/css/style.css')}}" type="text/css">
    <link rel="stylesheet" href="{{ asset('public/assets-front/css-front/css/front.css')}}">
    <link rel="shortcut icon" href="{{ url('public/uploaded_files/web-profile/') }}/{{Session::get('logo')}}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
</head>
<body>
   <!-- Offcanvas Menu Begin -->
    <div class="offcanvas-menu-overlay"></div>
    <div class="offcanvas-menu-wrapper">
        {{-- <div class="offcanvas__widget">
            <a href="#"><i class="fa fa-cart-plus"></i></a>
            <a href="#" class="search-switch"><i class="fa fa-search"></i></a>
            <a href="#" class="primary-btn">Add Car</a>
        </div> --}}
        <div class="offcanvas__logo">
            <img src="{{ url('public/uploaded_files/web-profile/') }}/{{Session::get('logo')}}" alt="" style="	max-width: 150px;">
        </div>
        <div id="mobile-menu-wrap"></div>
        {{-- <ul class="offcanvas__widget__add">
            <li><i class="fa fa-clock-o"></i> Week day: 08:00 am to 18:00 pm</li>
            <li><i class="fa fa-envelope-o"></i> Info.colorlib@gmail.com</li>
        </ul> --}}
        <div class="offcanvas__phone__num">
            {{-- <i class="fa fa-phone"></i>
            <span>(+12) 345 678 910</span> --}}
        </div>
        <div class="offcanvas__social">
            {{-- <a href="#"><i class="fa fa-facebook"></i></a>
            <a href="#"><i class="fa fa-twitter"></i></a>
            <a href="#"><i class="fa fa-google"></i></a>
            <a href="#"><i class="fa fa-instagram"></i></a> --}}
        </div>
    </div>
    <!-- Offcanvas Menu End -->
    <!-- Header Section Begin -->
    <header class="header" style="background-color: #D90429;">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7">
                        {{-- <ul class="header__top__widget">
                            <li><i class="fa fa-clock-o"></i> </li>
                            <li><i class="fa fa-envelope-o"></i> Info.colorlib@gmail.com</li>
                        </ul> --}}
                    </div>
                    <div class="col-lg-5">
                        <div class="header__top__right">
                            <div class="header__top__phone">
                                {{-- <i class="fa fa-phone"></i>
                                <span>(+12) 345 678 910</span> --}}
                            </div>
                            <div class="header__top__social">
                                {{-- <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-google"></i></a>
                                <a href="#"><i class="fa fa-instagram"></i></a> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container" >           
            <div class="row">
                <div class="col-lg-2 col-md-2">
                    <br>
                    <div class="header__logo" >
                        <img src="{{ url('public/uploaded_files/web-profile/') }}/{{Session::get('logo')}}" alt="" class="img-logo" style="max-width: 150px;">
                    </div>
                </div>
                <div class="col-lg-10">
                    <div class="header__nav" >
                        <nav class="header__menu">
                            @if ($active == "beranda")
                            
                                <ul>
                                <li class="active"><a href="{{ url('/') }}">Beranda</a> </li>
                                    <li><a href="{{ url('/struktur') }}">Pengurus</a></li>
                                    <li><a href="{{ url('/galeri-foto') }}">Galeri</a></li>
                                    <li><a href="{{ url('/berita') }}">Berita</a></li>
                                    <li><a href="{{ url('/kontak')}}">Kontak</a></li>
                                    <li><a href="{{ url('/cek-status')}}">Anggota</a></li>
                                </ul>

                                @elseif($active == "struktur")

                                <ul>
                                    <li ><a href="{{ url('/') }}">Beranda</a></li>
                                    <li class="active"><a href="{{ url('/struktur') }}">Pengurus</a></li>
                                    <li><a href="{{ url('/galeri-foto') }}">Galeri</a></li>
                                    <li><a href="{{ url('/berita') }}">Berita</a></li>
                                    <li><a href="{{ url('/kontak')}}">Kontak</a></li>
                                    <li><a href="{{ url('/cek-status')}}">Anggota</a></li>
                                </ul>

                                @elseif($active == "galeri")

                                <ul>
                                    <li ><a href="{{ url('/') }}">Beranda</a></li>
                                    <li ><a href="{{ url('/struktur') }}">Pengurus</a></li>
                                    <li class="active"><a href="{{ url('/galeri-foto') }}">Galeri</a></li>
                                    <li><a href="{{ url('/berita') }}">Berita</a></li>
                                    <li><a href="{{ url('/kontak')}}">Kontak</a></li>
                                    <li><a href="{{ url('/cek-status')}}">Anggota</a></li>
                                </ul>

                                @elseif($active == "berita")

                                <ul>
                                    <li><a href="{{ url('/') }}">Beranda</a></li>
                                    <li><a href="{{ url('/struktur') }}">Pengurus</a></li>
                                    <li><a href="{{ url('/galeri-foto') }}">Galeri</a></li>
                                    <li class="active"><a href="{{ url('/berita') }}">Berita</a></li>
                                    <li><a href="{{ url('/kontak')}}">Kontak</a></li>
                                    <li><a href="{{ url('/cek-status')}}">Anggota</a></li>
                                </ul>

                                @elseif($active == "kontak")

                                <ul>
                                    <li><a href="{{ url('/') }}">Beranda</a></li>
                                    <li><a href="{{ url('/struktur') }}">Pengurus</a></li>
                                    <li><a href="{{ url('/galeri-foto') }}">Galeri</a></li>
                                    <li><a href="{{ url('/berita') }}">Berita</a></li>
                                    <li class="active"><a href="{{ url('/kontak')}}">Kontak</a></li>
                                    <li><a href="{{ url('/cek-status')}}">Anggota</a></li>
                                </ul>
                                
                                 @elseif($active == "status")

                                <ul>
                                    <li><a href="{{ url('/') }}">Beranda</a></li>
                                    <li><a href="{{ url('/struktur') }}">Pengurus</a></li>
                                    <li><a href="{{ url('/galeri-foto') }}">Galeri</a></li>
                                    <li><a href="{{ url('/berita') }}">Berita</a></li>
                                    <li><a href="{{ url('/kontak')}}">Kontak</a></li>
                                    <li class="active"><a href="{{ url('/cek-status')}}">Anggota</a></li>
                                </ul>

                            @endif
                            
                        </nav>
                    </div>
                </div>
            </div>
            <div class="canvas__open">
                <span class="fa fa-bars"></span>
            </div>          
              <hr class="garis">        
        </div>       
    </header>