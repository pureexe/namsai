<?php
/*
Remove Exist repo
DELETE: /v1/repos/:user/:repo
PARAMETER:
  - access_token
RESPONSE:
  - id (repo's id)
*/
$app->delete('/:user/:repo',function($username,$reponame) use ($app,$config,$pdo){
  $access_token = $app->request->delete('access_token');
  $userId = jwtToUserId($access_token);
  if(!$userId){
    $app->render(401,array(
       'error' => array(
         'code' => 401,
         'message' => 'access_token is invalid'
       )
    ));
  }else{
    $repoId = findRepoId($username,$reponame);
    $query = $pdo
      ->select()
      ->from('repo')
      ->where('repo_id','=',$repoId)
      ->where('repo_ownerid','=',$userId);
    $result = $query->execute();
    if($result->rowCount()==0){
      $app->render(401,array(
         'error' => array(
           'code' => 14,
           'message' => 'only owner can delete repository'
         )
      ));
    }else{
      $query = $pdo
        ->delete()
        ->from('repo')
        ->where('repo_id', '=', $repoId);
      $query->execute();
      $app->render(200,array(
         'id'=>intval($repoId)
      ));
    }
  }
});
?>
