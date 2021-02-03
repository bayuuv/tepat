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
              </span> Anggota
            </h3>
            <nav aria-label="breadcrumb">
              <ul class="breadcrumb">
                  <a href="{{url('anggota/add')}}">
                    <button type="button" class="btn btn-gradient-primary btn-rounded btn-fw"><span class="mdi mdi-plus"></span>&nbsp;Tambah Anggota</button>
                  </a>
              </ul>
            </nav>
          </div>
          @if(Session::has('message'))
          <div class="alert {{ Session::get('class') }}" role="alert">
            <strong>{{ Session::get('message') }}</strong>
          </div>
          @endif
          <form action="{{ url('anggota/export_excel/') }}" method="get">
          <div class="row">
            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                  <div class="col">
                      <h4 class="card-title">
                    Anggota
                   <div style="margin-right: 70px;">
                                @if($pilihan_kedua != null || $pilihan_kedua != '' && $count != null)
                                <div id="atas"><h5>{{ $pilihan_kedua }} &nbsp  {{ $count }}</h5></div>
                                <!-- @else
                                <h5 class="card-title">Yayasan</h5>&nbsp -->
                                @endif
                                <!-- </div> -->
                                <div id="atas1"></div>
                                <div class="col">
                                    <div class="form-inline">
                                        <label style="font-size:14px;">Pilih</label>&nbsp
                                        <!-- <select id="pilih_kesatu" name="pilih_kesatu" onchange="pilihKesatu();" style="font-size:14px;">
                                            @if($id_level == '')
                                            <option value="1" selected>- Semua -</option>
                                            <option value="2">Yayasan</option>
                                            <option value="3">Wilayah</option>
                                            <option value="4">Unit</option>
                                            @elseif($id_level == '2')
                                            <option value="1">- Semua -</option>
                                            <option value="2" selected>Yayasan</option>
                                            <option value="3">Wilayah</option>
                                            <option value="4">Unit</option>
                                            @elseif($id_level == '3')
                                            <option value="1">- Semua -</option>
                                            <option value="2">Yayasan</option>
                                            <option value="3" selected>Wilayah</option>
                                            <option value="4">Unit</option>
                                            @elseif($id_level == '4')
                                            <option value="1">- Semua -</option>
                                            <option value="2">Yayasan</option>
                                            <option value="3">Wilayah</option>
                                            <option value="4" selected>Unit</option>
                                            @endif
                                        </select> -->
                                        <select id="pilih_kesatu" name="pilih_kesatu" style="font-size:14px;">
                                            <option value="1" selected>- Semua -</option>
                                            <option value="2">Yayasan</option>
                                            <option value="3">Wilayah</option>
                                            <option value="4">Unit</option>
                                        </select>
                                    </div>
                                    <div id="divwilayah" style="display:none;">
                                      <div class="form-inline" style="padding-top:10px">
                                        <label style="font-size:14px;">Pilih Wilayah</label>&nbsp
                                        <div id="wilayah1"></div>
                                        <select id="pilihWilayah" name="pilih_kedua" style="font-size:14px;">
                                          <option value="">Semua Wilayah</option>
                                        </select>
                                      </div>
                                    </div>
                                    <div id="divwilayah2" style="display:none;">
                                      <div class="form-inline" style="padding-top:10px">
                                        <label style="font-size:14px;">Pilih Wilayah</label>&nbsp
                                        <div id="wilayah2"></div>
                                        <select id="pilihWilayah" name="pilihWilayah" style="font-size:14px;">
                                          <option value="">Semua Wilayah</option>
                                        </select>
                                      </div>
                                    </div>
                                    <div id="divunit" style="display:none;">
                                      <div class="form-inline" style="padding-top:10px">
                                        <label style="font-size:14px;">Pilih Unit</label>&nbsp
                                        <div id="unit1"></div>
                                        <select id="pilihUnit" name="pilih_kedua" style="font-size:14px;">
                                          <option value="">Semua Unit</option>
                                        </select>
                                      </div>
                                    </div>
                                    <div id="divunit2" style="display:none;">
                                      <div class="form-inline" style="padding-top:10px">
                                        <label style="font-size:14px;">Pilih Unit</label>&nbsp
                                        <div id="unit2"></div>
                                        <select id="pilihUnit" name="pilihUnit" style="font-size:14px;">
                                        <option value="">Semua Unit</option>
                                        </select>
                                      </div>
                                    </div>
                                    <!-- @if($id_level == 3)
                                        <div class="form-inline" style="padding-top:10px">
                                            <label>Pilih</label>&nbsp
                                            <select id="pilih_kedua" name="pilih_kedua" onchange="pilihKedua();" style="font-size:14px;">
                                                <option value="all">- semua -</option>
                                                @foreach($pilihanKedua as $item)
                                                @if($id_akun == $item['id_akun'])
                                                <option value="{{ $item['id_akun'] }}" selected>{{ $item['nama_akun'] }}</option>
                                                @else
                                                <option value="{{ $item['id_akun'] }}">{{ $item['nama_akun'] }}</option>
                                                @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    @elseif($id_level == 4)
                                        <div class="form-inline" style="padding-top:10px">
                                            <label>Pilih</label>&nbsp
                                            <select id="pilih_kedua" name="pilih_kedua" onchange="pilihKedua();" style="font-size:14px;">
                                                <option value="all">- semua -</option>
                                                @foreach($pilihanKedua as $item)
                                                @if($id_akun == $item['id_akun'])
                                                <option value="{{ $item['id_akun'] }}" selected>{{ $item['nama_akun'] }}</option>
                                                @else
                                                <option value="{{ $item['id_akun'] }}">{{ $item['nama_akun'] }}</option>
                                                @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    @endif -->
                                </div>
                            </div> 
                   </form>
                  </h4>
                  </div>
                  <div class="col">
                       @if(Session::get('level') == 'Super Admin' || Session::get('level') == 'Admin')
                        <input type="submit" value="Export" class="btn btn-gradient-primary ml-3 mt-3 mr-3 mb-3" style="float:right;"/>
                        <a onclick="downloadPDF();" class="btn btn-gradient-primary ml-3 mt-3 mr-3 mb-3" style="float:right;color:white;">
                            Download PDF
                        </a>
                        @endif
                  </div> 
                  </div> 
                  <div class="table-responsive">
                    <table  id="tables" class="table">
                      <thead>
                        <tr>
                          <th> # </th>
                          @if(Session::get('level') == 'Super Admin' || Session::get('level') == 'Admin')
                          <th> No. Anggota </th>
                          <th> Nama</th>
                          <th> NIK</th>
                          <th> Alamat </th>
                          <th> Jenis Kelamin </th>
                          <th> Keterangan </th>
                          <th> Jabatan </th>
                          <th> Opsi </th>
                          <th> Status </th>
                          @else
                          <th> No. Anggota </th>
                          <th> Nama</th>
                          <th> Alamat </th>
                          <th> Jenis Kelamin </th>
                          <th> Keterangan </th>
                          <th> Jabatan </th>
                          <th> Opsi </th>
                          @endif
                        </tr>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          </form>
        </div>
        <!-- content-wrapper ends -->
