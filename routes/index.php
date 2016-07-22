<?php
  //route: /
  // LEAVE group path empyty for prevent error
  $app->group('', function () use ($app,$config,$pdo) {
    $app->get('/', function() use ($app) {
      $app->render(200,array(
        'message' => 'NAMSAI REST SYSTEM',
      ));
    });
    require("auth.php");
    require("bot/index.php");
    require("users/index.php");
  });
?>
