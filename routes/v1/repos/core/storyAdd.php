<?php
/*
สร้างหัวข้อเรื่องใหม่
POST: /repos/:user/:repo/stories
PARAMETER:
  - name (optional)
  - access_token
RESPONSE:
  - id (story's id)
*/
$app->post('/:user/:repo/stories',function($username,$reponame) use ($app,$config,$pdo){
  $access_token = $app->request->post('access_token');
  $name = $app->request->post("name");
  if($access_token){
    if(!$name){
      $name = "";
    }
    $userid = jwtToUserId($access_token);
    if(!$userid){
      $app->render(401,array(
         'error' => array(
           'code' => 401,
           'message' => 'access_token is invalid'
         )
      ));
    }else{
      if($repoId = Repo::getId($username,$reponame,$userid)){
        $result = Story::add($repoId,$name);
        $app->render(200,array(
          'id' => intval($result),
        ));
      }else{
        $app->render(400,array(
           'error' => array(
             'code' => 13,
             'message' => 'respository '.$username.'/'.$reponame.' isn\'t found'
           )
        ));
      }
    }
  }else{
    $app->render(400,array(
       'error' => array(
         'code' => 25,
         'message' => 'access_token is require'
       )
    ));
  }
});

?>
