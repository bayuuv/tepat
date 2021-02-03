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
          Tambah Galeri
        </h3>
        <nav aria-label="breadcrumb">
          <ul class="breadcrumb">
              <a href="{{url('setting-pages/galeri')}}">Galeri</a>&nbsp;/&nbsp;Tambah Galeri baru
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
                  <h4 class="card-title">Galeri</h4>
                  <p class="card-description"> Tambah Galeri baru </p>
                  <form action="{{url('setting-pages/galeri/store')}}" class="forms-sample" method="POST" enctype="multipart/form-data">
                      {{ csrf_field() }}
                    <div class="row">
                      <div class="col">
                        <div class="form-group">
                          <label for="exampleInputJudul">Judul</label>&nbsp<label style="color:red;">{{$errors->first('judul')}}</label>
                          <input type="text" class="form-control" id="exampleInputJudul" name="judul" placeholder="Judul" value="{{ old('judul') }}">
                        </div>
                        <div class="form-group">
                            <label>Cover</label>
                            <input type="file" name="cover_file" class="file-upload-default">
                            <div class="input-group col-xs-12">
                              <input type="text" class="form-control file-upload-info" name="img_cover" placeholder="Unggah cover">
                              <span class="input-group-append">
                                <button class="file-upload-browse btn btn-gradient-primary" type="button">Upload</button>
                              </span>
                            </div>
                        </div>
                        <div class="form-group">
                          <label for="inputIsi">Gambar</label>&nbsp<label style="color:red;">{{$errors->first('gambar')}}</label>
                          <input type="file" id="gambar" name="gambar[]" accept=".jpg, .png, .jpeg" multiple>
                        </div>
                        <div class="form-group">
                          <label for="exampleInputVideo">Link</label>&nbsp<label style="color:red;">{{$errors->first('video')}}</label>
                          <input type="text" class="form-control" id="exampleInputVideo" name="video" placeholder="Link Video Youtube" value="{{ old('video') }}">
                        </div>
                        <div class="form-group">
                          <label for="ket">Keterangan</label>&nbsp<label style="color:red;">{{$errors->first('ket')}}</label>
                            <textarea name="ket" id="ket"></textarea>
                            <script type="text/javascript">
                                var editor = CKEDITOR.replace('ket');
                                CKFinder.setupCKEditor(editor);
                            </script>
                        </div>
                        <div class="form-group">
                          <label for="exampleInputTipe">Tipe</label>&nbsp<label style="color:red;">{{$errors->first('tipe')}}</label>
                          <select class="form-control" id="exampleInputTipe" name="tipe">
                            <option>Pilih Tipe</option>
                            <option value="gambar">Gambar</option>
                            <option value="video">Video</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-gradient-primary mr-2">Simpan</button>
                    <a href="{{url('setting-pages/galeri')}}" class="btn btn-light">Batal</a>
                  </form>
                </div>
              </div>
            </div>
      </div>
    </div>
    <!-- content-wrapper ends -->
    @include('backend.dashboard.templates.footer2')