@section('js')
<script>
$(document).ready(function() {

  var table = $('#tables').DataTable({
    processing: true,
    serverSide: true,
    "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, 'All']], // page length options
    dom: 'lBfrtip',
    <?php if(Session::get('level') == 'Super Admin' || Session::get('level') == 'Admin'){ ?>
    buttons: [
      {
        extend: 'excel',
        exportOptions: {
          columns: [0,1,2,3,4,5,6,7]
        }
      },
      {
        extend: 'pdf',
        exportOptions: {
          columns: [0,1,2,3,4,5,6,7]
        }
      }
    ],
    <?php } ?>
    ajax:{
      url: "{{url('anggota/getList')}}",
      dataType: "json",
      type: "POST",
      data: function (d) {
        d._token = "{{ csrf_token() }}";
      },
    },
    <?php if(Session::get('level') == 'Super Admin' || Session::get('level') == 'Admin'){ ?>
    columns: [
      { "data": "no" },
      { "data": "no_anggota" },
      { "data": "nama_anggota" }, 
      { "data": "nik" },
      { "data": "alamat" },
      { "data": "jenis_kelamin" },
      { "data": "nama_akun" },
      { "data": "jabatan" },
      { "data": "opsi", orderable: false},
      { "data": "status", orderable: false}
    ],
    <?php }else{ ?>
    columns: [
      { "data": "no" },
      { "data": "no_anggota" },
      { "data": "nama_anggota" }, 
      { "data": "alamat" },
      { "data": "jenis_kelamin" },
      { "data": "nama_akun" },
      { "data": "jabatan" },
      { "data": "opsi", orderable: false}
    ],
    <?php } ?>
    "order": [[ 1, "desc" ]],
    pageLength : 10
  });
});

