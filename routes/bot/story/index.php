<?php
$app->group('/story', function () use ($app,$config,$pdo) {
  require("add.php");
  require("remove.php");
  require("update.php");
  require("get.php");
  require("getByid.php");
});
?>
