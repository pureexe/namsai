<?php
  require("vendor/autoload.php");
  require("helper/JsonRenderView.php");
  require("helper/JsonRenderMiddleware.php");
  $app = new \Slim\Slim();
  //$app->config('debug', false); // reenable in production
  $app->view(new \JsonRenderView());
  $app->add(new \JsonRenderMiddleware());
  $app->add(new \CorsSlim\CorsSlim());
  require("config.php");
  require("helper/jwt.php");
  require("helper/pdo.php");
  require("routes/index.php");
  $app->run();
?>
