<?php
/*
delete repo
DELETE: /v1/repos
PARAMETER:
  - access_token
RESPONSE:
  - id
*/
$app->delete('/repos/:name',function($reponame) use ($app){
  $access_token = $app->request->post("access_token");

  if(!isset($access_token)){
    $app->render(400,ErrorCode::get(1));
    return;
  }
  $userId = Authen::getId($access_token);
  if($userId == null){
    $app->render(400,ErrorCode::get(2));
  }
  $repoData = Repo::get($reponame);
  if($repoData == null){
    $app->render(400,ErrorCode::get(10));
    return;
  }
  if($repoData['owner']!=$userId){
    $app->render(400,ErrorCode::get(3));
    return;
  }
  Repo::delete($repoData['id']);
  $app->render(200,array(
    'id'=>intval($repoData['id'])
  ));
});
?>
