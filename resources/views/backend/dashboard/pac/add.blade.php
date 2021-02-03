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
          Tambah Korcam
        </h3>
        <nav aria-label="breadcrumb">
          <ul class="breadcrumb">
              <a href="{{url('pac')}}">Korcam</a>&nbsp;/&nbsp;Tambah Korcam baru
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
                  <h4 class="card-title">Korcam</h4>
                  <p class="card-description"> Tambah Korcam baru </p>
                  <form action="{{url('pac/store')}}" class="forms-sample" method="POST">
                      {{ csrf_field() }}
                    <div class="row">
                      <div class="col">
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Wilayah</label>&nbsp<label style="color:red;">{{$errors->first('dpc')}}</label>
                            <!-- <select theme="google" class="form-control form-control-lg" id="exampleFormControlSelect1" style="" name="dpc" placeholder="Pilih DPC" data-search="true"> -->
                            <select class="form-control form-control-lg selectpicker" data-live-search="true" id="exampleFormControlSelect1" name="dpc">
                                <option value="">Pilih Wilayah</opdion>
                                @foreach ($dpc as $item)
                                <option value="{{$item['id_dewan']}}">{{$item['nama']}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                          <label for="exampleInputName1">Nama Korcam</label>&nbsp<label style="color:red;">{{$errors->first('nama')}}</label>
                          <input type="text" class="form-control" id="exampleInputName1" name="nama" placeholder="Nama Korcam" value="{{ old('nama') }}">
                        </div>
                        <div class="form-group">
                            <label for="exampleTextarea1">Alamat</label><label style="color:red;">&nbsp{{$errors->first('alamat')}}</label>
                            <textarea class="form-control" id="exampleTextarea1" name="alamat" rows="4">{{old('alamat')}}</textarea>
                        </div>
                        <div class="form-group">
                          <label for="exampleInputNo">No. Telp.</label><label style="color:red;">&nbsp{{$errors->first('no_telp')}}</label>
                          <input type="number" class="form-control" id="exampleInputNo" name="no_telp" placeholder="Nomor Telepon" value="{{ old('no_telp') }}">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputUsername">Username</label><label style="color:red;">&nbsp{{$errors->first('username')}}</label>
                          <input type="text" class="form-control" id="exampleInputUsername" name="username" placeholder="Nama" value="{{ old('username') }}">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputPassword">Password</label><label style="color:red;">&nbsp{{$errors->first('password')}}</label>
                          <input type="password" class="form-control" id="exampleInputPassword" name="password" placeholder="Password">
                        </div>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-gradient-primary mr-2">Simpan</button>
                    <a href="{{url('pac')}}" class="btn btn-light">Batal</a>
                  </form>
                </div>
              </div>
            </div>
      </div>
    </div>
    <!-- content-wrapper ends -->
    @include('backend.dashboard.templates.footer')