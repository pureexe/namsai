<?php
/*
สนทนากับบอท
POST: /repos/:repo/messages
PARAMETER:
  - id (interactive's id)
  - input
RESPONSE:
  - (array)message
*/
$app->post('/repos/:repo/messages',function($repo) use ($app){
  $senderId = $app->request->post('id');
  $input = $app->request->post('input');
  if(Repo::isExist($repo)){
    $app->render(400,ErrorCode::get(10));
    return ;
  }
  if(!isset($input)){
    $app->render(400,ErrorCode::get(29));
    return ;
  }
  if(!isset($senderId)){
    //Not recommend to leave id blank it use to identify user
    //Will use IP for compatiable but strongly don't recommend because
    //User who use nat will get same account data
    $senderId = 'IP_'.$app->request->getIp();
  }
  $response = Response::get($repoId,$senderId,$input);
  if($response != null){
    $app->render(200,array(
      'message'=>$response
    ));
  }else{
    $app->render(400,ErrorCode::get(39));
  }
});
?>
