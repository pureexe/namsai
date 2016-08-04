<?php
/*
insert new knowledge node
route: /bot/node/add
parameter: storyid,value,type,token,
//TODO: check Access control cross on insert
//TODO: check type is pattern response webhook etc.
*/
$app->post('/add',function() use ($app,$config,$pdo){
  $token = $app->request->post("token");
  $value = $app->request->post("value");
  $storyid = $app->request->post("story_id");
  $type = $app->request->post("type");
  if($token&&$storyid&&$type){
    if(!$value){
      $value = "";
    }
    $userid = jwtToUserId($token);
    if(!$userid){
      $app->render(401,array(
        'error_code' => 6,
        'message' => 'token has been expire',
      ));
    }else{
      $query = $pdo->insert(array('node_storyid','node_type','node_value'))
                ->into('node')
                ->values(array($storyid,$type,$value));
      $query->execute();
      $lastid = $pdo->lastInsertId();
      $app->render(200,array(
        'id' => intval($lastid),
        'message' => 'add new node complete',
      ));
    }
  }else{
    $app->render(400,array(
      'error_code' => 15,
      'message' => 'storyid,type and token are require',
    ));
  }
});
?>
