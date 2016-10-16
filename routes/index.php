<?php
  //route: /
  $app->get('/', function() use ($app) {
    $app->render(200,array(
      'message' => 'NAMSAI RESTful system'
    ));
  });
  $app->get('/test', function() use ($app) {
    $input = $app->request->get('input');
    $app->render(200,array(
      'data'=>IrinLang::escape("\\*"),
    ));
  });
  require('v1/index.php');
?>
