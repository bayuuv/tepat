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
          Edit Divisi
        </h3>
        <nav aria-label="breadcrumb">
          <ul class="breadcrumb">
              <a href="{{url('jabatan')}}">Divisi</a>&nbsp;/&nbsp;Edit Divisi
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
                  <h4 class="card-title">Jabatan</h4>
                  <p class="card-description"> Edit Divisi </p>
                  @foreach($data as $item)
                  <form action="{{url('jabatan/update')}}" class="forms-sample" method="POST">
                      {{ csrf_field() }}
                    <input type="hidden" name="id_jabatan" value="{{$item->id_jabatan}}">
                    <div class="row">
                      <div class="col">
                        <div class="form-group">
                          <label for="exampleInputName1">Nama Divisi</label>&nbsp<label style="color:red;">{{$errors->first('nama_jabatan')}}</label>
                          <input type="text" class="form-control" id="exampleInputName1" name="nama_jabatan" placeholder="Nama Divisi" value="{{$item->jabatan}}">
                        </div>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-gradient-primary mr-2">Simpan</button>
                    <a href="{{url('jabatan')}}" class="btn btn-light">Batal</a>
                  </form>
                  @endforeach
                </div>
              </div>
            </div>
      </div>
    </div>
    <!-- content-wrapper ends -->
    @include('backend.dashboard.templates.footer')