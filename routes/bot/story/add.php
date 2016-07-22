<?php
/*
TODO: Prevent cross Access control hack not implement yet
*/
$app->post('/add',function() use ($app,$config,$pdo){
  $token = $app->request->post("token");
  $name = $app->request->post("name");
  $botid = $app->request->post("botid");
  if(!$name){
    $name="";
  }
  if($token&&$botid){
    try{
      $userid = jwtToUserId($token);
    }catch(ErrorException $e){
      $app->render(400,array(
        'error_code' => 0,
        'message' =>  ''.$e,
      ));
    }
    if(!$userid){
      $app->render(401,array(
        'error_code' => 6,
        'message' => 'token has been expire',
      ));
    }else{
      $query = $pdo->insert(array('bot_id','story_name'))
                ->into('bot_story')
                ->values(array($botid,$name));
      $query->execute();
      $lastid = $pdo->lastInsertId();
      $app->render(200,array(
        'id' => $lastid,
        'message' => 'add new story complete',
      ));
    }
  }else{
    $app->render(400,array(
      'error_code' => 12,
      'message' => 'token and botid is require',
    ));
  }
});
?>
