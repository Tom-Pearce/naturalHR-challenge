<?php
  echo 'hello world<br />';
  $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
  $segments = explode('/', $path);

  echo $method = $segments[1];
  $function = (isset($segments[2])) ? $segments[2] : 'index';

  if(file_exists('application/' . $method)){
    include 'application/' . $method;

    $req = new $method();
    var_dump($req);
  }else{
    echo 'hello2';
  }

 ?>
