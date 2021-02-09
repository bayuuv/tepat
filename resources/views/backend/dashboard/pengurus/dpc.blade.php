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
              </span> Pengurus Korwil
            </h3>
            <nav aria-label="breadcrumb">
              <ul class="breadcrumb">
                  <a href="{{url('pengurus/add-dpc')}}">
                    <button type="button" class="btn btn-gradient-primary btn-rounded btn-fw"><span class="mdi mdi-plus"></span>&nbsp;Pengurus Korwil</button>
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
                  <h4 class="card-title">Pengurus Korwil</h4>
                  <div class="form-inline" style="padding-top:10px">
                      <label>Pilih Korwil</label>&nbsp
                      <select id="pilih_wil" name="pilih_wil" onchange="pilihWil();" style="font-size:14px;">
                          <option value="all">- semua -</option>
                          @foreach($pilihanKedua as $item)
                          @if($id_akun == $item['nama_akun'])
                          <option value="{{ $item['nama_akun'] }}" selected>{{ $item['nama_akun'] }}</option>
                          @else
                          <option value="{{ $item['nama_akun'] }}">{{ $item['nama_akun'] }}</option>
                          @endif
                          @endforeach
                        </select>
                  </div>
                  <br><br>
                  <div class="table-responsive">
                    <table  id="datatable" class="table">
                      <thead>
                        <tr>
                          <th> # </th>
                          <th> No. Anggota </th>
                          <th> Nama</th>
                          <th> NIK</th>
                          <th> Alamat </th>
                          <th> Jenis Kelamin </th>
                          <th> Keterangan </th>
                          <th> Jabatan </th>
                          <th> Opsi </th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach($data as $item)
                        <tr>
                          <td>{{$loop->iteration}}</td>
                          <td> <img src="{{ url('public/uploaded_files/anggota/foto/'.$item->foto) }}" class="mr-2" alt="image"> {{$item->no_anggota}}</td>
                          <td>{{$item->nama_anggota}}</td>
                          <td>{{$item->nik}}</td>
                          <td>{{$item->alamat}}</td>
                          <td>
                            @if($item->jenis_kelamin == 'L')
                            Laki-laki
                            @else
                            Perempuan
                            @endif
                          </td>
                          <td>{{$item->nama_akun}}</td>
                          <td>
                          @if($item->id_jabatan == 1 && $item->id_sub_jabatan != 1)
                            {{$item->nama_sub_jabatan}}
                          @elseif($item->id_jabatan != 1 && $item->id_sub_jabatan == 1)
                            {{$item->jabatan}}
                          @else
                            {{$item->jabatan}} ({{$item->nama_sub_jabatan}})
                          @endif
                          </td>
                          <td>
                            <form class="form-group pull-right" action="{{url('pengurus/delete-dpc/'.$item->no_anggota)}}" method="GET">
                              <a href="{{url('pengurus/edit-dpc/'.$item->no_anggota)}}"> <span class="mdi mdi-lead-pencil" style="color:#32bf90;"></span></a>
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