$('select[name="pilih_kesatu"]').on('change', function() {
  var yayasan = $('select[name="pilih_kesatu"]').val();

  if(yayasan === '2'){

    $.ajax({
      url: "anggota/wilayah/"+yayasan,
      type: "GET",
      dataType: "json",
      success:function(data) {
        $('#atas').remove();
        $('#atas1').append('<div id="atas"><h5 class="card-title">Yayasan - '+ data.jml +'</h5></div>');
      }
    });
  
    document.getElementById("divunit").style.display = "none";
    document.getElementById("divwilayah").style.display = "none";
    $('#tables').DataTable().destroy();
    $('#tables').DataTable({
      processing: true,
      serverSide: true,
      "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, 'All']], // page length options
      dom: 'lBfrtip',
      ajax:{
        url: "{{url('anggota/getList')}}",
        dataType: "json",
        type: "POST",
        data: function (d) {
          d._token = "{{ csrf_token() }}";
          d.wilayah = yayasan;
        }
      },
      <?php if(Session::get('level') == 'Super Admin' || Session::get('level') == 'Admin'){ ?>
      columns: [
        { "data": "no" },
        { "data": "no_anggota" },
        { "data": "nama_anggota" }, 
        { "data": "nik" },
        { "data": "alamat" },
        { "data": "jenis_kelamin" },
        { "data": "nama_akun" },
        { "data": "jabatan" },
        { "data": "opsi", orderable: false},
        { "data": "status", orderable: false}
      ],
      <?php }else{ ?>
      columns: [
        { "data": "no" },
        { "data": "no_anggota" },
        { "data": "nama_anggota" }, 
        { "data": "alamat" },
        { "data": "jenis_kelamin" },
        { "data": "nama_akun" },
        { "data": "jabatan" },
        { "data": "opsi", orderable: false}
      ],
      <?php } ?>
      "order": [[ 1, "desc" ]],
      pageLength : 10
    }).ajax.reload();
  
  //Pilih Wilayah
  }else if(yayasan === '3'){
    $.ajax({
      url: "anggota/wilayah/"+yayasan,
      type: "GET",
      dataType: "json",
      success:function(data) {
        $('#atas').remove();
        $('#atas1').append('<div id="atas"><h5 class="card-title">Wilayah - '+ data.jml +'</h5></div>');

        document.getElementById("divwilayah").style.display = "block";
        document.getElementById("divwilayah2").style.display = "none";
        document.getElementById("divunit").style.display = "none";
        document.getElementById("divunit2").style.display = "none";
        $('select[id="pilihWilayah"]').remove();
        $('#wilayah1').append('<select id="pilihWilayah" name="pilih_kedua" style="font-size:14px;">');
        $('select[id="pilihWilayah"]').append('<option value="wilayah">- Semua Wilayah -</option>');
        $.each(data.wilayah, function(key, value) {
          $('select[id="pilihWilayah"]').append('<option value="'+ key +'">'+ value +'</option>');
        });
        $('#wilayah1').append('</select>');

        $('#tables').DataTable().destroy();
        $('#tables').DataTable({
          processing: true,
          serverSide: true,
          "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, 'All']], // page length options
          dom: 'lBfrtip',
          ajax:{
            url: "{{url('anggota/getList')}}",
            dataType: "json",
            type: "POST",
            data: function (d) {
              d._token = "{{ csrf_token() }}";
              d.wilayah = yayasan;
            }
          },
          <?php if(Session::get('level') == 'Super Admin' || Session::get('level') == 'Admin'){ ?>
          columns: [
            { "data": "no" },
            { "data": "no_anggota" },
            { "data": "nama_anggota" }, 
            { "data": "nik" },
            { "data": "alamat" },
            { "data": "jenis_kelamin" },
            { "data": "nama_akun" },
            { "data": "jabatan" },
            { "data": "opsi", orderable: false},
            { "data": "status", orderable: false}
          ],
          <?php }else{ ?>
          columns: [
            { "data": "no" },
            { "data": "no_anggota" },
            { "data": "nama_anggota" }, 
            { "data": "alamat" },
            { "data": "jenis_kelamin" },
            { "data": "nama_akun" },
            { "data": "jabatan" },
            { "data": "opsi", orderable: false}
          ],
          <?php } ?>
          "order": [[ 1, "desc" ]],
          pageLength : 10
        }).ajax.reload();
      }
    });
  }else if(yayasan === '4'){
    
    $.ajax({
      url: "anggota/unitwilayah",
      type: "GET",
      dataType: "json",
      success:function(data) {
        $('#atas').remove();
        $('#atas1').append('<div id="atas"><h5 class="card-title">Unit - '+ data.jml +'</h5></div>');

        document.getElementById("divwilayah").style.display = "none";
        document.getElementById("divwilayah2").style.display = "block";
        $('select[id="pilihWilayah"]').remove();
        $('#wilayah2').append('<select id="pilihWilayah" name="pilihWilayah" style="font-size:14px;">');
        $('select[id="pilihWilayah"]').append('<option value="wilayah">- Semua Wilayah -</option>');
        $.each(data.wilayah, function(key, value) {
          $('select[id="pilihWilayah"]').append('<option value="'+ key +'">'+ value +'</option>');
        });
        $('#wilayah2').append('</select>');
       
        document.getElementById("divunit").style.display = "block";
        $('select[id="pilihUnit"]').remove();
        $('#unit1').append('<select id="pilihUnit" name="pilih_kedua" style="font-size:14px;">');
        $('select[id="pilihUnit"]').append('<option value="unit">- Semua Unit -</option>');
        $.each(data.unit, function(key, value) {
          $('select[id="pilihUnit"]').append('<option value="'+ key +'">'+ value +'</option>');
        });
        $('#unit1').append('</select>');

        $('#tables').DataTable().destroy();
        $('#tables').DataTable({
          processing: true,
          serverSide: true,
          "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, 'All']], // page length options
          dom: 'lBfrtip',
          ajax:{
            url: "{{url('anggota/getList')}}",
            dataType: "json",
            type: "POST",
            data: function (d) {
              d._token = "{{ csrf_token() }}";
              d.wilayah = "unit";
            }
          },
          <?php if(Session::get('level') == 'Super Admin' || Session::get('level') == 'Admin'){ ?>
          columns: [
            { "data": "no" },
            { "data": "no_anggota" },
            { "data": "nama_anggota" }, 
            { "data": "nik" },
            { "data": "alamat" },
            { "data": "jenis_kelamin" },
            { "data": "nama_akun" },
            { "data": "jabatan" },
            { "data": "opsi", orderable: false},
            { "data": "status", orderable: false}
          ],
          <?php }else{ ?>
          columns: [
            { "data": "no" },
            { "data": "no_anggota" },
            { "data": "nama_anggota" }, 
            { "data": "alamat" },
            { "data": "jenis_kelamin" },
            { "data": "nama_akun" },
            { "data": "jabatan" },
            { "data": "opsi", orderable: false}
          ],
          <?php } ?>
          "order": [[ 1, "desc" ]],
          pageLength : 10
        }).ajax.reload();
      }
    });

  }else if(yayasan === '1'){
    $.ajax({
      url: "anggota/wilayah/"+yayasan,
      type: "GET",
      dataType: "json",
      success:function(data) {
        $('#atas').remove();
        $('#atas1').append('<div id="atas"><h5 class="card-title">Yayasan - '+ data.jml +'</h5></div>');
      }
    });
    
    document.getElementById("divunit").style.display = "none";
    document.getElementById("divwilayah").style.display = "none";
    $('#tables').DataTable().destroy();
    
    var table = $('#tables').DataTable({
      processing: true,
      serverSide: true,
      "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, 'All']], // page length options
      dom: 'lBfrtip',
      ajax:{
        url: "{{url('anggota/getList')}}",
        dataType: "json",
        type: "POST",
        data: function (d) {
          d._token = "{{ csrf_token() }}";
        }
      },
      <?php if(Session::get('level') == 'Super Admin' || Session::get('level') == 'Admin'){ ?>
      columns: [
        { "data": "no" },
        { "data": "no_anggota" },
        { "data": "nama_anggota" }, 
        { "data": "nik" },
        { "data": "alamat" },
        { "data": "jenis_kelamin" },
        { "data": "nama_akun" },
        { "data": "jabatan" },
        { "data": "opsi", orderable: false},
        { "data": "status", orderable: false}
      ],
      <?php }else{ ?>
      columns: [
        { "data": "no" },
        { "data": "no_anggota" },
        { "data": "nama_anggota" }, 
        { "data": "alamat" },
        { "data": "jenis_kelamin" },
        { "data": "nama_akun" },
        { "data": "jabatan" },
        { "data": "opsi", orderable: false}
      ],
      <?php } ?>
      "order": [[ 1, "desc" ]],
      pageLength : 10
    }).ajax.reload();
  }
});

