<?php
$app->group('/user', function () use ($app) {
  require("/user/register.php");
});
?>
