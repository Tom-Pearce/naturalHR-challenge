<?php
require_once 'libraries/authLib.php';
  class Home{
    
    function index(){

      $authLib = new authLib();

      if($authLib->logged_in()){
        ob_start();
        include('views/home/file_upload_view');
        ob_end_flush();
      }else{
        http_response_code(401);
      }
    }
  }
?>
