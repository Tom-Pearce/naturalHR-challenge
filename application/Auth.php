<?php

  class Auth{

    function index(){
      require_once 'models/authModel.php';
      $authModel = new authModel();
      echo 'hello i am auth';
      $authModel->user_exists('tom@tom.com', 'TXM123lol');
    }

  }
 ?>
