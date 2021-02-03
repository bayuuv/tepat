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
          Infromas Web
        </h3>
        <nav aria-label="breadcrumb">
          <ul class="breadcrumb">
              <a href="{{url('dashboard')}}">Dashboard</a>&nbsp;/&nbsp;Infromas Web
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
                  <h4 class="card-title">Infromas Web</h4>
                  <p class="card-description"> Informasi Kontak Web </p>
                  @foreach($data as $item)
                  <form action="{{url('setting-pages/web-profile/informasi-web/update')}}" class="forms-sample" method="POST" enctype="multipary/form-data">
                      {{ csrf_field() }}
                    <div class="row">
                      <div class="col">
                      <div class="form-group">
                          <label for="inputIsi">Konten</label>&nbsp<label style="color:red;">{{$errors->first('isi')}}</label>
                          <textarea name="isi" id="isi">
                            {{ $item->kontak }}
                          </textarea>
                          <script type="text/javascript">
                            var editor = CKEDITOR.replace('isi');
                            CKFinder.setupCKEditor(editor);
                          </script>
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
    @include('backend.dashboard.templates.footer2')