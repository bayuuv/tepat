@include('backend.dashboard.templates.header2')
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
          Tambah Berita
        </h3>
        <nav aria-label="breadcrumb">
          <ul class="breadcrumb">
              <a href="{{url('setting-pages/berita')}}">Berita</a>&nbsp;/&nbsp;Tambah Berita baru
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
                  <h4 class="card-title">Berita</h4>
                  <p class="card-description"> Tambah Berita baru </p>
                  <form action="{{url('setting-pages/berita/store')}}" class="forms-sample" method="POST" enctype="multipart/form-data">
                      {{ csrf_field() }}
                    <div class="row">
                      <div class="col">
                        <div class="form-group">
                          <label for="exampleInputJudul">Judul</label>&nbsp<label style="color:red;">{{$errors->first('judul')}}</label>
                          <input type="text" class="form-control" id="exampleInputJudul" name="judul" placeholder="Judul Berita" value="{{ old('judul') }}">
                        </div>
                        <div class="form-group">
                            <label>Cover</label>
                            <input type="file" name="cover_file" class="file-upload-default" accept=".jpg, .png, .jpeg">
                            <div class="input-group col-xs-12">
                              <input type="text" class="form-control file-upload-info" name="img_cover" placeholder="Unggah cover">
                              <span class="input-group-append">
                                <button class="file-upload-browse btn btn-gradient-primary" type="button">Upload</button>
                              </span>
                            </div>
                        </div>
                        <div class="form-group">
                          <label for="inputIsi">Konten</label>&nbsp<label style="color:red;">{{$errors->first('konten')}}</label>
                          <textarea name="konten" id="konten"></textarea>
                          <script type="text/javascript">
                            var editor = CKEDITOR.replace('konten');
                            CKFinder.setupCKEditor(editor);
                          </script>
                        </div>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-gradient-primary mr-2">Simpan</button>
                    <a href="{{url('setting-pages/berita')}}" class="btn btn-light">Batal</a>
                  </form>
                </div>
              </div>
            </div>
      </div>
    </div>
    <!-- content-wrapper ends -->
    @include('backend.dashboard.templates.footer2')