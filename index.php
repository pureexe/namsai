<?php
  require("vendor/autoload.php");
  $app = new \Slim\Slim();
  //$app->config('debug', false); // reenable in production
  $app->view(new \JsonApiView());
  $app->add(new \JsonApiMiddleware());
  $app->add(new \CorsSlim\CorsSlim());
  require("config.php");
  require("helper/jwt.php");
  require("helper/pdo.php");
  require("routes/index.php");
  $app->run();
?>
