<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{Session::get('judul')}}</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{asset('public/assets/vendors/mdi/css/materialdesignicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/assets/vendors/css/vendor.bundle.base.css')}}">
    <link rel="stylesheet" href="{{asset('public/assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/assets/datatable/datatables.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/assets/ckeditor/css/styles.css')}}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{asset('public/assets/css/style.css')}}">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{ url('public/uploaded_files/web-profile/')}}/{{Session::get('logo')}}" />
    <!--<link href="{{asset('public/assets/bootstrap-select/dist/css/bootstrap-select.min.css')}}" rel="stylesheet" type="text/css"/>-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <!-- edit by @bayuuv -->
    <link href="{{asset('public/assets/bootstrap-fileinput/bootstrap-fileinput.css')}}" rel="stylesheet" type="text/css" />
  </head>
  <body data-editor="ClassicEditor" data-collaboration="false">
    <div class="container-scroller">
      <!-- partial:partials/_navbar.html -->
      <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
          <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
            <a class="navbar-brand brand-logo" href="{{url('dashboard')}}"><h2>{{Session::get('judul')}}</h2></a>
            <a class="navbar-brand brand-logo-mini" href="{{url('dashboard')}}"><img src="{{ url('public/uploaded_files/web-profile/')}}/{{Session::get('logo')}}" alt="logo"></img></a>
          </div>
          <div class="navbar-menu-wrapper d-flex align-items-stretch">
            <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
              <span class="mdi mdi-menu"></span>
            </button>
            <ul class="navbar-nav navbar-nav-right">
              <li class="nav-item d-none d-lg-block full-screen-link">
                <a class="nav-link fullscreen-icon">
                  <i class="mdi mdi-fullscreen" id="fullscreen-button"></i>
                </a>
              </li>
              <li class="nav-item nav-profile dropdown">
                <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                  <div class="nav-profile-text">
                    <p class="mb-1 text-black">{{Session::get('nama_akun')}}</p>
                  </div>
                </a>
                <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
                  <!-- <a class="dropdown-item" href="{{url('profile')}}">
                    <i class="mdi mdi-account-convert mr-2 text-success"></i> Profile </a>
                  <div class="dropdown-divider"></div> -->
                  <a class="dropdown-item" href="{{url('dashboard/change-password')}}">
                    <i class="mdi mdi-cached mr-2 text-success"></i> Ubah Password </a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="{{url('logout')}}">
                    <i class="mdi mdi-logout mr-2 text-primary"></i> Signout </a>
                </div>
              </li>
            </ul>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
              <span class="mdi mdi-menu"></span>
            </button>
          </div>
        </nav>
      <!-- partial end -->