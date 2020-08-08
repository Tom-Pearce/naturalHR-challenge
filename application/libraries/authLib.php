<?php

  class authLib{

    function generate_token($user_id = NULL){

      // If user ID passed (they authenticated)
      if($user_id){

        // Get current time
        $timestamp = now();

        // Generate data array - set expiry to 1 hour from now
        $data = array(
          'expires' => $timestamp + 3600,
          'user_id' => $user_id,
        );

        return $token = openssl_encrypt(json_encode($data), "AES-128-CBC", 'Lj6cReD7{hcVGUE{BFD.Qa]7Ht4Nal03');
      }else{
        return NULL;
      }
    }

    function validate_token($token = NULL){
      if($token){
        $data = json_decode(openssl_encrypt($token, "AES-128-CBC", 'Lj6cReD7{hcVGUE{BFD.Qa]7Ht4Nal03'));

        if(isset($data['expires']) && isset($data['user_id']) && $data['expires'] > now()){
          return TRUE;
        }else{
          return FALSE;
        }
      }else{
        return FALSE;
      }
    }

    function logged_in(){

      if (isset($_SERVER['HTTP_BEARER_X'])) {
        $token = $_SERVER['HTTP_BEARER_X'];
        return $this->validate_token($token);
      }else{
        return FALSE;
      }
    }

  }
 ?>
