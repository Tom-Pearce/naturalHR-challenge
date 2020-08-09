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

      // Encrypt password before running query - databse passwords encrypted
      $pass = openssl_encrypt($pass, "AES-128-CBC", 'Lj6cReD7{hcVGUE{BFD.Qa]7Ht4Nal03', NULL, 'ec2724f0a353ad7c');
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

      if($result->num_rows == 1){
        $result = $result->fetch_assoc()['id'];
      }else{
        $result = FALSE;
      }

      $query->close();
      $mysqli->close();

      return $result;
    }

    // Check if email is already used
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

    // Create user record
    function create_user($first_name, $last_name, $email, $password){
      $mysqli = $this->connect();

      $sql = 'INSERT
        INTO users (first_name, last_name, email, password)
        VALUES (?, ?, ?, ?)
      ';

      // Encrypt password
      $password = openssl_encrypt($password, "AES-128-CBC", 'Lj6cReD7{hcVGUE{BFD.Qa]7Ht4Nal03', NULL, 'ec2724f0a353ad7c');
      $query = $mysqli->prepare($sql);
      $query->bind_param('ssss', $first_name, $last_name, $email, $password);
      $query->execute();
      $query->get_result();
      $affected_rows = $query->affected_rows;
      $user_id = $query->insert_id;

      $query->close();
      $mysqli->close();
      return $affected_rows;
    }

  }
 ?>
