<?php
$app->group('/users', function () use ($app,$config,$pdo) {
  require("register.php");
  require("getInfo.php");
});
?>
