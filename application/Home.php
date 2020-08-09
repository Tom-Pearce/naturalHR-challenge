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

    function upload_file(){

      $authLib = new authLib();

      if($authLib->logged_in()){
        if(0 < $_FILES['userfile']['error']){
          $response = array(
            'code' => 0,
            'type' => 'error',
            'title' => 'Failed to upload',
            'message' => 'Failed to upload chosen file: ' . $_FILES['userfile']['error'],
          );
        }else{
          $allowed_types = array(
            'text/plain',
            'application/pdf',
            'image/png',
            'image/jpeg',
            'application/msword'
          );
          if(in_array(mime_content_type($_FILES['userfile']['tmp_name']), $allowed_types)){
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'files/' . $_FILES['userfile']['name']);
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
