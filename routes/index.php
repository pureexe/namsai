<?php
  //route: /
  $app->get('/', function() use ($app) {
    $app->render(200,array(
      'message' => 'NAMSAI RESTful system'
    ));
  });
  $app->get('/test', function() use ($app,$database) {
    $database->insert('user', [
        'email' => 'box@pureapp.in.th',
        'username' => 'box',
        'name' => "Injection '",
        'bio' => ['en', 'fr', 'jp', 'cn']
    ]);
  });
  require('v1/index.php');
?>
