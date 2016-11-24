<?php
  //route: /
  $app->get('/', function() use ($app) {
    $app->render(200,array(
      'message' => 'NAMSAI RESTful system'
    ));
  });
  $app->get('/test', function() use ($app,$database) {
    $database->get('user', [
        'username' => 'pureexe',
        'username' => 'box',
        'name' => "Injection '",
        'bio' => ['en', 'fr', 'jp', 'cn']
    ]);
  });
  require('v1/index.php');
?>
