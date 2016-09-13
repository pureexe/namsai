<?php
  //route: /
  $app->get('/', function() use ($app) {
    $app->render(200,array(
      'message' => 'NAMSAI RESTful system'
    ));
  });
  $app->get('/test', function() use ($app) {
    $box = array();
    $app->render(200,array(
      'data'=>array_shift($box),
    ));
  });
  require('v1/index.php');
?>
