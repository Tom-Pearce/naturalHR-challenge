<?php

  class authLib{

    function generate_token($user_id = NULL, $iv = NULL){

      // If user ID passed (they authenticated)
      if($user_id){

        if(!$iv){
          $cstrong = FALSE;
          while (!$cstrong){
            $iv = openssl_random_pseudo_bytes(rand(100, 200), $cstrong);
          }
        }

        // Get current time
        $timestamp = time();

        // Generate data array - set expiry to 1 hour from now
        $data = array(
          'expires' => $timestamp + 3600,
          'user_id' => $user_id,
        );

        $response = array(
          'token' => $token = openssl_encrypt(json_encode($data), "AES-128-CBC", 'Lj6cReD7{hcVGUE{BFD.Qa]7Ht4Nal03', NULL, $iv),
          'iv' => $iv,
        );

        return $response;
      }else{
        return NULL;
      }
    }

    function validate_token($token = NULL, $iv = NULL){
      if($token && $iv){
        // Decrypt token
        $data = json_decode(openssl_decrypt($token, "AES-128-CBC", 'Lj6cReD7{hcVGUE{BFD.Qa]7Ht4Nal03', NULL, $iv));

        // Validate data in token
        if(isset($data['expires']) && isset($data['user_id']) && $data['expires'] > time()){
          return TRUE;
        }else{
          return FALSE;
        }
      }else{
        return FALSE;
      }
    }

    function logged_in(){

      // Has token been supplied
      if (isset($_SERVER['HTTP_BEARER_X']) && isset($_SERVER['HTTP_IV'])) {
        $token = $_SERVER['HTTP_BEARER_X'];
        return $this->validate_token($token);
      }else{
        return FALSE;
      }
    }

  }
 ?>
