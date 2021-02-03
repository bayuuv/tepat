
@include('frontend.partials.header')
@include('frontend.partials.preloader')
{{-- end include --}}

    <!-- Breadcrumb End -->
    <div class="breadcrumb-option set-bg" >
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Berita</h2>
                        <div class="breadcrumb__links">
                            <a href="{{ url('/') }}"><i class="fa fa-home"></i> Beranda</a>
                            <span style="color:white;">Berita</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <!-- Latest Blog Berita -->
        <section class="latest spad">
             <div class="container mt-2 mb-3">
                <div class="row">
                                 @foreach ($dataBerita as $items)
                                         <div class="col-lg-4 col-md-6">
                                            <div class="latest__blog__item">
                                                <div class="latest__blog__item__pic set-bg" data-setbg="{{ url('public/uploaded_files/berita/'.$items['gambar'] )}}">
                                                    <ul class="latest_title">
                                                        <li>Terakhir Diupdate</li>
                                                    <li style="margin-left: 20px;">
                                                        {{$items['diperbarui']}}</li>
                                                        
                                                    </ul>
                                                </div>
                                                <div class="latest__blog__item__text">
                                                    <h5>{{$items['judul']}}</h5>
                                                    <a class="a_link" href="{{ url('berita/detail-berita/'.$items['id_berita']. '/' .$items['slug']) }}">Lihat Selengkapnya <i class="fa fa-long-arrow-right"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                  @endforeach  
                                  <div class="d-block col-lg-12 col-md-12 col-ms-12">
                                               @if ($dataBerita->lastPage() > 1)
                                                <ul class="pagination">
                                                    <li class="page-item {{ ($dataBerita->currentPage() == 1) ? ' disabled' : '' }}">
                                                        <a class="page-link" href="{{ $dataBerita->url(1) }}">
                                                            <span aria-hidden="true">&laquo;</span>
                                                            <span class="sr-only">Previous</span>    
                                                        </a>
                                                    </li>
                                                    @for ($i = 1; $i <= $dataBerita->lastPage(); $i++)
                                                        <li class="page-item {{ ($dataBerita->currentPage() == $i) ? ' active' : '' }}">
                                                            <a class="page-link" href="{{ $dataBerita->url($i) }}">{{ $i }}</a>
                                                        </li>
                                                    @endfor
                                                    <li class="{{ ($dataBerita->currentPage() == $dataBerita->lastPage()) ? ' disabled' : '' }}">
                                                        <a class="page-link" href="{{ $dataBerita->url($dataBerita->currentPage()+1) }}" >
                                                            <span aria-hidden="true">&raquo;</span>
                                                            <span class="sr-only">Next</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            @endif
                                  </div>
                                
                </div>
            </div>
    </section>
     
           
                                
@include('frontend.partials.footer')