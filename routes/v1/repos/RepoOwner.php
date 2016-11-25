<?php
/*
get repo info
POST: /v1/repos
PARAMETER:
  - (NONE)
RESPONSE:
  - id
*/
$app->get('/repos/:name/owner',function($repoName) use ($app){
  $repoData = Repo::get($repoName);
  if(!$repoData){
    $app->render(404,ErrorCode::get(10));
  }
  $ownerData = User::get($repoData['owner']);
  $app->render(200, $ownerData);
});
?>
