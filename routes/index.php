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
      'data'=>IrinLang::toRegex($input),
    ));
  });
  $app->get('/test2', function() use ($app) {
    $expression = "hello";
    $app->render(200,array(
      'data'=>trim(" กรา บ ส วัสดี   ")
    ));
  });
  require('v1/index.php');
?>
