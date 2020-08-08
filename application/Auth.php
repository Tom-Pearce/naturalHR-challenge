<?php

  class Auth{

    function __construct(){
      require_once 'models/authModel.php';
      $authModel = new authModel();
    }

    function index(){

      $this->authModel->user_exists('tom@tom.com', 'TXM123lol');
    }

  }
 ?>
