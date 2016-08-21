<?php
/*
เปลี่ยนค่าโหนดเดิม
POST: /repos/:user/:repo/node/:id
PARAMETER:
  - access_token
  - value
RESPONSE:
  - id (node's id)
*/
$app->post('/:user/:repo/nodes/:id',function($username,$reponame,$nodeId) use ($app,$config,$pdo){
  $access_token = $app->request->post('access_token');
  $value = $app->request->post("value");
  if($access_token && $value){
    $userid = jwtToUserId($access_token);
    if(!$userid){
      $app->render(401,array(
         'error' => array(
           'code' => 401,
           'message' => 'access_token is invalid'
         )
      ));
    }else{
      if(Repo::getId($username,$reponame,$userid)){
        Node::update($nodeId,$value);
        $app->render(200,array(
          'id' => intval($nodeId),
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
         'code' => 24,
         'message' => 'value and access_token are require'
       )
    ));
  }
});
?>