$('#wilayah1').on('change', function() {
  var wil = $('select[id="pilihWilayah"]').val();
  $.ajax({
      url: "anggota/unit/"+wil,
      type: "GET",
      dataType: "json",
      success:function(data) {
        $('#atas').remove();
        $('#atas1').append('<div id="atas"><h5 class="card-title">Wilayah - '+ data.jml +'</h5></div>');

        $('#tables').DataTable().destroy();
    
        var table = $('#tables').DataTable({
          processing: true,
          serverSide: true,
          "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, 'All']], // page length options
          dom: 'lBfrtip',
          ajax:{
            url: "{{url('anggota/getList')}}",
            dataType: "json",
            type: "POST",
            data: function (d) {
              d._token = "{{ csrf_token() }}";
              d.wilayah = wil;
            }
          },
          <?php if(Session::get('level') == 'Super Admin' || Session::get('level') == 'Admin'){ ?>
          columns: [
            { "data": "no" },
            { "data": "no_anggota" },
            { "data": "nama_anggota" }, 
            { "data": "nik" },
            { "data": "alamat" },
            { "data": "jenis_kelamin" },
            { "data": "nama_akun" },
            { "data": "jabatan" },
            { "data": "opsi", orderable: false},
            { "data": "status", orderable: false}
          ],
          <?php }else{ ?>
          columns: [
            { "data": "no" },
            { "data": "no_anggota" },
            { "data": "nama_anggota" }, 
            { "data": "alamat" },
            { "data": "jenis_kelamin" },
            { "data": "nama_akun" },
            { "data": "jabatan" },
            { "data": "opsi", orderable: false}
          ],
          <?php } ?>
          "order": [[ 1, "desc" ]],
          pageLength : 10
        }).ajax.reload();
      }
    });
});

