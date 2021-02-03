@include('backend.dashboard.templates.header')
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
              </span> User Profile
            </h3>
          </div>
          @if(Session::has('message'))
          <div class="alert {{ Session::get('class') }}" role="alert">
            <strong>{{ Session::get('message') }}</strong>
          </div>
          @endif
          <div class="row">
            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <form action="{{url('dashboard/update-password')}}" method="POST">
                      {{csrf_field()}}
                    <div class="row">
                        <div class="col">
                          <div class="form-group">
                            <label for="exampleInputOldPassword">Password Lama</label>
                            <input type="password" class="form-control" id="exampleInputOldPassword" name="old_password" placeholder="Masukkan Password saat ini">
                          </div>
                        </div>
                        <div class="col">
                          <div class="form-group">
                            <label for="exampleInputNewPassword">Password Baru</label>
                            <input type="password" class="form-control" id="exampleInputNewPassword" name="new_password" placeholder="Masukkan Password baru">
                          </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-gradient-primary mr-2">Submit</button>
                    <a href="{{url('dashboard')}}" class="btn btn-light">Cancel</a>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
        @include('backend.dashboard.templates.footer')