<?php
require("config.php");
$pdo = new \Slim\PDO\Database(
  $config["db"]["host"],
  $config["db"]["user"],
  $config["db"]["password"]
);
?>
