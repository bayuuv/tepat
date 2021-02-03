
@include('frontend.partials.header')
@include('frontend.partials.preloader')
{{-- end include --}}

<section class="latest-spad">
    <!-- Breadcrumb End -->
<div class="breadcrumb-option set-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Galeri Foto & Video</h2>
                    <div class="breadcrumb__links">
                        <a href="{{ url('/') }}"><i class="fa fa-home"></i> Beranda</a>
                        <span style="color:white;">Foto & Video</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>    
    <!-- Galeri-foto&Video -->
      <div class="container galeri-foto">
        <div class="about__item">
            <h5>Foto-Foto</h5>
            <hr>
        </div>
        <div class="row">
            @foreach ($galeri as $item)                
                <div class="col-lg-4 col-md-12 mb-4 thumb">
                    <a class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-title="{{$item['judul']}}"
                       data-image="{{ url('public/uploaded_files/galeri/'.$item['cover'] )}}"
                        data-target="#image-gallery{{$item['id_galeri']}}">
                        
                             <div class=".content-img card" style="width: 100%;
                                                                  min-height: 250px;
                                                                  position: relative;
                                                                  overflow: hidden;">
                                      <div class="card-header">
                                            <h5 style="color:black">{{$item['judul']}}</h5>
                                     </div>
                                    <div class="card-body">
                                        <img src="{{ url('public/uploaded_files/galeri/'.$item['cover'] )}}" 
                                        alt="Another alt text"
                                        style=" width: 100%;
                                                height: 250px;">
                                    </div>
                            </div>
                    </a>
                </div>
            @endforeach
        <!--</div>-->
        <!--<div class="row">         -->
            <!-- Make it Big  -->
        @foreach ($galeri as $item)    
            <div class="modal fade" id="image-gallery{{$item['id_galeri']}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
               
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="image-gallery-title">{{$item['judul']}}</h4>
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <img id="image-gallery-image" class="col-md-12"  src="{{ url('public/uploaded_files/galeri/'.$item['cover'] )}}" >
                        </div>
                        <div class="modal-footer">
                          
                                <a class="btn btn-primary  btn-lg btn-block img-fluid" href="{{ url('galeri-foto/detail-foto/'.$item['id_galeri']. '/' .$item['slug'])}}"  role="button" >Info</a>
                        </div>
                    </div>
                </div>    
            </div>
         @endforeach     
        </div>
        @if ($galeri->lastPage() > 1)
            <ul class="pagination">
                <li class="page-item {{ ($galeri->currentPage() == 1) ? ' disabled' : '' }}">
                    <a class="page-link " href="{{ $galeri->url(1) }}">
                        <span aria-hidden="true">&laquo;</span>
                        <span class="sr-only">Previous</span>    
                    </a>
                </li>
                @for ($i = 1; $i <= $galeri->lastPage(); $i++)
                    <li class="page-item {{ ($galeri->currentPage() == $i) ? ' active' : '' }}">
                        <a class="page-link" href="{{ $galeri->url($i) }}">{{ $i }}</a>
                    </li>
                @endfor
                <li class="{{ ($galeri->currentPage() == $galeri->lastPage()) ? ' disabled' : '' }}">
                    <a class="page-link" href="{{ $galeri->url($galeri->currentPage()+1) }}" >
                        <span aria-hidden="true">&raquo;</span>
                        <span class="sr-only">Next</span>
                    </a>
                </li>
            </ul>
        @endif
    </div> 
    <a class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-title="Kembali"></a>
    

    <!-- galeri-video -->
    <div class="container galeri-video">
            <div class="about__item">
                <h5>Video</h5>
                <hr>
            </div>
        <!-- Grid row -->
        <div class="row">
            @foreach ($video as $items)
            <div class="col-lg-4 col-md-12 mb-4">
                <!--Modal: Name-->
                <div class="modal fade" id="modal1{{$items['id_galeri']}}"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <!--Content-->
                        <div class="modal-content">
                            <!--Body-->
                            <div class="modal-body mb-0 p-0">
                                <div class="embed-responsive embed-responsive-16by9 z-depth-1-half">
                                    <iframe class="embed-responsive-item" src="{{ $items['video'] }}"
                                    allowfullscreen></iframe>
                                </div>
                            </div>
            
                            <!--Footer-->
                            <div class="modal-footer justify-content-center">   
                    
                                <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>               
                            </div>
                        <!--/.Content-->
                        </div>                     
                    </div>
                </div>
                <!--Modal: Name-->  
                <div class="card">
                    <div class="card-header">
                        <h5>{{$items['judul']}}</h5>
                    </div>
                    <div class="card-body">
                        <div class="embed-responsive embed-responsive-16by9 z-depth-1-half">
                                <iframe class="embed-responsive-item" src="{{ $items['video'] }}"
                                    allowfullscreen></iframe>
                        </div>
                        <br>
                        <a class="a_link_gallery" href="{{ url('detail-video/'.$items['id_galeri']. '/' .$items['slug']) }}">Lihat Selengkapnya <i class="fa fa-long-arrow-right"></i></a>
                        <a class="btn btn-danger float-right" data-toggle="modal" data-target="#modal1{{$items['id_galeri']}}" data-target="#mdl1" role="button" style="color: white; margin-top: 10px;"><i class="fa fa-search-plus" aria-hidden="true"></i></a>                  
                    </div>
                </div>          
            </div>
        @endforeach    
        </div>
        @if ($video->lastPage() > 1)
            <ul class="pagination">
                <li class="page-item {{ ($video->currentPage() == 1) ? ' disabled' : '' }}">
                    <a class="page-link" href="{{ $video->url(1) }}">
                        <span aria-hidden="true">&laquo;</span>
                        <span class="sr-only">Previous</span>    
                    </a>
                </li>
                @for ($i = 1; $i <= $video->lastPage(); $i++)
                    <li class="page-item {{ ($video->currentPage() == $i) ? ' active' : '' }}">
                        <a class="page-link" href="{{ $video->url($i) }}">{{ $i }}</a>
                    </li>
                @endfor
                <li class="{{ ($video->currentPage() == $video->lastPage()) ? ' disabled' : '' }}">
                    <a class="page-link" href="{{ $video->url($video->currentPage()+1) }}" >
                        <span aria-hidden="true">&raquo;</span>
                        <span class="sr-only">Next</span>
                    </a>
                </li>
            </ul>
        @endif
        <br>
    </div>

</section>
@include('frontend.partials.footer')


