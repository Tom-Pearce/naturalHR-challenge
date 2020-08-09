<?php
require_once 'models/authModel.php';
  class Signup{
    function task(){
      $errors = array();

      $authModel = new authModel();
      // Get POST variables
      $first_name = trim($_POST['first_name']);
      $last_name = trim($_POST['last_name']);
      $email = trim($_POST['email']);
      $password = trim($_POST['password']);
      $password_confirm = trim($_POST['password_confirm']);

      // Validate First Name
      if(!$first_name){
        $errors[] = 'First name is required';
      }else{
        if(strlen($first_name) > 128){
          $errors[] = 'First name must be less than 128 characters';
        }
      }

      // Validate Last Name
      if(!$last_name){
        $errors[] = 'Last name is required';
      }else{
        if(strlen($last_name) > 128){
          $errors[] = 'Last name must be less than 128 characters';
        }
      }

      // Validate email
      if(!$email){
        $errors[] = 'Email is required';
      }else{
        if(strlen($email) > 128){
          $errors[] = 'Email must be less than 128 characters';
        }
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
          $errors[] = 'Please enter a valid email';
        }

        if($authModel->email_in_use($email)){
          $errors[] = 'Email in use. Please enter a unique email.';
        }
      }

      // Validate password
      if(!$password){
        $errors[] = 'Password is required';
      }else{
        if(strlen($password) < 8){
          $errors[] = 'Password must be at least 8 characters';
        }elseif(strlen($password) > 32){
          $errors[] = 'Password must be less than 32 characters';
        }
      }

      // Validate password confirm
      if(!$password_confirm){
        $errors[] = 'Password Confirm is required';
      }else{
        if(strlen($password_confirm) < 8){
          $errors[] = 'Password Confirm must be at least 8 characters';
        }elseif(strlen($password_confirm) > 32){
          $errors[] = 'Password confirmmust be less than 32 characters';
        }

        if($password_confirm !== $password){
          $errors[] = 'Passwords must match';
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
        if($authModel->create_user($first_name, $last_name, $email, $password)){
          $response = array(
            'code' => 1,
            'type' => 'success',
            'title' => 'Success',
            'message' => 'Successfully signed up new account!',
          );
        }else{
          $response = array(
            'code' => 0,
            'type' => 'error',
            'title' => 'Error',
            'message' => 'Failed to sign up new account',
          );
        }
      }

      echo json_encode($response);
    }
  }
?>
