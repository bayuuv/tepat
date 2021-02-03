        
@include('frontend.partials.header')
@include('frontend.partials.preloader')
{{-- end include --}}
        
        <!-- Car Details Section Begin -->
        <section class="car-details spad">
           <div class="container">
                <div class="row">
                   
                    <div class="col-lg-12">
                        <h3>{{ $judul }}</h3>
                        <hr>
                    </div>
                </div>
                <div class="row">
                    <div class="col p-3 text-center" st>
                        {!! $ket !!}
                    </div>
                </div>
                @foreach ($detailFoto as $item )
               <div class="container">
                        <div class="blog__details__gambar">
                              <div class="row ">
                                    <div class="col">
                                        <center>
                                            <a href="{{ url('public/uploaded_files/galeri/'.$item['gambar'] )}}" class=" ">
                                                <img src="{{ url('public/uploaded_files/galeri/'.$item['gambar'] )}}" class="gambar-galeri"  alt=""  >
                                            </a>
                                        </center>     
                                     </div>
                             </div>
                        </div>
                </div>
                @endforeach
        </section>

        @include('frontend.partials.footer')