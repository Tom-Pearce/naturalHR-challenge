<?php
  class authModel{

    function connect(){
      $myfile = fopen("certs/cleardb-ca.pem", "w");
      fwrite($myfile, "-----BEGIN CERTIFICATE-----
      MIIEBzCCAu+gAwIBAgIJAPs/TPnO24QSMA0GCSqGSIb3DQEBBQUAMIGZMQswCQYD
      VQQGEwJVUzEOMAwGA1UECAwFVGV4YXMxDTALBgNVBAcMBFdhY28xHTAbBgNVBAoM
      FFN1Y2Nlc3NCcmlja3MgSW5jIENBMRQwEgYDVQQLDAtFbmdpbmVlcmluZzESMBAG
      A1UEAwwJQ0EgTWFzdGVyMSIwIAYJKoZIhvcNAQkBFhNzdXBwb3J0QGNsZWFyZGIu
      Y29tMB4XDTExMDgwOTE5NTcxOVoXDTM4MTIyNDE5NTcxOVowgZkxCzAJBgNVBAYT
      AlVTMQ4wDAYDVQQIDAVUZXhhczENMAsGA1UEBwwEV2FjbzEdMBsGA1UECgwUU3Vj
      Y2Vzc0JyaWNrcyBJbmMgQ0ExFDASBgNVBAsMC0VuZ2luZWVyaW5nMRIwEAYDVQQD
      DAlDQSBNYXN0ZXIxIjAgBgkqhkiG9w0BCQEWE3N1cHBvcnRAY2xlYXJkYi5jb20w
      ggEiMA0GCSqGSIb3DQEBAQUAA4IBDwAwggEKAoIBAQDl3xOV5yj2XkwCgMZ2H3AV
      TZrGf/LhuX1EByOaoYeutBQfzb049wp4olmFhcL7ZXmsBJb3/7fYwyxs6rbJ0diz
      nGFATOaEWE7yNm14gIagL6xb+Arqh9TrlF77Wts32RHIQvCAt1Sw8VeoBhWKLp96
      gCC1ZRSHEdh0qaTOFXRgEUGXOmtPtwiNaDwVsaYN82a9AfhKqdygRMzAPYZk29cr
      jZy13CMgz8JZIGEKRxTqbl8ClR+A6aW3Opgf6hD/vASGigGfgbjNNPeEHUUYHj8y
      W3OWn7CrItdm/2TXG0xdks5VPJonHY5KdhSLobJZCyR9Oc00bT4gSOsDEKO4+t3J
      AgMBAAGjUDBOMB0GA1UdDgQWBBRs1gyV3ammzQYMNt78zZpXDz74GzAfBgNVHSME
      GDAWgBRs1gyV3ammzQYMNt78zZpXDz74GzAMBgNVHRMEBTADAQH/MA0GCSqGSIb3
      DQEBBQUAA4IBAQATIQy8MJ9aZ4z6ourkHeY/RmkfMF2lfpknsPWkab/DpTkfQ4Zt
      Av8ZP+lCYzdoBm98FJoOhLNJxgI4M1jHg4ubccoL6r+MWBUMCT5KW6zFyom9p1wY
      D8dpIdzV8cTmsJTt3vrUWkC+aP2Dz3EaMHzH14JyLRxqhoOOr456y6HD4SXEwzW3
      8n8N9J15Rpp6Am/y+dVEXquUf0Qj7l67ElIgDByBitV4AVUnmmu7C/Kn+GzTKFet
      yLGbEXgbgalggtnUItm4nFIrcOh51xxnTNtWDNktD06/0Oss5OY901VVwSm0JmV0
      LtNgymxXhQAJVDVaIAn4C0/Hh8GudcAs/QKv
      -----END CERTIFICATE-----
");
      $mysqli = mysqli_init();
      $mysqli->options(MYSQLI_OPT_SSL_VERIFY_SERVER_CERT, TRUE);
      $mysqli->ssl_set(NULL, NULL, "certs/cleardb-ca.pem", NULL, NULL);
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
