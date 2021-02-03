
@include('frontend.partials.header')
@include('frontend.partials.preloader')
{{-- end include --}}

    <!-- Berita -->
@foreach ($detail_berita as $items)
    <section class="services spad" >
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-10">
                    <div class="blog__details__hero__text">
                            <h2>{{ $items['judul'] }}</h2>
                                <ul>
                                    <li><i class="fa fa-calendar-o"></i> <span>Terakhir Diupdate</span></li>
                                    <li><i class="fa fa-edit"></i> <span>{{ $items['diperbarui'] }}</span></li>
                                </ul>
                    </div>
                </div>
            </div>     
        </div>
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="blog__details__pic">
                    <div class="col-lg-12 col-md-12">
                            <img src="{{ url('public/uploaded_files/berita/'.$items['gambar']) }}" alt="" class="img-fluid img-thumbnail"  >
                     </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <center>
                        <p class="text-detail">{!! $items['konten'] !!}</p>
                    </center>
                </div>
            </div>
        </div>
    </section>
@endforeach
    <!-- Last Tentang Organisasi -->

@include('frontend.partials.footer')