<?php
  require("vendor/autoload.php");
  $app = new \Slim\Slim();
  //$app->config('debug', false); // reenable in production
  $app->view(new \JsonApiView());
  $app->add(new \JsonApiMiddleware());
  require("helper/jwt.php");
  $app->get('/', function() use ($app) {
    $app->render(200,array(
      'message' => 'welcome to NAMSAI rest api system',
    ));
  });
  require("routes/user.php");
  require("routes/auth.php");
  require("routes/bot.php");
  $app->run();
?>
