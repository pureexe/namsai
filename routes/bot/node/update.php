<?php
/*
update value knowledge node
route: /bot/node/update
parameter: storyid,value,type,token,
//TODO: check Access control cross on insert
//TODO: check type is pattern response webhook etc.
*/
$app->post('/update',function() use ($app,$config,$pdo){
  $token = $app->request->post("token");
  $value = $app->request->post("value");
  $nodeid = $app->request->post("nodeid");
  if($token&&$nodeid&&$value){
    $userid = jwtToUserId($token);
    if(!$userid){
      $app->render(401,array(
        'error_code' => 6,
        'message' => 'token has been expire',
      ));
    }else{
      $query = $pdo->update(array('node_value' => $value))
                ->table('node')
                ->where('node_id',"=",$nodeid);
      $query->execute();
      $app->render(200,array(
        'id' => intval($nodeid),
        'message' => 'update node value complete',
      ));
    }
  }else{
    $app->render(400,array(
      'error_code' => 15,
      'message' => 'nodeid,value and token are require',
    ));
  }
});
?>
