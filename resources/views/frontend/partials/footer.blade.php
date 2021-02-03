    <!-- Footer Section Begin -->
        <footer class="footer " style="background: #D90429">
        <div class="container">
            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            <div class="footer__copyright__text">
                <!--<h4 class="mt-2" style="color:white;">Bagikan Web ini</h4>-->
                <label class="mr-2" style="color:white;" >Bagikan</label>
                <a class="mr-2" href="https://t.me/share/url?url=https://temanparta.com/&text="><i class="fa fa-telegram" style="color:white;" aria-hidden="true"></i></a>
                <a class="mr-2" href="https://wa.me/?text=https://temanparta.com/" ><i class="fa fa-whatsapp" style="color:white;" aria-hidden="true"></i></a>
                <a class="mr-2" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Ftemanparta.com%2F&amp;src=sdkpreparse"><i class="fa fa-facebook" style="color:white;" aria-hidden="true"></i></a>
                 <!-- Copyright -->
                  <div class="footer-copyright py-2"  style="color:white;">Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved
                  </div>
                  <!-- Copyright -->
            </div>
        
        </div>
    </footer>
    <!-- Footer Section End -->
</body>

<!-- Js Plugins -->
<script src="{{ asset('public/assets-front/css-front/js/jquery-3.3.1.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="{{ asset('public/assets/bootstrap-select/dist/js/bootstrap-select.min.js')}}"></script>
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>-->
<script src="{{ asset('public/assets-front/css-front/js/bootstrap.min.js')}}"></script>
<script src="{{ asset('public/assets-front/css-front/js/jquery.nice-select.min.js')}}"></script>
<script src="{{ asset('public/assets-front/css-front/js/jquery-ui.min.js')}}"></script>
<script src="{{ asset('public/assets-front/css-front/js/jquery.magnific-popup.min.js')}}"></script>
<script src="{{ asset('public/assets-front/css-front/js/mixitup.min.js')}}"></script>
<script src="{{ asset('public/assets-front/css-front/js/jquery.slicknav.js')}}"></script>
<script src="{{ asset('public/assets-front/css-front/js/owl.carousel.min.js')}}"></script>
<script src="{{ asset('public/assets-front/css-front/js/main.js')}}"></script>
<script src="{{ asset('public/assets-front/css-front/js/galeri.js')}}"></script>
<script src="{{ asset('public/assets-front/css-front/js/video.js')}}"></script>
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://unpkg.com/@popperjs/core@^2.0.0"></script>-->
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/id_ID/sdk.js#xfbml=1&version=v7.0&appId=637503009993195&autoLogAppEvents=1" nonce="80p6wRJe"></script>
<script src="{{asset('public/assets/datatable/datatables.min.js')}}"></script>
<script>
    $(document).ready(function() {
        $('#datatable').DataTable();
    } );
    $('select').css('color','black');
</script>
<script type="text/javascript">
function pilihKesatu() {
  var value = document.getElementById("pilih_kesatu").value;
  if(value == 2){
    window.location.href = '{{url('struktur/pilih_kesatu/2')}}';
  }
  if(value == 3){
    window.location.href = '{{url('struktur/pilih_kesatu/3')}}';
  }
  if(value == 4){
    window.location.href = '{{url('struktur/pilih_kesatu/4')}}';
  }
}
function pilihKedua() {
  var value1 = document.getElementById("pilih_kesatu").value;
  var value2 = document.getElementById("pilih_kedua").value;
  
  if(value1 == 3){
      window.location.href = '{{url('struktur/dpc/')}}/' + value2;
  }
  if(value1 == 4){
      window.location.href = '{{url('struktur/pac/')}}/' + value2;
  }
}
//Edit by @bayuuv
function pilihKetiga() {
  var value1 = document.getElementById("pilih_kesatu").value;
  var value2 = document.getElementById("pilih_kedua").value;
  
  if(value1 == 4){
      window.location.href = '{{url('struktur/level/')}}/' + value1 + '/wil/' + value2 ;
  }
}
function pilihPac() {
  var value1 = document.getElementById("pilih_kesatu").value;
  var value2 = document.getElementById("pilih_kedua").value;
  var value3 = document.getElementById("pilih_ketiga").value;
  
  if(value1 == 4){
      window.location.href = '{{url('struktur/level/')}}/' + value1 + '/wil/' + value2 + '/pac/' + value3 ;
  }
}
</script>
</html>