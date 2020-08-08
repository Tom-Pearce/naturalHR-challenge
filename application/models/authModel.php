<?php
  class authModel{

    function connect(){
      $mysqli = mysqli_init();
      // $mysqli->options(MYSQLI_OPT_SSL_VERIFY_SERVER_CERT, TRUE);
      // $mysqli->ssl_set(NULL, NULL, "certs/cleardb-ca.pem", NULL, NULL);
      $mysqli->real_connect('eu-cdbr-west-03.cleardb.net', 'bf591c69497412', 'b1a72d1a', 'heroku_f3ea27317562590');
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
        WHERE users.email = \'tom@tom.com\'
          AND users.password = \'
          AND users.active = 1';
      $query = $mysqli->prepare($sql);
      // $query->bind_param('ss', $email, $pass);
      $result = $query->execute();
      echo '<br /><br />mysqli:';
      var_dump($mysqli);
      echo '<br /><br />$query:';
      var_dump($query);
      echo '<br /><br />result:';
      var_dump($result);
      echo '<br /><br />data2:';
      var_dump($mysqli->fetch_assoc());
      $mysqli->close();
    }

  }
 ?>
