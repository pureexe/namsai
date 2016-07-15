<?php
$app->post('/add',function() use ($app){
  $token = $app->request->post("token");
  $botname = $app->request->post("name");
  $description = $app->request->post("description");
  $isFailed = false;
  require("helper/pdo.php");
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
      $query = $pdo->select()->from("bot_info")->whereMany(array('ownerid' => $userid, 'name' => $botname), '=');;
      $result = $query->execute();
      if($result->rowCount()!=0){
        $app->render(400,array(
          'error_code' => 7,
          'message' => 'bot name '.$botname.' is already exist',
        ));
      }else{
        $query = $pdo
          ->insert(array('ownerid', 'name','description'))
          ->into('bot_info')
          ->values(array($userid,$botname,$description));
        $result = $query->execute();
        $lastid = $pdo->lastInsertId();
        $app->render(200,array(
          'id'=> "".$lastid,
          'message' => 'add bot name '.$botname.' success',
        ));
      }
    }
  }
});
?>
