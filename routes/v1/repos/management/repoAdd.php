<?php
/*
//TODO: check name avaliable support for contributor
Create new repository
POST: /repos/:user/:repo
PARAMETER:
  - access_token
  - name
  - description
  - private (boolean)
RESPONSE:
  - id (repo's id)
*/
$app->post('/',function() use ($app,$config,$pdo){
  $access_token = $app->request->post('access_token');
  $name = $app->request->post('name');
  $description = $app->request->post('description');
  $private = 0;
  $privatepost = $app->request->post('private');
  if($privatepost && $privatepost == 'true' ){
    $private = 1;
  }
  $isFailed = false;
  if(!$access_token||!$name||!$description){
    $app->render(400,array(
      'error'=> array(
        'code' => 10,
        'message' => 'require parameter access_token,name and description',
      ),
    ));
  }else{
    $userid = jwtToUserId($access_token);
    if(!$userid){
      $app->render(401,array(
         'error' => array(
           'code' => 401,
           'message' => 'access_token is invalid'
         )
      ));
    }else{
      if(!ctype_alnum($name)){
        $app->render(400,array(
          'error'=> array(
            'code' => 11,
            'message' => 'name must contain english alphabelt and number only',
          ),
        ));
      }else{
        $query = $pdo
          ->select()
          ->from('repo')
          ->where('repo_ownerid','=',$userid)
          ->where('repo_name','=',$name);
        $result = $query->execute();
        if($result->rowCount()!=0){
          $app->render(400,array(
            'error'=> array(
              'code' => 11,
              'message' => 'respository name '.$name.' isn\'t avaliable',
            ),
          ));
        }else{
          $query = $pdo
            ->insert(array('repo_ownerid', 'repo_name','repo_description','repo_private'))
            ->into('repo')
            ->values(array($userid,$name,$description,$private));
          $result = $query->execute();
          $app->render(200,array(
            'id'=> intval($pdo->lastInsertId()),
          ));
        }
      }
    }
  }
});
?>
