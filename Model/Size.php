<?php 
   class size {
      function getAll_size() {
         $api = new API();
         return $api->get_All("SELECT * FROM size");
      }

      function get_sizeByName($size) {
         $api = new API();
         return $api->get_one("SELECT * FROM size WHERE size='$size'");
      }
      function add_size($size) {
         $api = new API();
         $api->add_delete_update("INSERT INTO size(size) VALUES ('$size')");
      }

      function delete_size($size_id) {
         $api = new API();
         $api->add_delete_update("DELETE FROM size WHERE id=$size_id");
      }
   }