$('#divunit').on('change', function() {
  var unit = $('select[id="pilihUnit"]').val();

  $('#tables').DataTable().destroy();
    
    var table = $('#tables').DataTable({
      processing: true,
      serverSide: true,
      "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, 'All']], // page length options
      dom: 'lBfrtip',
      ajax:{
        url: "{{url('anggota/getList')}}",
        dataType: "json",
        type: "POST",
        data: function (d) {
          d._token = "{{ csrf_token() }}";
          d.unit = unit;
        }
      },
      <?php if(Session::get('level') == 'Super Admin' || Session::get('level') == 'Admin'){ ?>
      columns: [
        { "data": "no" },
        { "data": "no_anggota" },
        { "data": "nama_anggota" }, 
        { "data": "nik" },
        { "data": "alamat" },
        { "data": "jenis_kelamin" },
        { "data": "nama_akun" },
        { "data": "jabatan" },
        { "data": "opsi", orderable: false},
        { "data": "status", orderable: false}
      ],
      <?php }else{ ?>
      columns: [
        { "data": "no" },
        { "data": "no_anggota" },
        { "data": "nama_anggota" }, 
        { "data": "alamat" },
        { "data": "jenis_kelamin" },
        { "data": "nama_akun" },
        { "data": "jabatan" },
        { "data": "opsi", orderable: false}
      ],
      <?php } ?>
      "order": [[ 1, "desc" ]],
      pageLength : 10
    }).ajax.reload();
});

