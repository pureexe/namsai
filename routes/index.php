<?php
  //route: /
  $app->get('/', function() use ($app) {
    $app->render(200,array(
      'message' => 'NAMSAI RESTful system'
    ));
  });
  $app->get('/test', function() use ($app) {

  });
  require('v1/index.php');
?>
