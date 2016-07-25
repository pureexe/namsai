<?php
/*
get botid from owner's name and botname
route: /bot/getid
parameter: owner,name
*/
$app->get('/getid', function() use ($app,$config,$pdo) {
  $owner = $app->request->get("owner");
  $name = $app->request->get("name");
  $query = $pdo
            ->select()
            ->from("bot")
            ->where('user_name','=',$owner,'AND')
            ->where('bot_name','=',$name)
            ->join('user','user.user_id','=','bot.bot_ownerid');
  $result = $query->execute();
  if($result->rowCount()!=0){
    $result = $result->fetch();
    $app->render(200,array(
      'id' => $result['bot_id'],
    ));
  }else{
    $app->render(400,array(
      'error_code'=>14,
      'message'=>'bot not found',
    ));
  }
});
?>
