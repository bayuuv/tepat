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
              </span> Korcam 
            </h3>
            <nav aria-label="breadcrumb">
              <ul class="breadcrumb">
                  <a href="{{url('pac/add')}}">
                    <button type="button" class="btn btn-gradient-primary btn-rounded btn-fw"><span class="mdi mdi-plus"></span>&nbsp;Tambah data Korcam</button>
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
                  <h4 class="card-title">Korcam</h4>
                  <div class="col-2">
                    @if(Session::get('level') == 'Super Admin' || Session::get('level') == 'Admin')
                        <div class="form-group">
                          <label for="sortir_dpc">Urutkan berdasarkan</label>&nbsp<label style="color:red;">{{$errors->first('sortir_dpc')}}</label>
                            <select class="form-control" id="sortir_dpc" name="sortir_dpc" onchange="sortirDPC();">
                            <option value="all">Pilih Semua</option>
                            @foreach($dewan as $item)
                              @if($select == $item['id_dewan'])
                              <option value="{{ $item['id_dewan'] }}" selected>{{ $item['nama_akun'] }}</option>
                              @else
                              <option value="{{ $item['id_dewan'] }}">{{ $item['nama_akun']}}</option>
                              @endif
                            @endforeach
                            </select>
                        </div>
                    @endif
                  </div>
                  <div class="table-responsive">
                    <table  id="datatable" class="table">
                      <thead>
                        <tr>
                          <th> # </th>
                          <th> Wilayah </th>
                          <th> Nama Korcam</th>
                          <th> Alamat </th>
                          <th> Username </th>
                          <th> No. Telp </th>
                          <th> Opsi </th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach($data as $item)
                        <tr>
                          <td>{{$loop->iteration}}</td>
                          <td>{{$item->nama}}</td>
                          <td>{{$item->nama_pac}}</td>
                          <td>{{$item->alamat}}</td>
                          <td>{{$item->username}}</td>
                          <td>{{$item->no_telp}}</td>
                          <td>
                            <form class="form-group pull-right" action="{{url('pac/delete/'.$item->id_pac)}}" method="POST">
                              {{csrf_field()}}
                              {{method_field('delete')}}
                              <a href="{{url('pac/edit/'.$item->id_pac)}}"> <span class="mdi mdi-lead-pencil" style="color:#32bf90;"></span></a>
                              <!-- <button type="submit" style="background:none;border:none;color:#007bff;"><span class="mdi mdi-delete" style="color:#32bf90;"></i></button> -->
                            </form>
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