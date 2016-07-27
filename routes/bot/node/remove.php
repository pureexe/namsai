<?php
/*
remove note with automatic unlink and rejoin
route: /bot/node/remove
parameter: storyid,value,type,token,
//TODO: check Access control cross on insert
*/
$app->post('/remove',function() use ($app,$config,$pdo){
  $node_id=   $storyid = $app->request->post("node_id");
  $token = $app->request->post("token");
  if($token&&$node_id){
    $userid = jwtToUserId($token);
    if(!$userid){
      $app->render(401,array(
        'error_code' => 6,
        'message' => 'token has been expire',
      ));
    }else{
      //TODO: impletement remove and rejoin node and edge
    }
  }else{
    $app->render(400,array(
      'error_code' => 17,
      'message' => 'node_id and token are require',
    ));
  }
});
?>
