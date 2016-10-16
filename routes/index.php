<?php
  //route: /
  $app->get('/', function() use ($app) {
    $app->render(200,array(
      'message' => 'NAMSAI RESTful system'
    ));
  });
  $app->get('/test', function() use ($app) {
    $app->render(200,array(
      'data'=>is_numeric("1.1ก"),
    ));
  });
  require('v1/index.php');
?>
