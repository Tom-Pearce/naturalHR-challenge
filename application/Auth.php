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
      echo eval('views/auth/login_page.php');
    }

  }
 ?>
