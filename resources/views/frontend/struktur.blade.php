@include('frontend.partials.header')
@include('frontend.partials.preloader')
{{-- end include --}}

    <!-- Breadcrumb End -->
    <div class="breadcrumb-option set-bg" >
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Pengurus</h2>
                        <div class="breadcrumb__links">
                            <a href="{{ url('/') }}"><i class="fa fa-home"></i> Beranda</a>
                            <span style="color:white;">Pengurus</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Begin -->
    <!-- About Us Section Begin -->
    <section class="latest spad">
        <div class="container shadow-sm p-3 mb-5 bg-white rounded " >
         <div style="padding-top: 20px; border: 5px solid red;">
            <div class="row">
                <div class="col-lg-12 col-md-6 col-sm-6">
                    <div class="row" >
                        <div class="col">
                            
                              <div style="margin-left: 70px;margin-right: 70px;">
                                @if($pilihan_kedua != null)
                                <h3>{{ $pilihan_kedua }}</h3>&nbsp
                                @else
                                <h3>Pengurus Pusat</h3>&nbsp
                                @endif
                                <div class="col">
                                    <div class="form-inline">
                                        <label>Pilih</label>&nbsp
                                        <select id="pilih_kesatu" name="pilih_kesatu" onchange="pilihKesatu();">
                                            @if($id_level == '')
                                            <option value="" selected>- pilih -</option>
                                            <option value="2">Pengurus Pusat</option>
                                            <option value="3">Korwil</option>
                                            <option value="4">Korcam</option>
                                            @elseif($id_level == '2')
                                            <option value="">- pilih -</option>
                                            <option value="2" selected>Pengurus Pusat</option>
                                            <option value="3">Korwil</option>
                                            <option value="4">Korcam</option>
                                            @elseif($id_level == '3')
                                            <option value="">- pilih -</option>
                                            <option value="2">Pengurus Pusat</option>
                                            <option value="3" selected>Korwil</option>
                                            <option value="4">Korcam</option>
                                            @elseif($id_level == '4')
                                            <option value="">- pilih -</option>
                                            <option value="2">Pengurus Pusat</option>
                                            <option value="3">Korwil</option>
                                            <option value="4" selected>Korcam</option>
                                            @endif
                                        </select>
                                    </div>
                                        @if($id_level == 3)
                                            <div class="form-inline" style="padding-top:10px">
                                                <label>Pilih</label>&nbsp
                                                <div class="form-inline" style="color: black;">
                                                    <select class="form-control" id="pilih_kedua" name="pilih_kedua" onchange="pilihKedua();">
                                                        <option data-tokens="">- pilih -</option>
                                                        @foreach($pilihanKedua as $item)
                                                        @if($id_akun == $item['id_akun'])
                                                        <option value="{{ $item['id_akun'] }}" selected>{{ $item['nama_akun'] }}</option>
                                                        @else
                                                        <option value="{{ $item['id_akun'] }}">{{ $item['nama_akun'] }}</option>
                                                        @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        @elseif($id_level == 4 && $id_akun == '') 
                                            <div class="form-inline" style="padding-top:10px">
                                                <label>Pilih</label>&nbsp
                                                <div class="form-inline">
                                                    <select class="form-control" id="pilih_kedua" name="pilih_kedua" onchange="pilihKetiga();">
                                                        <option data-tokens="">- pilih -</option>
                                                        @foreach($pilihanKedua as $item)
                                                        @if($id_akun == $item['id_akun'])
                                                        <option value="{{ $item['id_dewan'] }}" selected>{{ $item['nama_akun'] }}</option>
                                                        @else
                                                        <option value="{{ $item['id_dewan'] }}">{{ $item['nama_akun'] }}</option>
                                                        @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        @endif
                                        @if($id_level == 4 && $id_akun != '')
                                            <div class="form-inline" style="padding-top:10px">
                                                <label>Pilih</label>&nbsp
                                                <div class="form-inline">
                                                    <select class="form-control" id="pilih_kedua" name="pilih_kedua" onchange="pilihKetiga();">
                                                        <option data-tokens="">- pilih -</option>
                                                        @foreach($pilihanKedua as $item)
                                                        @if($id_akun == $item['id_dewan'])
                                                        <option value="{{ $item['id_dewan'] }}" selected>{{ $item['nama_akun'] }}</option>
                                                        @else
                                                        <option value="{{ $item['id_dewan'] }}">{{ $item['nama_akun'] }}</option>
                                                        @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-inline" style="padding-top:10px">
                                                <label>Pilih</label>&nbsp
                                                <div class="form-inline">
                                                    <select class="form-control" id="pilih_ketiga" name="pilih_ketiga" onchange="pilihPac();">
                                                        <option data-tokens="">- pilih -</option>
                                                        @foreach($pilihanKetiga as $item)
                                                        @if($id_pac == $item['id_pac'])
                                                        <option value="{{ $item['id_pac'] }}" selected>{{ $item['nama_pac'] }}</option>
                                                        @else
                                                        <option value="{{ $item['id_pac'] }}">{{ $item['nama_pac'] }}</option>
                                                        @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        @endif
                                </div>
                                <hr>
                                <br>
                                
                            </div> 
                        </div>            
                    </div>
                    <div class="row" >
                        <div class="col">
                            <dl> 
                                @if($id_level != '' )
                                    @foreach($data as $item)
                                        @if($item['id_jabatan'] == 1 && $item['id_sub_jabatan'] != 1)
                                            <dd>{{ $item['nama_sub_jabatan'] }} &nbsp;-&nbsp; {{ $item['nama_anggota'] }}</dd>
                                        @elseif($item['id_jabatan'] != 1 && $item['id_sub_jabatan'] != 1)
                                            <dd>{{ $item['jabatan'] }} &nbsp;-&nbsp; {{ $item['nama_anggota'] }} ( {{ $item['nama_sub_jabatan'] }} )</dd>
                                        @endif
                                    @endforeach
                                @endif    
                            </dl>    
                        </div>                       
                    </div>
                </div>
            </div>
          </div>    
        </div>
    </section>
    <!-- About Us Section End -->
    
    @include('frontend.partials.footer')