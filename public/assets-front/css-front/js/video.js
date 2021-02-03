// $('#modal1').on('hidden.bs.modal', function (e) {
//     // do something...
//     $('#modal1 iframe').attr("src", $("#modal1 iframe").attr("src"));
//   });
  
//   // $('#modal6').on('hidden.bs.modal', function (e) {
//   //   // do something...
//   //   $('#modal6 iframe').attr("src", $("#modal6 iframe").attr("src"));
//   // });
  
//   // $('#modal4').on('hidden.bs.modal', function (e) {
//   //   // do something...
//   //   $('#modal4 iframe').attr("src", $("#modal4 iframe").attr("src"));
//   // });
$(document).ready(function(){
  $('.modal').each(function(){
          var src = $(this).find('iframe').attr('src');

      $(this).on('click', function(){

          $(this).find('iframe').attr('src', '');
          $(this).find('iframe').attr('src', src);

      });
  });
});