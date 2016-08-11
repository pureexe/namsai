<?php
$app->group('/users', function () use ($app,$config,$pdo) {

  require("register.php");
  require("changePassword.php");
  require("changeFullname.php");
  require("changeEmail.php");
  require("changeBio.php");
  //Use wildcard must be buttom
  require("getUsers.php");
});
?>
