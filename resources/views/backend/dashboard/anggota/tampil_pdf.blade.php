@include('backend.dashboard.templates.header')
<div class="container-fluid page-body-wrapper">
@include('backend.dashboard.templates.sidebar')
    <!-- partial -->
    <div class="main-panel">
         <div class="content-wrapper">
             <div class="card text-left">
                    <div class="card-body p-3">
                        <div class="row m-2">
                            @foreach ($data as $item)
                            <div class="col-lg-12 col-md-12">
                                @if( $item->id_level == 2 )
                                    <h5 class="font-weight-bold">Yayasan {{$item->nama_akun}}</h5>
                                @elseif( $item->id_level == 3 )
                                    <h5 class="font-weight-bold">Wilayah {{$item->nama_akun}}</h5>
                                @elseif( $item->id_level == 4 )
                                    <h5 class="font-weight-bold">Unit {{$item->nama_akun}}</h5>
                                @else
                                    <h5 class="font-weight-bold">{{$item->nama_akun}}</h5>
                                @endif
                                <hr>
                            </div>
                            
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-4 col-lg-2">
                                        <a href="{{ url('anggota/download-one-pdf/'.$item['no_anggota']) }}" style="float:left;">   
                                           <button type="button" class="btn btn-gradient-info btn-block"> Download PDF </button> 
                                        </a>
                                    </div>
                                    </div>
                                </div>
                            <div class="col-12 col-lg-4 col-md-12 mt-2">
                                <form class="form-inline">
                                    <label for="pwd" class="font-weight-bold">No Anggota : </label>
                                    <label for="pwd" style="padding-left:5px"> {{$item->no_anggota}}</label>
                                </form>
                            </div>
                            <div class="col-12 col-lg-4 col-md-12">
                                <form class="form-inline">
                                    <label for="pwd" class="font-weight-bold">Nama : </label>
                                    <label for="pwd" style="padding-left:5px"> {{$item->nama_anggota}}</label>
                                </form>
                            </div>
                            <div class="col-12 col-lg-4 col-md-12">
                             <form class="form-inline">
                                <label for="pwd" class="font-weight-bold">Jabatan : </label>
                                <label for="pwd" style="padding-left:5px"> 
                                    @if($item->id_jabatan == 1 && $item->id_sub_jabatan != 1)
                                        {{$item->nama_sub_jabatan}}
                                    @elseif($item->id_jabatan != 1 && $item->id_sub_jabatan == 1)
                                        {{$item->jabatan}}
                                    @elseif($item->id_jabatan != 1 && $item->id_sub_jabatan != 1)
                                        {{$item->nama_sub_jabatan}} ( {{$item->jabatan}} )
                                    @elseif($item->id_jabatan == 1 && $item->id_sub_jabatan == 1)
                                        Anggota
                                    @else
                                        {{$item->jabatan}} ({{$item->nama_sub_jabatan}})
                                    @endif
                                </label>
                            </form>
                            </div>
                            <div class="col-12 col-lg-12 col-md-12">
                                <form class="form-inline">
                                    <label for="pwd" class="font-weight-bold">Alamat : </label>
                                     <label for="pwd" style="padding-left:5px"> {{$item->alamat}}</label>
                                </form>
                            </div>
                            <div class="card mr-4" style="width: 13rem;">
                              <img class="card-img-top img-anggota" src="{{asset('public/uploaded_files/anggota/foto/'.$item['foto'])}}" alt="Card image cap" style="border-radius: 15%;margin-top:20px;height:12rem;">
                            </div>
                            <div class="card mb-4" style="width: 23rem;">
                                <img class="card-img-top img-ktp" src="{{asset('public/uploaded_files/anggota/ktp/'.$item['ktp'])}}" alt="Card image cap" style="border-radius: 15%;margin-top:20px;height:14rem;">
                            </div>
                              
                       @endforeach
                        </div>
                </div>
            </div>
        </div>
    </div>
          <!-- content-wrapper ends -->
</div>
    @include('backend.dashboard.templates.footer')

