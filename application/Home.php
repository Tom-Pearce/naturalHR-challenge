<?php
require_once 'libraries/authLib.php';
require_once 'models/homeModel.php';
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
      if($user_id = $authLib->logged_in()){
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

            $file_data = pathinfo($_FILES['userfile']['tmp_name']);
            $extension = $file_data['extension'];

            $homeModel = new homeModel();
            $file_id = $homeModel->insert_user_file($user_id, $_FILES['userfile']['name'], $extension);

            move_uploaded_file($_FILES['userfile']['tmp_name'], 'application/files/' . $file_id);
            readfile('application/files/' . $_FILES['userfile']['name']);
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

    function file_list(){
      $authLib = new authLib();
      if($user_id = $authLib->logged_in()){

        $homeModel = new homeModel();
        $data['files'] = $homeModel->list_uploaded_files();

        ob_start();
        extract($data);
        include('views/home/file_list_view.php');
        ob_end_flush();
      }else{
        http_response_code(401);
      }
    }
  }
?>
