<?php
  class homeModel{

    function connect(){
      $mysqli = mysqli_init();
      // $mysqli->options(MYSQLI_OPT_SSL_VERIFY_SERVER_CERT, TRUE);
      // $mysqli->ssl_set(NULL, NULL, "certs/cleardb-ca.pem", NULL, NULL);
      $mysqli->real_connect('eu-cdbr-west-03.cleardb.net', 'bf591c69497412', 'b1a72d1a', 'heroku_f3ea27317562590');
      return $mysqli;
    }

    function insert_user_file($user_id, $file_name){
      $mysqli = $this->connect();

      $sql = 'INSERT
        INTO user_files (user_id, file_name)
        VALUES (?, ?)';
      $query = $mysqli->prepare($sql);
      $query->bind_param('ss', $user_id, $file_name);
      $query->execute();
      $query->get_result();
      $affected_rows = $query->affected_rows;
      $file_id = $query->insert_id;

      $query->close();
      $mysqli->close();
      if($affected_rows){
        return $file_id;
      }else{
        return FALSE;
      }
    }

    function list_uploaded_files(){
      $mysqli = $this->connect();

      $sql = 'SELECT *
        FROM user_files AS file
        JOIN users
          ON users.id = file.user_id
        WHERE file.status = 1';

      $result = $mysqli->query($sql);

      $data = array();
      while ($row = $result->fetch_assoc()) {
        $data[] = $row;
      }

      $mysqli->close();

      return $data;
    }

  }
?>
