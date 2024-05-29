<?php 
   class admin {
      function get_all_role() {
         $API = new API();
         return $API->get_All("SELECT * FROM role");
      }
   }