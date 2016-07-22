<?php
$app->get('/:user',function($username) use ($app){
  require("helper/pdo.php");
  $query = $pdo->select()->from("user")->where("username","=",$username);
  $result = $query->execute();
  if($result->rowCount()!=0){
    $result = $result->fetch();
    $user_id = $result["id"];
    $query = $pdo->select()->from("bot_info")->where("ownerid","=",$user_id);
    $result = $query->execute()->fetchAll();
    $botData = array();
    foreach ($result as $row) {
      $out = array(
        'id'=>$row["id"],
        'name'=>$row["name"],
        'description'=>$row["description"],
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
