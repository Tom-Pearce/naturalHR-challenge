<?php
require_once 'libraries/authLib.php';
  class Home{

    function index(){

      $authLib = new authLib();

      if($authLib->logged_in()){
        ob_start();
        include('views/home/file_upload_view.php');
        ob_end_flush();
      }else{
        http_response_code(401);
      }
    }

    function file_upload(){

      $authLib = new authLib();

      if($authLib->logged_in()){
        if($_FILES['file']['error']){
          $response = array(
            'code' => 0,
            'type' => 'error',
            'title' => 'Failed to upload',
            'message' => 'Failed to upload chosen file: ' . $_FILES['file']['error'],
          );
        }else{
          $allowed_types = array(
            'text/plain',
            'application/pdf',
            'image/png',
            'image/jpeg',
            'application/msword'
          );
          if(in_array(mime_content_type($_FILES['file']['tmp_name']), $allowed_types)){
            move_uploaded_file($_FILES['file']['tmp_name'], 'files/' . $_FILES['file']['name']);
          }else{
            $response = array(
              'code' => 0,
              'type' => 'error',
              'title' => 'Invalid type',
              'message' => 'File must be one of the following: ' . implode(', ', $allowed_types),
            );
          }
        }
      }else{
        http_response_code(401);
      }
    }
  }
?>
