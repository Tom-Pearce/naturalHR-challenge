<?php

  class authModel{

    function __construct(){
      $db_host = 'eu-cdbr-west-03.cleardb.net';
      $db_user = 'bf591c69497412';
      $db_pass = 'b1a72d1a';
      $db = 'heroku_f3ea27317562590';
    }

    function user_exists($email, $pass){

      $mysqli = mysqli_init();
      $mysqli->options(MYSQLI_OPT_SSL_VERIFY_SERVER_CERT, TRUE);
      $mysqli->ssl_set(NULL, NULL, "certs/cleardb-ca.pem", NULL, NULL);
      $mysqli->real_connect($this->db_host, $this->db_user, $this->db_pass, $this->db);

      $sql = 'SELECT *
        FROM users
        WHERE users.email = ' . $email . '
          AND users.password = ' . $pass . '
          AND users.active = 1';
      $result = $mysqli->query($sql);
      var_dump($mysqli);
      var_dump($result);
      $mysqli->close();
    }

  }
 ?>
