<?php
  require_once 'models/authModel.php';
  require_once 'libraries/authLib.php';

  class Auth{

    function index(){

      $authLib = new authLib();

      if($authLib->logged_in()){

      }else{
        $this->login();
      }

    }

    function login(){
      ob_start();
      include('views/frame/header_view.php');
      include('views/auth/login.php');
      include('views/frame/footer_view.php');
      ob_end_flush();
    }

    function login_task(){
      $errors = array();

      // Get POST variables
      $email = $_POST['email'];
      $password = $_POST['password'];

      // Validate email
      if(!$email){
        $errors[] = 'Email is required';
      }else{
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
          $errors[] = 'Please enter a valid email';
        }
      }

      // Validate password
      if(!$password){
        $errors[] = 'Password is required';
      }else{
        if(strlen($password) < 8){
          $errors[] = 'Password must be at least 8 characters';
        }
      }

      // If errors found, return to user
      if($errors){
        $response = array(
          'code' => -1,
          'errors' => $errors,
        );

      // Else validate credentials
      }else{
        $authModel = new authModel();
        $user_id = $authModel->user_exists($email, $password);
        if($user_id){
          $authLib = new authLib();
          $token = $authLib->generate_token($user_id);

          if($token){
            $response = array(
              'code' => 1,
              'token' => $token,
            );
          }else{
            $response = array(
              'code' => 0,
              'type' => 'error',
              'title' => 'Error',
              'message' => 'Failed to generate token',
            );
          }
        }else{
          $response = array(
            'code' => 0,
            'type' => 'error',
            'title' => 'Error',
            'message' => 'Invalid credentials. Please try again.',
          );
        }
      }

      echo json_encode($response);
    }

  }
 ?>
