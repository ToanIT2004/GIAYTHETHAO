$(document).ready(function (){
      $(document).on('click','#login_submit',function(){
         // var data = new FormData();
         $.ajax({
            url:'Controller/User.php?act=login_action',
            method:'post',
            data:'',
            dataType: 'json', // Chỉ định kiểu dữ liệu trả về là JSON
            success:function(res){
               console.log(res.email);
            },
            error: function(xhr, status, error) {
               // Xử lý lỗi nếu có
               console.error(status + ': ' + error);
           }
        })
         
      })
})