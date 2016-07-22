<?php
/*
route: /bot/getid
parameter: owner,name
description: get botid from owner's name and botname
*/
$app->get('/getid', function() use ($app,$config,$pdo) {
  $owner = $app->request->get("owner");
  $name = $app->request->get("name");
  $query = $pdo
            ->select()
            ->from("bot_info")
            ->where('user_name','=',$owner,'AND')
            ->where('bot_name','=',$name)
            ->join('user','user.user_id','=','bot_info.bot_ownerid');
  $result = $query->execute();
  if($result->rowCount()!=0){
    $result = $result->fetch();
    $app->render(200,array(
      'id' => $result['botid'],
    ));
  }else{
    $app->render(400,array(
      'error_code'=>14,
      'message'=>'bot not found',
    ));
  }
});
?>
