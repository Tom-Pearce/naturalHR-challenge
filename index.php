<?php
  // Get URL
  $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
  // Get segments
  $segments = explode('/', $path);

  // Find class witihn and UCfirst to comply with standards/load class
  $class = (isset($segments[1]) && $segments[1]) ? ucfirst($segments[1]) : 'Auth';
  $function = (isset($segments[2])) ? $segments[2] : 'index';
  // Slice any params out of the array
  $params = array_slice($segments, 2);

	error_reporting(-1);
	ini_set('display_errors', 1);
  // Check if file exists
  if(file_exists('application/' . $class . '.php')){
    require_once('application/' . $class . '.php');

    $req = new $class();
    // Call specified function 
    call_user_func_array(array(&$req, $function), $params);
  }else{
    http_response_code(404);
  }

 ?>
