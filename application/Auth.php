<?php

  class Auth{

    function index(){

      var_dump($_SERVER['HTTP_BEARER_X']);
      // require_once 'models/authModel.php';
      // $authModel = new authModel();
      // $authModel->user_exists('tom@tom.com', 'TXM123lol');


    }

  }
 ?>
