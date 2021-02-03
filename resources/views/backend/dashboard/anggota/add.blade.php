@include('backend.dashboard.templates.header')
<!-- partial end -->
<div class="container-fluid page-body-wrapper">
  <!-- partial:partials/_sidebar.html -->
  @include('backend.dashboard.templates.sidebar')
  <!-- partial end -->
  
  <!-- content-wrapper start -->
  <div class="main-panel">
    <div class="content-wrapper">
      <div class="page-header">
        <h3 class="page-title">
          <span class="page-title-icon bg-gradient-primary text-white mr-2">
            <i class="mdi mdi-account-group"></i>
          </span>
          Tambah Anggota
        </h3>
        <nav aria-label="breadcrumb">
          <ul class="breadcrumb">
              <a href="{{url('anggota')}}">Anggota</a>&nbsp;/&nbsp;Tambah Anggota baru
          </ul>
        </nav>
      </div>
      @if(Session::has('message'))
      <div class="alert {{ Session::get('class') }}" role="alert">
        <strong>{{ Session::get('message') }}</strong>
      </div>
      @endif
      <div class="row">
          <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Anggota</h4>
                  <p class="card-description"> Tambah Anggota baru </p>
                  <form action="{{url('anggota/store')}}" class="forms-sample" method="POST" enctype="multipart/form-data">
                      {{ csrf_field() }}
                    <div class="row">
                      <div class="col">
                        <div class="form-group">
                          <label for="exampleInputNoAnggota">No. Anggota</label>&nbsp<label style="color:red;">{{$errors->first('no_anggota')}}</label>
                          <input type="text" class="form-control" id="exampleInputNoAnggota" name="no_anggota" placeholder="Nomor Anggota" value="{{ $no_anggota }}" disabled>
                        </div>
                        @if(Session::get('level') == 'Super Admin' || Session::get('level') == 'Admin')
                        <div class="form-group">
                            <label for="id_akun">Pilih</label>&nbsp<label style="color:red;">{{$errors->first('id_akun')}}</label>
                            <!-- <select theme="google" class="form-control form-control-lg" id="exampleFormControlSelect1" style="" name="dpc" placeholder="Pilih DPC" data-search="true"> -->
                            <select class="form-control form-control-lg selectpicker" data-live-search="true" id="id_akun" name="id_akun" onchange="pilihCabang();">
                                <option value="0">Pilih Cabang</opdion>
                                <option value="2">Pengurus Pusat</option>
                                <option value="3">Korwil</option>
                                <option value="4">Korcam</option>
                            </select>
                        </div>
                        <div class="form-group" id="dpc" style="display:none;">
                            <label for="id_akun_dpc">Pilih Wilayah</label>&nbsp<label style="color:red;">{{$errors->first('id_akun_dpc')}}</label>
                            <!-- <select theme="google" class="form-control form-control-lg" id="exampleFormControlSelect1" style="" name="dpc" placeholder="Pilih DPC" data-search="true"> -->
                            <select class="form-control form-control-lg selectpicker" data-live-search="true" id="id_akun_dpc" name="id_akun_dpc">
                                <option value="">Pilih Wilayah</opdion>
                                @foreach ($dpc as $item)
                                <option value="{{$item['id_akun']}}">{{$item['nama_akun']}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group" id="pac" style="display:none;">
                            <label for="id_akun_pac">Pilih Unit</label>&nbsp<label style="color:red;">{{$errors->first('id_akun_pac')}}</label>
                            <!-- <select theme="google" class="form-control form-control-lg" id="exampleFormControlSelect1" style="" name="dpc" placeholder="Pilih DPC" data-search="true"> -->
                            <select class="form-control form-control-lg selectpicker" data-live-search="true" id="id_akun_pac" name="id_akun_pac">
                                <option value="">Pilih Unit</opdion>
                                @foreach ($pac as $item)
                                <option value="{{$item['id_akun']}}">{{$item['nama_akun']}}</option>
                                @endforeach
                            </select>
                        </div>
                        @endif
                        <div class="form-group">
                          <label for="exampleInputNik">NIK</label>&nbsp<label style="color:red;">{{$errors->first('nik')}}</label>@if(Session::has('message'))<label style="color:red;">{{Session::get('message')}}</label>@endif
                          <input type="text" class="form-control" id="exampleInputNik" name="nik" placeholder="Nomor Induk Kependudukan" value="{{ old('nik') }}">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputName1">Nama</label>&nbsp<label style="color:red;">{{$errors->first('nama')}}</label>
                          <input type="text" class="form-control" id="exampleInputName1" name="nama" placeholder="Nama Anggota" value="{{ old('nama') }}">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputJK">Jenis Kelamin</label>&nbsp<label style="color:red;">{{$errors->first('jenis_kelamin')}}</label>
                          <select class="form-control" name="jenis_kelamin">
                            <option>Pilih Jenis Kelamin</option>
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                          </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleTextarea1">Alamat</label><label style="color:red;">&nbsp{{$errors->first('alamat')}}</label>
                            <textarea class="form-control" id="exampleTextarea1" name="alamat" rows="4">{{old('alamat')}}</textarea>
                        </div>
                        <div class="row">
                          <div class="col-lg-12 col-md-6">
                            <div class="form-group">
                              <label for="exampleInputTempatLahir">Tempat Lahir</label><label style="color:red;">&nbsp{{$errors->first('tempat_lahir')}}</label>
                              <input type="text" class="form-control" id="exampleInputTempatLahir" name="tempat_lahir" placeholder="Tempat Lahir" value="{{ old('tempat_lahir') }}">
                            </div>
                          </div>
                          <div class="col">
                          <div class="form-group">
                            <label for="exampleInputTanggalLahir">Tanggal Lahir</label><label style="color:red;">&nbsp{{$errors->first('tgl_lahir')}}</label>
                            <input type=text class="form-control" id="exampleInputTanggalLahir" name="tgl_lahir" placeholder="Tgl/Bulan/Tahun" value="{{ old('tgl_lahir') }}">
                          </div>
                        </div>
                        </div>
                        <div class="form-group">
                          <label for="exampleInputNo">No. Telp.</label><label style="color:red;">&nbsp{{$errors->first('no_telp')}}</label>
                          <input type="number" class="form-control" id="exampleInputNo" name="no_telp" placeholder="Nomor Telepon" value="{{ old('no_telp') }}">
                        </div>
                        <div class="form-group">
                            <label>Foto</label>
                            <!-- edit by @bayuuv -->
                            <br>
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                              <div class="fileinput-new thumbnail" style="width: 100%; height: 100%;">
                                      <img src="https://www.placehold.it/200x200/EFEFEF/AAAAAA&amp;text=no+image" alt=""/>
                              </div>
                              <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 100%; max-height: 100%;">
                              </div>
                              <div>
                                  <input type="file" name="foto" id="foto" class="form-control" accept="image/jpg,image/jpeg,image/png" >
                                  <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                              </div>
                            </div>
                            <!-- <input type="file" name="foto" class="file-upload-default" accept=".jpg, .png, .jpeg">
                            <div class="input-group col-xs-12">
                              <input type="text" class="form-control file-upload-info" name="img_foto" placeholder="Unggah Foto" disabled>
                              <span class="input-group-append">
                                <button class="file-upload-browse btn btn-gradient-primary" type="button">Upload</button>
                              </span>
                            </div> -->
                        </div>
                        <div class="form-group">
                            <label>KTP</label>
                            <!-- edit by @bayuuv -->
                            <br>
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                              <div class="fileinput-new thumbnail" style="width: 100%; height: 100%;">
                                      <img src="https://www.placehold.it/200x200/EFEFEF/AAAAAA&amp;text=no+image" alt=""/>
                              </div>
                              <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 100%; max-height: 100%;">
                              </div>
                              <div>
                                  <input type="file" name="ktp" id="ktp" class="form-control" accept="image/jpg,image/jpeg,image/png" >
                                  <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                              </div>
                            </div>
                            <!-- <input type="file" name="ktp" class="file-upload-default" accept=".jpg, .png, .jpeg">
                            <div class="input-group col-xs-12">
                              <input type="text" class="form-control file-upload-info" name="img_ktp" placeholder="Unggah Foto KTP" disabled>
                              <span class="input-group-append">
                                <button class="file-upload-browse btn btn-gradient-primary" type="button">Upload</button>
                              </span>
                            </div> -->
                        </div>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-gradient-primary mr-2">Simpan</button>
                    <a href="{{url('anggota')}}" class="btn btn-light">Batal</a>
                  </form>
                </div>
              </div>
            </div>
      </div>
    </div>
    <!-- content-wrapper ends -->
    @include('backend.dashboard.templates.footer')