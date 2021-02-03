      <!-- partial:partials/_footer.html -->
      <footer class="footer">
        <div class="d-sm-flex justify-content-center justify-content-sm-between">
          <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2020. All rights reserved.</span>
        </div>
      </footer>
      <!-- partial -->
    </div>
    <!-- main-panel ends -->
  </div>
  <!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->
<!-- plugins:js -->
<script src="{{asset('public/assets/vendors/js/vendor.bundle.base.js')}}"></script>
<!-- endinject -->
<!-- Plugin js for this page -->
<script src="{{asset('public/assets/vendors/chart.js/Chart.min.js')}}"></script>
<!-- End plugin js for this page -->
<!-- inject:js -->
<script src="{{asset('public/assets/js/off-canvas.js')}}"></script>
<script src="{{asset('public/assets/js/hoverable-collapse.js')}}"></script>
<script src="{{asset('public/assets/js/misc.js')}}"></script>
<!-- endinject -->
<!-- Custom js for this page -->
<script src="{{asset('public/assets/js/dashboard.js')}}"></script>
<script src="{{asset('public/assets/js/todolist.js')}}"></script>
<script src="{{asset('public/assets/js/file-upload.js')}}"></script>
<script src="{{asset('public/assets/js/bootstrap.min.js')}}"></script>
<script src="{{asset('public/assets/datatable/datatables.min.js')}}"></script>
<!-- edit by @bayuuv -->
<script src="{{asset('public/assets/bootstrap-fileinput/bootstrap-fileinput.js')}}"></script>
@yield('js')
<script>
  $(document).ready(function() {
    $('#datatable').DataTable();
  });
</script>
<script src="{{asset('public/assets/ckeditor/build/ckeditor.js')}}"></script>
<script>ClassicEditor
  .create( document.querySelector( '.editor' ), {
    
    toolbar: {
      items: [
        'heading',
        '|',
        'bold',
        'italic',
        'link',
        'bulletedList',
        'numberedList',
        '|',
        'indent',
        'outdent',
        '|',
        'undo',
        'redo',
        'alignment',
        'blockQuote'
      ]
    },
    language: 'id',
    table: {
      contentToolbar: [
        'tableColumn',
        'tableRow',
        'mergeTableCells'
      ]
    },
    licenseKey: '',
    
  } )
  .then( editor => {
    window.editor = editor;

    
    
    
  } )
  .catch( error => {
    console.error( 'Oops, something gone wrong!' );
    console.error( 'Please, report the following error in the https://github.com/ckeditor/ckeditor5 with the build id and the error stack trace:' );
    console.warn( 'Build id: 895v777og9ik-ef8uspjxx4c9' );
    console.error( error );
  } );
</script>
<script>ClassicEditor
  .create( document.querySelector( '.editor_ket' ), {
    
    toolbar: {
      items: [
        'heading',
        '|',
        'bold',
        'italic',
        'link',
        'bulletedList',
        'numberedList',
        '|',
        'indent',
        'outdent',
        '|',
        'undo',
        'redo',
        'alignment',
        'blockQuote'
      ]
    },
    language: 'id',
    table: {
      contentToolbar: [
        'tableColumn',
        'tableRow',
        'mergeTableCells'
      ]
    },
    licenseKey: '',
    
  } )
  .then( editor => {
    window.editor = editor;

    
    
    
  } )
  .catch( error => {
    console.error( 'Oops, something gone wrong!' );
    console.error( 'Please, report the following error in the https://github.com/ckeditor/ckeditor5 with the build id and the error stack trace:' );
    console.warn( 'Build id: 895v777og9ik-ef8uspjxx4c9' );
    console.error( error );
  } );
</script>
<script src="{{asset('public/assets/bootstrap-select/dist/js/bootstrap-select.min.js')}}"></script>
<script>
function selectAnggota(){
  var anggota = document.getElementById("select_anggota");
  // var nama = anggota.options[anggota.selectedIndex].value;
  var nama = document.getElementById('nama');
  document.getElementById("inputNama").value=nama.innerText;
}
</script>
<script type="text/javascript">
    function cek_database(){
        var no_anggota = $("#select_anggota").val();
        $.ajax({
            url: '{{url('pengurus/get-anggota/')}}' + no_anggota,
            type: 'get',
            data:{} ,
        }).success(function (data) {
          if (data.success == true) {
            document.getElementById("nama_anggota").value=data.info[0].nama_anggota;
          } 
           
        });
    }
