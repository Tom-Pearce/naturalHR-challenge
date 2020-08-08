<?php
  $db_host = 'eu-cdbr-west-03.cleardb.net';
  $db_user = 'bf591c69497412';
  $db_pass = 'b1a72d1a';
  $db = 'heroku_f3ea27317562590';

  class authModel{

    function connect(){
      $mysqli = mysqli_init();
      $mysqli->options(MYSQLI_OPT_SSL_VERIFY_SERVER_CERT, TRUE);
      $mysqli->ssl_set(NULL, NULL, "certs/cleardb-ca.pem", NULL, NULL);
      $mysqli->real_connect($this->db_host, $this->db_user, $this->db_pass, $this->db);
      return $mysqli;
    }

    function user_exists($email, $pass){
      $mysqli = $this->connect();
      echo '<br /><br />';
      var_dump($mysqli);
      echo '<br /><br />';
      echo '<br /><br />';
      $sql = 'SELECT *
        FROM users
        WHERE users.email = ' . $email . '
          AND users.password = ' . $pass . '
          AND users.active = 1';
      $result = $mysqli->query($sql);
      echo '<br /><br />';
      var_dump($mysqli);
      echo '<br /><br />';
      var_dump($result);
      $mysqli->close();
    }

  }
 ?>
