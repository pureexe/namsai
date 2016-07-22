<?php
$app->post('/add',function() use ($app,$config,$pdo){
  $token = $app->request->post("token");
  $botname = $app->request->post("name");
  $description = $app->request->post("description");
  $private = 0;
  $privatepost = $app->request->post("private");
  if($privatepost && $privatepost == "true" ){
    $private = 1;
  }
  $isFailed = false;
  if(!$token||!$botname||!$description){
    $app->render(400,array(
      'error_code' => 5,
      'message' => 'require parameter token,name and description',
    ));
  }else{
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
      $query = $pdo->select()->from("bot_info")->whereMany(array('bot_ownerid' => $userid, 'bot_name' => $botname), '=');;
      $result = $query->execute();
      if($result->rowCount()!=0){
        $app->render(400,array(
          'error_code' => 7,
          'message' => 'bot name '.$botname.' is already exist',
        ));
      }else{
        $query = $pdo
          ->insert(array('bot_ownerid', 'bot_name','bot_description','bot_private'))
          ->into('bot_info')
          ->values(array($userid,$botname,$description,$private));
        $result = $query->execute();
        $lastid = $pdo->lastInsertId();
        $app->render(200,array(
          'id'=> "".$lastid,
          'name'=> $botname,
          'message' => 'add bot name '.$botname.' success',
        ));
      }
    }
  }
});
?>
