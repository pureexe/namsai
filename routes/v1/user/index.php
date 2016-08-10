<?php
$app->group('/user', function () use ($app,$config,$pdo) {
  require("register.php");
  require("getInfo.php");
});
?>