$('#divwilayah2').on('change', function() {
  var wil = $('select[id="pilihWilayah"]').val();
  var unit = $('select[id="pilihUnit"]').val();

  $.ajax({
      url: "anggota/wil/"+wil,
      type: "GET",
      dataType: "json",
      success:function(data) {
        $('#atas').remove();
        $('#atas1').append('<div id="atas"><h5 class="card-title">Unit - '+ data.jml +'</h5></div>');

        document.getElementById("divunit").style.display = "none";
        document.getElementById("divunit2").style.display = "block";
        $('select[id="pilihUnit"]').remove();
        $('#unit2').append('<select id="pilihUnit" name="pilih_kedua" style="font-size:14px;">');
        $('select[id="pilihUnit"]').append('<option value="">- Semua Unit -</option>');
        $.each(data.unit, function(key, value) {
          $('select[id="pilihUnit"]').append('<option value="'+ key +'">'+ value +'</option>');
        });
        $('#unit2').append('</select>');

        $('#tables').DataTable().destroy();
        $('#tables').DataTable({
          processing: true,
          serverSide: true,
          "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, 'All']], // page length options
          dom: 'lBfrtip',
          ajax:{
            url: "{{url('anggota/getList')}}",
            dataType: "json",
            type: "POST",
            data: function (d) {
              d._token = "{{ csrf_token() }}";
              d.wilayah = wil;
              d.unit = unit;
            }
          },
          <?php if(Session::get('level') == 'Super Admin' || Session::get('level') == 'Admin'){ ?>
          columns: [
            { "data": "no" },
            { "data": "no_anggota" },
            { "data": "nama_anggota" }, 
            { "data": "nik" },
            { "data": "alamat" },
            { "data": "jenis_kelamin" },
            { "data": "nama_akun" },
            { "data": "jabatan" },
            { "data": "opsi", orderable: false},
            { "data": "status", orderable: false}
          ],
          <?php }else{ ?>
          columns: [
            { "data": "no" },
            { "data": "no_anggota" },
            { "data": "nama_anggota" }, 
            { "data": "alamat" },
            { "data": "jenis_kelamin" },
            { "data": "nama_akun" },
            { "data": "jabatan" },
            { "data": "opsi", orderable: false}
          ],
          <?php } ?>
          "order": [[ 1, "desc" ]],
          pageLength : 10
        }).ajax.reload();
      }
  });

$('#divunit2').on('change', function() {
  var wil = $('select[id="pilihWilayah"]').val();
  var unit = $('select[id="pilihUnit"]').val();

  $.ajax({
      url: "anggota/wil2/"+unit,
      type: "GET",
      dataType: "json",
      success:function(data) {
        $('#atas').remove();
        $('#atas1').append('<div id="atas"><h5 class="card-title">Unit - '+ data.jml +'</h5></div>');

        $('#tables').DataTable().destroy();
    
        var table = $('#tables').DataTable({
          processing: true,
          serverSide: true,
          "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, 'All']], // page length options
          dom: 'lBfrtip',
          ajax:{
            url: "{{url('anggota/getList')}}",
            dataType: "json",
            type: "POST",
            data: function (d) {
              d._token = "{{ csrf_token() }}";
              d.unit = unit;
              d.wilayah = wil;
            }
          },
          <?php if(Session::get('level') == 'Super Admin' || Session::get('level') == 'Admin'){ ?>
          columns: [
            { "data": "no" },
            { "data": "no_anggota" },
            { "data": "nama_anggota" }, 
            { "data": "nik" },
            { "data": "alamat" },
            { "data": "jenis_kelamin" },
            { "data": "nama_akun" },
            { "data": "jabatan" },
            { "data": "opsi", orderable: false},
            { "data": "status", orderable: false}
          ],
          <?php }else{ ?>
          columns: [
            { "data": "no" },
            { "data": "no_anggota" },
            { "data": "nama_anggota" }, 
            { "data": "alamat" },
            { "data": "jenis_kelamin" },
            { "data": "nama_akun" },
            { "data": "jabatan" },
            { "data": "opsi", orderable: false}
          ],
          <?php } ?>
          "order": [[ 1, "desc" ]],
          pageLength : 10
        }).ajax.reload();
      }
  });
});  

});

</script>
@endsection('js')
@include('backend.dashboard.templates.footer')