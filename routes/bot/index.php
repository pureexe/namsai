<?php
$app->group('/bot', function () use ($app,$config,$pdo) {
  $app->get('/', function() use ($app) {
    $app->render(200,array(
      'message' => 'BOT PATH',
    ));
  });
  require("add.php");
  require("getid.php");
  require("list.php");
  require("search.php");
  require("remove.php");
  require("story/index.php");
  require("node/index.php");
  require("edge/index.php");
});
?>
