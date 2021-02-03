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
          Beranda Web
        </h3>
        <nav aria-label="breadcrumb">
          <ul class="breadcrumb">
              <a href="{{url('dashboard')}}">Dashboard</a>&nbsp;/&nbsp;Beranda Web
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
                  <h4 class="card-title">Beranda Web</h4>
                  <p class="card-description"> Informasi Beranda Web </p>
                  @foreach($data as $item)
                  <form action="{{url('setting-pages/web-profile/update')}}" class="forms-sample" method="POST" enctype="multipart/form-data">
                      {{ csrf_field() }}
                    <div class="row">
                      <div class="col">
                        <div class="form-group">
                          <label for="exampleInputName1">Judul</label>&nbsp<label style="color:red;">{{$errors->first('judul')}}</label>
                          <input type="text" class="form-control" id="exampleInputName1" name="judul" placeholder="Judul Website" value="{{ $item['judul'] }}">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputSubtitle">Subtitle</label>&nbsp<label style="color:red;">{{$errors->first('subtitle')}}</label>
                          <input type="text" class="form-control" id="exampleInputSubtitle" name="subtitle" placeholder="Subtitle Website" value="{{ $item['subtitle'] }}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputKeterangan">Keterangan</label><label style="color:red;">&nbsp{{$errors->first('ket')}}</label>
                            <textarea name="ket" class="editor_ket">{{ $item['ket'] }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="inputIsi">Isi</label>&nbsp<label style="color:red;">{{$errors->first('isi')}}</label>
                            <textarea name="isi" class="editor">{{ $item->isi }}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Logo</label>
                            <input type="file" name="logo_file" class="file-upload-default" accept=".jpg, .png, .jpeg">
                            <div class="input-group col-xs-12">
                              <input type="text" class="form-control file-upload-info" name="img_name" placeholder="Unggah cover" value="{{ $item->logo }}">
                              <span class="input-group-append">
                                <button class="file-upload-browse btn btn-gradient-primary" type="button">Upload</button>
                              </span>
                            </div>
                        </div>
                      </div>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-gradient-primary mr-2">Simpan</button>
                    <a href="{{url('dashboard')}}" class="btn btn-light">Batal</a>
                  </form>
                  @endforeach
                </div>
              </div>
            </div>
      </div>
    </div>
    <!-- content-wrapper ends -->
    @include('backend.dashboard.templates.footer')