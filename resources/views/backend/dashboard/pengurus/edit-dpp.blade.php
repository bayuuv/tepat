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
          Edit Pengurus Pusat
        </h3>
        <nav aria-label="breadcrumb">
          <ul class="breadcrumb">
              <a href="{{url('pengurus/dpp')}}">Edit</a>&nbsp;/&nbsp;Edit Pengurus Pusat
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
                  <h4 class="card-title">Yayasan</h4>
                  <p class="card-description"> Edit Pengurus Pusat </p>
                  @foreach($data as $items)
                  <form action="{{url('pengurus/update-dpp')}}" class="forms-sample" method="POST">
                      {{ csrf_field() }}
                    <input type="hidden" name="no_anggota" value="{{ $items->no_anggota }}">
                    <div class="row">
                      <div class="col">
                        <div class="form-group">
                            <label for="no_anggota">No. Anggota</label>&nbsp<label style="color:red;">{{$errors->first('no_anggota')}}</label>
                            <input type="text" class="form-control" id="no_anggota" name="no_anggota" placeholder="Nomor Anggota" value="{{ $items->no_anggota }}" disabled>
                        </div>
                        <div class="form-group">
                          <label for="nama_anggota">Nama</label>&nbsp<label style="color:red;">{{$errors->first('nama')}}</label>
                          <input type="text" class="form-control" id="nama_anggota" name="nama" placeholder="Nama Anggota" value="{{ $items->nama_anggota }}" disabled>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Jabatan</label>&nbsp<label style="color:red;">{{$errors->first('jabatan')}}</label>
                            <select class="form-control form-control-lg selectpicker" data-live-search="true" id="exampleFormControlSelect1" name="jabatan">
                                <option value="">Pilih Jabatan</opdion>
                                @foreach ($jabatan as $item)
                                @if($item->id_jabatan != $item->id_sub_jabatan )
                                @if($item->id_sub_jabatan == $items->id_sub_jabatan)
                                @if($item->jabatan != 'Tidak Ada')
                                <option value="{{$items['id_sub_jabatan']}}" selected>{{$items['jabatan']}}({{$items['nama_sub_jabatan']}})</option>
                                @else
                                <option value="{{$item['id_sub_jabatan']}}" selected>{{$items['nama_sub_jabatan']}}</option>
                                @endif
                                @else
                                @if($item->jabatan != 'Tidak Ada')
                                <option value="{{$item['id_sub_jabatan']}}">{{$items['jabatan']}}({{$items['nama_sub_jabatan']}})</option>
                                @else
                                <option value="{{$item['id_sub_jabatan']}}">{{$items['nama_sub_jabatan']}}</option>
                                @endif
                                @endif
                                @endif
                                @endforeach
                            </select>
                        </div>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-gradient-primary mr-2">Simpan</button>
                    <a href="{{url('pengurus/dpp')}}" class="btn btn-light">Batal</a>
                  </form>
                  @endforeach
                </div>
              </div>
            </div>
      </div>
    </div>
    <!-- content-wrapper ends -->
    @include('backend.dashboard.templates.footer2')