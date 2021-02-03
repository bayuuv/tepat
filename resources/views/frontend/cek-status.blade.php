
@include('frontend.partials.header')
@include('frontend.partials.preloader')
{{-- end include --}}
     <!-- Breadcrumb End -->
     <div class="breadcrumb-option set-bg" >
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Anggota</h2>
                        <div class="breadcrumb__links">
                            <a href="{{ url('/') }}"><i class="fa fa-home"></i> Beranda</a>
                            <span style="color:white;">Anggota</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Begin -->
    <section class="latest spad" > 
        <div class="container shadow-sm p-3 mb-5 bg-white rounded ">
             <div style="border: 5px solid red;">
                <div class="row">
                   <div class="col-12">
                        <!-- Search form -->
                            <form class="form-inline d-flex justify-content-center md-form form-sm mt-3" action = "{{ url('/cek-status')}}" method="GET">
                                {{ csrf_field() }}
                                <i class="fa fa-search" aria-hidden="true"></i>
                                <input class="form-control form-control-sm ml-3 w-75"  placeholder="Masukkan No Anggota / No KTP"
                                aria-label="Search"
                                name="q">
                                <button type="submit" class="btn btn-default ml-3" id="cek-status" >
                                    Cek Status
                                </button>
                            </form>
                        <!--end search form-->
                                  <!--@if(Session::has('message'))-->
                                  <!--<div class="alert {{ Session::get('class') }}" role="alert">-->
                                  <!--  <strong>{{ Session::get('message') }}</strong>-->
                                  <!--</div>-->
                                  <!--@endif-->
                    </div> 
                </div>
                <div class="row mt-3">
                    <div class="col-md-12 ">
	                        <div class="">
                                <div class="">
                                    <div class="row">
                                        <div class="col-md-12 ml-3">
                                            <hr width="90%">
                                            
                                              @foreach($anggotas as $items)
                                                 <img src="{{asset('public/uploaded_files/anggota/foto/'.$items['foto'])}}" class="img-thumbnail" alt="" width="150" height="auto" id="img-status">
                                              @endforeach
                                       
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 ml-3">
                                            <div class="biodata">
                                                
                                                    <table width="100%" border="0" class="">
                                                             
                
                                                <tbody><tr>
                                                    <td valign="top" style="padding-right:20px">
                                                        
                                                        <table border="0" width="100%" style="padding-left: 2px; padding-right: 13px;" class="table table-borderless">
                                                      <tbody>
                                                          @if ($cari == null)  
                                                            <td width="10%" valign="top" style=" font-weight:bold; padding-bottom:10px; color:red; text-align:center;" class="textt"> </td>
                                                          @else
                                                          
                                                            @if(count($anggotas) != 0 )  
                                                       @foreach($anggotas as $item)
                                             
                                                                               <tr>
                                                          <td width="10%" valign="top" class="textt">No Anggota</td>
                                                            <td width="2%">:</td>
                                                            <td style=" font-weight:bold"  class="texta">{{$item->no_anggota}}</td>
                                                        </tr>  
                                                         <tr>
                                                          <td width="10%" valign="top" class="textt">Nama</td>
                                                            <td width="2%">:</td>
                                                            <td style=" font-weight:bold"  class="texta">{{$item->nama_anggota}}</td>
                                                        </tr>  
                                                           <tr>
                                                          <td width="10%" valign="top" class="textt">Status</td>
                                                            <td width="2%">:</td>
                                                            <td style=" font-weight:bold"  class="texta"> 
                                                            @if($item->is_active == 0)
                                                            Non aktif
                                                            @endif
                                                            @if($item->is_active == 1)
                                                            Aktif
                                                            @endif</td>
                                                        </tr>
                                                           <tr>
                                                          <td width="10%" valign="top" class="textt">Keterangan</td>
                                                            <td width="2%">:</td>
                                                            <td style=" font-weight:bold"  class="texta">
                                                            @if($item->id_level == 2)
                                                                Yayasan {{$item->nama_akun}}
                                                            @elseif($item->id_level == 3)
                                                                Wilayah {{$item->nama_akun}}
                                                            @elseif($item->id_level == 4)
                                                               Unit {{$item->nama_akun}}
                                                            @else
                                                                Tidak Ada
                                                            @endif
                                                            
                                                            </td>
                                                            
                                                            
                                                        </tr>
                                                         <tr>
                                                          <td width="10%" valign="top" class="textt">Jabatan</td>
                                                            <td width="1%">:</td>
                                                            <td style=" font-weight:bold"  class="texta">
                                                                  @if($item->id_jabatan == 1 && $item->id_sub_jabatan != 1)
                                                                    {{$item->nama_sub_jabatan}}
                                                                @elseif($item->id_jabatan != 1 && $item->id_sub_jabatan == 1)
                                                                   {{$item->jabatan}}
                                                                @elseif($item->id_jabatan != null && $item->id_sub_jabatan != 1)
                                                                
                                                                     {{$item->jabatan}} ( {{$item->nama_sub_jabatan}} )
                                                                @elseif($item->id_jabatan == 1 && $item->id_sub_jabatan == 1)
                                                                      Anggota
                                                                @else
                                                                    @if($item->id_jabatan == null)
                                                                    {{$item->nama_sub_jabatan}}
                                                                    @else
                                                                    {{$item->id_jabatan}}
                                                                    {{$item->jabatan}} ({{$item->nama_sub_jabatan}})
                                                                    @endif
                                                                @endif</td>
                                                        </tr>
                                           
                                                       
                                  
                                                       @endforeach
                                                           
                                                                 
                                                            @elseif (count($anggotas) == 0)
                                                                <td width="100%" valign="top" style=" font-weight:bold; padding-bottom:10px; color:red; text-align:center;" class="textt"> Tidak ada data ditemukan</td>
                                                      
                                                          
                                                          @endif
                                                          @endif
                                                           <tr>
                                                    </tbody></table>
                                                    </td>
                                                </tr>
                                                </tbody></table>
                                              </div>                                                            
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>  
                                
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- About Us Section End -->
 @include('frontend.partials.footer')