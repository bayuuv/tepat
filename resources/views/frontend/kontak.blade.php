
@include('frontend.partials.header')
@include('frontend.partials.preloader')
{{-- end include --}}
 
    <!-- Breadcrumb End -->
    <div class="breadcrumb-option set-bg" >
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Kontak</h2>
                        <div class="breadcrumb__links">
                            <a href="{{ url('/') }}"><i class="fa fa-home"></i> Beranda</a>
                            <span style="color:white;">Kontak</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Begin -->
    <!-- About Us Section Begin -->
    <section class="latest spad" >
     
        <div class="container shadow-sm p-3 mb-5 bg-white rounded ">
             <div style="border: 5px solid red;">
                <div class="row">
                    @foreach ($dataKontak as $item)
                    <div class="col-lg-12 col-md-6 col-sm-6">
                        <div class="float-left ml-3 mt-3">
                        
                            {!!$item['kontak']!!}
                       
                            
                        </div>  
                           @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- About Us Section End -->
        @include('frontend.partials.footer')