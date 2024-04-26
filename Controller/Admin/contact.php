<?php 
   $act = 'contact';
   if(isset($_GET['act'])) {
      $act = $_GET['act'];
   }

   switch($act) {
      case 'contact':
         include_once './View/Admin/Contact.php';
         break;
      case 'update_status':
         include_once('../../Model/DBConfig.php');
         include_once('../../Model/API.php');
         include_once('../../Model/Contact.php');
         $connect = new connect();
         $API = new API();
         $contact = new Contact();
         $contact_id = $_POST['contact_id'];
         $result = $contact->update_status($contact_id);
         if($result == 1) {
            $res = [
               'status' => 200, 
               'message' => 'Bạn đã thay đổi trạng thái thành công'
            ];
         }
         echo json_encode($res);
         break;
      case 'delete_contact':
         include_once('../../Model/DBConfig.php');
         include_once('../../Model/API.php');
         include_once('../../Model/Contact.php');
         $connect = new connect();
         $API = new API();
         $contact = new Contact();
         $contact_id = $_POST['contact_id'];
         $result_wait = $contact->getContact_Wait($contact_id)->fetchAll();
         // echo count($result_wait);exit;
         if(count($result_wait) > 0) {
            $res = [
               'status' => 403, 
               'message' => 'Bạn không thể xóa vì liên hệ chưa xử lý'
            ];
         }else {
            $result = $contact->delete_contact($contact_id);
            if($result == 1) {
               $res = [
                  'status' => 200, 
                  'message' => 'Bạn đã xóa thành công'
               ];
            }
         }
         echo json_encode($res);
         break;
   }