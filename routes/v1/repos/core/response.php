<?php
/*
สนทนากับบอท
POST: /repos/:user/:repo/responses
PARAMETER:
  - id (interactive's id)
  - input
RESPONSE:
  - message
*/
$app->post('/:user/:repo/responses',function($username,$reponame) use ($app,$config,$pdo){
  Repo::forceGetId()
});
?>
