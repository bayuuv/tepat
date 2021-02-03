        
@include('frontend.partials.header')
@include('frontend.partials.preloader')
{{-- end include --}}
        
        <!-- Car Details Section Begin -->
        <section class="car-details spad">
           <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <h3>{{ $judul }}</h3>
                        <hr>
                    </div>
                </div>
              <div class="row text-center text-lg-left">
                   
            </div>
            <div class="row">
                 @foreach ($video as $item )
                    <div class="embed-responsive embed-responsive-16by9 mr-3 ml-3">
                      <iframe class="embed-responsive-item" src="{{ $item['video'] }}" allowfullscreen></iframe>
                    </div>
                @endforeach
            </div>
            <div class="row mr-3 ml-3">
                <div class="col p-3">
                    {!! $ket !!}
                </div>
            </div>               
        </section>

        @include('frontend.partials.footer')