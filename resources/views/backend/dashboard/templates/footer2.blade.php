      <!-- partial:partials/_footer.html -->
      <footer class="footer">
        <div class="d-sm-flex justify-content-center justify-content-sm-between">
          <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2020 <a href="#">Ongsky</a>. All rights reserved.</span>
          <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="mdi mdi-heart text-danger"></i></span>
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
<!--<script src="https://unpkg.com/@popperjs/core@2.0.0/dist/umd/popper.min.js"></script>-->
<script src="{{asset('public/assets/bootstrap-select/dist/js/bootstrap-select.min.js')}}"></script>
<!--<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>-->
<script>
  $(document).ready(function() {
    $('#datatable').DataTable();
  } );
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
    // console.error( 'Oops, something gone wrong!' );
    // console.error( 'Please, report the following error in the https://github.com/ckeditor/ckeditor5 with the build id and the error stack trace:' );
    // console.warn( 'Build id: 895v777og9ik-ef8uspjxx4c9' );
    // console.error( error );
  } );
</script>
<script>
function selectAnggota(){
  var anggota = document.getElementById("select_anggota");
  // var nama = anggota.options[anggota.selectedIndex].value;
  var nama = document.getElementById('nama');
  document.getElementById("inputNama").value=nama.innerText;
}
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script type="text/javascript">
    function cek_database(){
        var no_anggota = $("#select_anggota").val();
        $.ajax({
            url: '{{url('pengurus/get-anggota/')}}' + '/' + no_anggota,
            type: 'get',
            data:{} ,
        }).success(function (data) {
          if (data.success == true) {
            document.getElementById("nama_anggota").value=data.info[0].nama_anggota;
          } 
           
        });
    }
</script>
<!-- End js for this page -->
</body>
</html>