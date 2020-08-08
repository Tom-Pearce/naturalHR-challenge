<?php
  echo 'hello world<br />';
  $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
  $segments = explode('/', $path);

  echo '<pre>';
  var_dump($_SERVER['REQUEST_URI']);
  var_dump($path);
  var_dump($segments);
  // var_dump($path);
  echo $segments[0];

  echo '</pre>';
 ?>
