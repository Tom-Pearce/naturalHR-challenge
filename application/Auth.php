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
      ob_end_flush();
    }

  }
 ?>
