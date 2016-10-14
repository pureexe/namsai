<?php
  //route: /
  $app->get('/', function() use ($app) {
    $app->render(200,array(
      'message' => 'NAMSAI RESTful system'
    ));
  });
  $app->get('/test', function() use ($app) {
    $app->render(200,array(
      'data'=>Response::test(1,'สวัสดี'),
    ));
  });
  require('v1/index.php');
?>
