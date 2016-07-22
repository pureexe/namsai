<?php
$app->group('/users', function () use ($app) {
  require("/users/register.php");
  require("/users/getInfo.php");
});
?>
