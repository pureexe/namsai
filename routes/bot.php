<?php
$app->group('/bot', function () use ($app) {
  require("bot/add.php");
  require("bot/list.php");
  require("bot/search.php");
  require("bot/remove.php");
});
?>
