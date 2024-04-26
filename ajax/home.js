$(document).ready(() => {
   // Lấy value sxếp
   $('#arrange_select').on('change', function() {
      arrange_select = $(this).val();
      if(arrange_select == 1) {
         window.location.href = 'index.php?action=home&act=futsal';
      }else if(arrange_select == 2) {
         window.location.href = 'index.php?action=home&act=football';
      }else if(arrange_select == 3) {
         window.location.href = 'index.php?action=home&act=decrease';
      }else if(arrange_select == 4) {
         window.location.href = 'index.php?action=home&act=ascending';
      }else if(arrange_select == 0){
         window.location.href = 'index.php?action=home&act=home';
      }
   })
})