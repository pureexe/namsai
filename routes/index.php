<?php
  //route: /
  $app->get('/', function() use ($app) {
    $app->render(200,array(
      'message' => 'NAMSAI RESTful system'
    ));
  });
  $app->get('/test', function() use ($app,$database) {
    $app->render(200,array(
      'message' => User::get(1)
    ));
  });
  require('v1/index.php');
?>
