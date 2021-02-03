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
          Edit Sub Jabatan
        </h3>
        <nav aria-label="breadcrumb">
          <ul class="breadcrumb">
              <a href="{{url('sub-jabatan')}}">Jabatan</a>&nbsp;/&nbsp;Edit Sub Jabatan
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
                  <h4 class="card-title">Sub Jabatan</h4>
                  <p class="card-description"> Sub Jabatan </p>
                  @foreach($data as $item)
                  <form action="{{url('sub-jabatan/update')}}" class="forms-sample" method="POST">
                      {{ csrf_field() }}
                    <input type="hidden" name="id_sub_jabatan" value="{{$item->id_sub_jabatan}}">
                    <div class="row">
                      <div class="col">
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Jabatan</label>&nbsp<label style="color:red;">{{$errors->first('id_jabatan')}}</label>
                            <!-- <select theme="google" class="form-control form-control-lg" id="exampleFormControlSelect1" style="" name="dpc" placeholder="Pilih DPC" data-search="true"> -->
                            <select class="form-control form-control-lg selectpicker" data-live-search="true" id="exampleFormControlSelect1" name="id_jabatan">
                                <option value="">Pilih Jabatan</opdion>
                                @foreach ($jabatan as $items)
                                @if($items['id_jabatan'] == $item->id_jabatan)
                                <option value="{{$items['id_jabatan']}}" selected>{{$items['jabatan']}}</option>
                                @else
                                <option value="{{$items['id_jabatan']}}">{{$items['jabatan']}}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                          <label for="exampleInputName1">Sub Jabatan</label>&nbsp<label style="color:red;">{{$errors->first('nama_jabatan')}}</label>
                          <input type="text" class="form-control" id="exampleInputName1" name="nama_sub_jabatan" placeholder="Sub Jabatan" value="{{$item->nama_sub_jabatan}}">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputPrioritas">Prioritas</label>&nbsp<label style="color:red;">{{$errors->first('prioritas')}}</label>
                          <input type="number" class="form-control" id="exampleInputPrioritas" name="prioritas" placeholder="Prioritas Jabatan" value="{{ $item->prioritas }}">
                        </div>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-gradient-primary mr-2">Simpan</button>
                    <a href="{{url('sub-jabatan')}}" class="btn btn-light">Batal</a>
                  </form>
                  @endforeach
                </div>
              </div>
            </div>
      </div>
    </div>
    <!-- content-wrapper ends -->
    @include('backend.dashboard.templates.footer')