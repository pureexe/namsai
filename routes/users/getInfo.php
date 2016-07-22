<?php
$app->get('/:user',function($username) use ($app,$config,$pdo){
  $query = $pdo->select()->from("user")->where("user_name","=",$username);
  $result = $query->execute();
  if($result->rowCount()!=0){
    $result = $result->fetch();
    $user_id = $result["user_id"];
    $query = $pdo->select()->from("bot_info")->where("bot_ownerid","=",$user_id);
    $result = $query->execute()->fetchAll();
    $botData = array();
    foreach ($result as $row) {
      $out = array(
        'id'=>$row["bot_id"],
        'name'=>$row["bot_name"],
        'description'=>$row["bot_description"],
      );
      $botData[] = $out;
    }
    $app->render(200,array(
      'id'=>$user_id,
      'username'=>$username,
      'bot'=>$botData
    ));
  }else{
    $app->render(400,array(
      'error_code' => '10',
      'message'=>'username '+$username+' isn\'t found',
    ));
  }
});

?>
