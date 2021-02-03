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
              </span> Galeri 
            </h3>
            <nav aria-label="breadcrumb">
              <ul class="breadcrumb">
                  <a href="{{url('setting-pages/galeri/add')}}">
                    <button type="button" class="btn btn-gradient-primary btn-rounded btn-fw"><span class="mdi mdi-plus"></span>&nbsp;Tambah Galeri</button>
                  </a>
              </ul>
            </nav>
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
                  <h4 class="card-title">Galeri</h4>
                  <div class="table-responsive">
                    <table  id="datatable" class="table">
                      <thead>
                        <tr>
                          <th> # </th>
                          <th> Judul </th>
                          <th> Tipe </th>
                          <th> Opsi </th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach($data as $item)
                        <tr>
                          <td>{{$loop->iteration}}</td>
                          @if($item['tipe'] == 'Gambar')
                          <td> <img src="{{ url('public/uploaded_files/galeri/'.$item['cover'])}}" class="mr-2" alt="image"> {{$item['judul']}} </td>
                          <td>{{$item['tipe']}}</td>
                          @else
                          <td>{{$item['judul']}}</td>
                          <td>{{$item['tipe']}}</td>
                          @endif
                          <td>
                          @if($item['tipe'] == 'Gambar')
                            <form class="form-group pull-right" action="{{url('setting-pages/galeri/delete/'.$item['id_galeri'].'/'.$item['cover'])}}" method="POST">
                              {{csrf_field()}}
                              {{method_field('delete')}}
                              <a href="{{url('setting-pages/galeri/edit/'.$item['id_galeri'])}}"> <span class="mdi mdi-lead-pencil" style="color:#32bf90;"></span></a>
                              <button type="submit" style="background:none;border:none;color:#007bff;"><span class="mdi mdi-delete" style="color:#32bf90;"></i></button>
                            </form>
                          @else
                          <form class="form-group pull-right" action="{{url('setting-pages/galeri/delete/'.$item['id_galeri'].'/null')}}" method="POST">
                              {{csrf_field()}}
                              {{method_field('delete')}}
                              <a href="{{url('setting-pages/galeri/edit/'.$item['id_galeri'])}}"> <span class="mdi mdi-lead-pencil" style="color:#32bf90;"></span></a>
                              <button type="submit" style="background:none;border:none;color:#007bff;"><span class="mdi mdi-delete" style="color:#32bf90;"></i></button>
                            </form>
                          @endif
                          </td>
                        </tr>
                      @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
        @include('backend.dashboard.templates.footer')