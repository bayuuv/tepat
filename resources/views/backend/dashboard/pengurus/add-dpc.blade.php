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
          Tambah Pengurus Korwil
        </h3>
        <nav aria-label="breadcrumb">
          <ul class="breadcrumb">
              <a href="{{url('pengurus/dpc')}}">Korwil</a>&nbsp;/&nbsp;Tambah Pengurus Korwil baru
          </ul>
        </nav>
      </div>
      @if(Session::has('message'))
      <div class="alert alert-success" role="alert">
        <strong>{{ Session::get('message') }}</strong>
      </div>
      @endif
      <div class="row">
          <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Wilayah</h4>
                  <p class="card-description"> Tambah Pengurus Korwil baru </p>
                  <form action="{{url('pengurus/dpc/store')}}" class="forms-sample" method="POST">
                      {{ csrf_field() }}
                    <div class="row">
                      <div class="col">
                      <div class="form-group">
                          <label for="nama_dpc">Nama</label>&nbsp<label style="color:red;">{{$errors->first('nama_dpc')}}</label>
                          <select id="nama_dpc" class="form-control selectpicker anggota dynamic" name="nama_dpc" data-live-search="true" data-dependent="no_anggota">
                            <option value="">Pilih Korwil</option>
                            @foreach($dpc as $item)
                            <option value="{{$item->id_akun}}">{{$item->nama_akun}}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="select_anggota">No. Anggota</label>&nbsp<label style="color:red;">{{$errors->first('no_anggota')}}</label>
                          <select id="select_anggota" class="form-control selectpicker anggota" name="no_anggota" data-live-search="true" onchange="cek_database();">
                            <option value="">Pilih Anggota</option>
                            @foreach($anggota as $item)
                            <option value="{{$item['no_anggota']}}">{{$item['no_anggota']}} - {{$item['nama_anggota']}}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="nama_anggota">Nama</label>&nbsp<label style="color:red;">{{$errors->first('nama')}}</label>
                          <input type="text" class="form-control" id="nama_anggota" name="nama" placeholder="Nama Anggota" value="{{ old('nama') }}" disabled>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Jabatan</label>&nbsp<label style="color:red;">{{$errors->first('jabatan')}}</label>
                            <select class="form-control form-control-lg selectpicker" data-live-search="true" id="exampleFormControlSelect1" name="jabatan">
                                <option value="">Pilih Jabatan</opdion>
                                @foreach ($jabatan as $item)
                                @if($item['id_jabatan'] != $item->id_sub_jabatan )
                                @if($item['jabatan'] != 'Tidak Ada')
                                <option value="{{$item['id_sub_jabatan']}}">{{$item['jabatan']}}({{$item['nama_sub_jabatan']}})</option>
                                @else
                                <option value="{{$item['id_sub_jabatan']}}">{{$item['nama_sub_jabatan']}}</option>
                                @endif
                                @endif
                                @endforeach
                            </select>
                        </div>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-gradient-primary mr-2">Simpan</button>
                    <a href="{{url('pengurus/dpc')}}" class="btn btn-light">Batal</a>
                  </form>
                </div>
              </div>
            </div>
      </div>
    </div>
    <!-- content-wrapper ends -->
    @include('backend.dashboard.templates.footer2')