</script>
<script type="text/javascript">
function sortirAnggota() {
  var value = document.getElementById("sortir_anggota").value;
  if(value == 2){
    window.location.href = '{{url('anggota/get')}}/' + 2;
  }
  else if(value == 3){
    window.location.href = '{{url('anggota/get')}}/' + 3;
  }
  else if(value == 4){
    window.location.href = '{{url('anggota/get')}}/' + 4;
  }
  else{
    window.location.href = '{{url('anggota/get')}}/' + 'all';
  }
}
</script>
<script type="text/javascript">
function sortirDPC() {
  var value = document.getElementById("sortir_dpc").value;
  if(value != 'all'){
    window.location.href = '{{url('pac/sortir-dpc')}}/' + value;
  }
  else{
    window.location.href = '{{url('pac/sortir-dpc')}}/' + 'all';
  }
}
</script>
<script type="text/javascript">
function pilihKesatu() {
  var value = document.getElementById("pilih_kesatu").value;
  if(value == 1){
    window.location.href = '{{url('anggota/pilih_kesatu/1')}}';
  }
  if(value == 2){
    window.location.href = '{{url('anggota/pilih_kesatu/2')}}';
  }
  if(value == 3){
    window.location.href = '{{url('anggota/pilih_kesatu/3')}}';
  }
  if(value == 4){
    window.location.href = '{{url('anggota/pilih_kesatu/4')}}';
  }
}
function pilihKedua() {
  var value1 = document.getElementById("pilih_kesatu").value;
  var value2 = document.getElementById("pilih_kedua").value;
  
  if(value1 > 2 && value2 == 'all'){
      window.location.href = '{{url('anggota/pilih_kesatu/')}}/' + value1;
  }
  if(value1 == 3 && value2 != 'all'){
      window.location.href = '{{url('anggota/dpc/')}}/' + value2;
  }
  if(value1 == 4 && value2 != 'all'){
      window.location.href = '{{url('anggota/pac/')}}/' + value2;
  }
}
function pilihWil() {
  var val1 = document.getElementById("pilih_wil").value;
  
  if(val1 == 'all'){
      window.location.href = '{{url('pengurus/dpc')}}/';
  }else{
    window.location.href = '{{url('pengurus/dpc/wil/')}}/' + val1;
  }
}
function pilihWilayah() {
  var val1 = document.getElementById("pilih_wilayah").value;
  
  if(val1 == 'all'){
      window.location.href = '{{url('pengurus/pac')}}/';
  }else{
    window.location.href = '{{url('pengurus/pac/wil/')}}/' + val1;
  }
}
function pilihUnit() {
  var val1 = document.getElementById("pilih_wilayah").value;
  var val2 = document.getElementById("pilih_unit").value;
  
  if(val1 == 'all'){
    window.location.href = '{{url('pengurus/pac/wil/')}}/' + val1;
  }else{
    window.location.href = '{{url('pengurus/pac/wil/')}}/' + val1 + '/unit/' + val2;
  }
}
</script>
<script type="text/javascript">
    function pilihCabang(){
        var pilihan = $("#id_akun").val();
        var dpc = document.getElementById("dpc");
        var pac = document.getElementById("pac");
        if(pilihan == 2){
            dpc.style.display = "none";
            pac.style.display = "none";
        }
        if(pilihan == 3){
            dpc.style.display = "block";
            pac.style.display = "none";
        }
        if(pilihan == 4){
            dpc.style.display = "none";
            pac.style.display = "block";
        }
    }
</script>
<script type="text/javascript">
    function editpilihCabang(){
        var pilihan = $("#id_akun").val();
        var dpc = document.getElementById("dpc");
        var pac = document.getElementById("pac");
        
        if(pilihan == 2){
            dpc.style.display = "none";
            pac.style.display = "none";
        }
        if(pilihan == 3){
            dpc.style.display = "block";
            pac.style.display = "none";
        }
        if(pilihan == 4){
            dpc.style.display = "none";
            pac.style.display = "block";
        }
    }
</script>
<script>
    function downloadPDF(){
      var value1 = document.getElementById("pilih_kesatu").value;
      
      if(value1 != 1 && value2 != 'all'){
        var value2 = document.getElementById("pilih_kedua").value;
        window.location.href = '{{url('anggota/download-pdf/')}}/' + value1 + '/' + value2;          
      }
      else{
        window.location.href = '{{url('anggota/download-pdf/')}}/' + 1 + '/' + null;
      }
    }
</script>
<!-- End js for this page -->
</body>
</html>