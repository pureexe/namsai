<?php
$app->group('/edge', function () use ($app,$config,$pdo) {
  require("add.php");
  require("remove.php");
});
?>
