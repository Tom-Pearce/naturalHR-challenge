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

      $sql = 'SELECT *
        FROM users
        WHERE users.email = ?
          AND users.password = ?
          AND users.active = 1
        LIMIT 1';

      $query = $mysqli->prepare($sql);
      $query->bind_param('ss', $email, $pass);
      $query->execute();
      $result = $query->get_result();

      // if($result->num_rows == 1){
      //   $data = $result->fetch_assoc();
      // }else{
      //   while ($row = $result->fetch_assoc()) {
      //     $data[] = $row;
      //   }
      // }
      // return $data;

      if($result->num_rows == 1){
        $result = $result->fetch_assoc()['id'];
      }else{
        $result = FALSE;
      }

      $query->close();
      $mysqli->close();

      return $result;
    }

    function email_in_use($email){
      $mysqli = $this->connect();

      $sql = 'SELECT *
        FROM users
        WHERE users.email = ?
        LIMIT 1';

      $query = $mysqli->prepare($sql);
      $query->bind_param('s', $email );
      $query->execute();
      $result = $query->get_result();
      $num_rows = $result->num_rows;

      $query->close();
      $mysqli->close();
      return $num_rows;
    }

    function create_user($first_name, $last_name, $email, $password){
      $mysqli = $this->connect();

      $sql = 'INSERT
        INTO users (first_name, last_name, email, password)
        VALUES (?, ?, ?, ?)
      ';

      $query = $mysqli->prepare($sql);
      $query->bind_param('ssss', $first_name, $last_name, $email, $password);
      $query->execute();
      $result = $query->get_result();
      $num_rows = $result->num_rows;
      var_dump($query);
      echo '<br /><bR />';
      var_dump($result);
      $query->close();
      $mysqli->close();
      return $num_rows;
    }

  }
 ?>
