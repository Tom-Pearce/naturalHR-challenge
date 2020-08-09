<?php
  $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
  $segments = explode('/', $path);

  $class = (isset($segments[1]) && $segments[1]) ? ucfirst($segments[1]) : 'Auth';
  $function = (isset($segments[2])) ? $segments[2] : 'index';
  $params = array_slice($segments, 2);

	error_reporting(-1);
	ini_set('display_errors', 1);
  if(file_exists('application/' . $class . '.php')){
    require_once('application/' . $class . '.php');

    $req = new $class();
    call_user_func_array(array(&$req, $function), $params);
  }else{
    http_response_code(404);
  }

 ?>
