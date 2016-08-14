<?php
/*
Retivive Repo data from DB
GET: /v1/repos/:user/:repo
PARAMETER:
  - access_token (Optional for private repo only)
RESPONSE:
  - id (repo's id)
  - name
  - description
  - private (boolean)
*/
$app->get('/:user/:repo',function($username,$reponame) use ($app,$config,$pdo){
  $access_token = $app->request->get('access_token');
  $userId = null;
  if($access_token){
    $userId = jwtToUserId($access_token);
  }
  $repoId = getRepoId($username,$reponame,$userId);
  if(!$repoId){
    $app->render(404,array(
      'error'=> array(
        'code' => 13,
        'message' => 'respository '.$username.'/'.$reponame.' isn\'t found',
      ),
    ));
  }else{
    $query = $pdo
      ->select()
      ->from('repo')
      ->where('repo_id','=',$repoId);
    $result = $query->execute()->fetch();
    $app->render(200,array(
      'id'=>intval($result['repo_id']),
      'name'=>$result['repo_name'],
      'description'=>$result['repo_description'],
      'private'=>($result['repo_private']==1)?true:false,
    ));
  }
});
?>
