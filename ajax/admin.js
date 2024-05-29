$(document).ready(() => {
   $(document).on('submit', '#form_add_admin', function (event) {
      event.preventDefault();
      alert(123)
      $result_name = check_name('#emp_name')
      $result_start_date = check_empty('#datepicker')
      $result_usernamename = check_empty('#emp_username')
      $result_password = check_empty('#emp_password')
      $result_name = check_empty('#emp_name')
      $result_phone = check_number_phone('#emp_phone')
      $result_role = check_empty('#emp_role')
   })
})