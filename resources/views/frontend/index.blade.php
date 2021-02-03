
@include('frontend.partials.header')
@include('frontend.partials.preloader')
{{-- end include --}}

    <!-- Awal Tentang Organisasi-->
    <section >
    <div class="container">
              <div class="row">
            <div class = "col-lg-12 col-md-12 col-sm-12" style="padding:0;">
             
                <div id="demo" class="carousel slide " data-ride="carousel">
            
                    <!--indikator-->
                    <ul class="carousel-indicators"
                        <li data-target="#demo" data-slide-to="0" class="active"></li>
                    </ul>
                    
             <!-- The slideshow -->
             
                        <div class="carousel-inner" >
                           @foreach ($dataBanner as $key => $gambar)    
                            <div class="carousel-item {{$key == 0 ? 'active' : '' }}">
                              <!--<img src="https://wallpapercave.com/w/wp2827631" alt="Los Angeles">-->
                              
                                <img src="{{url('public/uploaded_files/banner/'.$gambar['gambar'])}}" class="img-fluid" style="width:100%" style="height:350px;">
                            </div>
                            @endforeach       
                        </div>
                                
                          <!-- Left and right controls -->
                          <a class="carousel-control-prev" href="#demo" data-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                          </a>
                          <a class="carousel-control-next" href="#demo" data-slide="next">
                            <span class="carousel-control-next-icon"></span>
                          </a>
                </div>
               
            </div>
        </div>
            
    </div>
        
    </section>
    <section class="mt-2">
        @foreach ($data as $item)
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="section-title" style="border: 5px solid red; padding-top:10px; padding-bottom:10px;margin-bottom:15px;" >
                        <span >{{ $item['subtitle']}}</span>
                        <h2></h2>
                        {!! $item['ket'] !!}
                    </div>
                    <div class="text-center p-3"  style="border: 5px solid red;">
                        {!! $item['isi'] !!}
                    </div>
                </div>
            </div>     
        </div>
        <br>

     @endforeach
    </section>
    <!-- Last Tentang Organisasi -->

    <!-- Latest Blog Berita -->


    @include('frontend.partials.footer')