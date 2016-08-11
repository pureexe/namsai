<?php
$app->group('/users', function () use ($app,$config,$pdo) {
  require("getUsers.php");
  require("register.php");
});
?>
