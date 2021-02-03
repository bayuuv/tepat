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
          Edit Korwil
        </h3>
        <nav aria-label="breadcrumb">
          <ul class="breadcrumb">
              <a href="{{url('pac')}}">Korwil</a>&nbsp;/&nbsp;Edit Korwil baru
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
                  <h4 class="card-title">Korwil</h4>
                  <p class="card-description"> Edit Korwil </p>
                  @foreach($data as $item)
                  <form action="{{url('pac/update')}}" class="forms-sample" method="POST">
                      {{ csrf_field() }}
                    <input type="hidden" name="id_pac" value="{{$item->id_pac}}">
                    <div class="row">
                      <div class="col">
                        <div class="form-group">
                            <label for="exampleFormControlSelect">Wilayah</label>&nbsp<label style="color:red;">{{$errors->first('dpc')}}</label>
                            <!-- <select theme="google" class="form-control form-control-lg" id="exampleFormControlSelect1" style="" name="dpc" placeholder="Pilih DPC" data-search="true"> -->
                            <select class="form-control form-control-lg selectpicker" data-live-search="true" id="exampleFormControlSelect1" name="dpc">
                                <option value="">Pilih Wilayah</option>
                                @foreach ($dpc as $items)
                                @if($items['id_dewan'] == $item->id_dewan)
                                <option value="{{$items['id_dewan']}}" selected>{{$items['nama']}}</option>
                                @else
                                <option value="{{$items['id_dewan']}}">{{$items['nama']}}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                          <label for="exampleInputName1">Nama Korwil</label>&nbsp<label style="color:red;">{{$errors->first('nama')}}</label>
                          <input type="text" class="form-control" id="exampleInputName1" name="nama" placeholder="Nama Korwil" value="{{$item->nama_pac}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleTextarea1">Alamat</label><label style="color:red;">&nbsp{{$errors->first('alamat')}}</label>
                            <textarea class="form-control" id="exampleTextarea1" name="alamat" rows="4">{{$item->alamat}}</textarea>
                        </div>
                        <div class="form-group">
                          <label for="exampleInputNo">No. Telp.</label><label style="color:red;">&nbsp{{$errors->first('no_telp')}}</label>
                          <input type="number" class="form-control" id="exampleInputNo" name="no_telp" placeholder="Nomor Telepon" value="{{$item->no_telp}}">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputUsername">Username</label><label style="color:red;">&nbsp{{$errors->first('username')}}</label>
                          <input type="text" class="form-control" id="exampleInputUsername" name="username" placeholder="Nama" value="{{$item->username}}">
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
                  @endforeach
                </div>
              </div>
            </div>
      </div>
    </div>
    <!-- content-wrapper ends -->
    @include('backend.dashboard.templates.footer')