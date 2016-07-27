<?php
/*
remove edge without rejoin
route: /bot/edge/remove
parameter: storyid,value,type,token,
//TODO: check Access control cross on insert
*/
$app->post('/remove',function() use ($app,$config,$pdo){
  $node_id = $app->request->post("node_id");
  $node_next = $app->request->post("node_next");
  $token = $app->request->post("token");
  if($token&&$node_id&&$node_next){
    $userid = jwtToUserId($token);
    if(!$userid){
      $app->render(401,array(
        'error_code' => 6,
        'message' => 'token has been expire',
      ));
    }else{
      $query = $pdo->delete()
                  ->from('edge')
                  ->where('node_id','=',$node_id)
                  ->where('node_next','=',$node_next);
      $result = $query->execute();
      if(intval($result)!=0){
        $app->render(200,array(
          'message' => 'unlink complete',
        ));
      }else{
        $app->render(200,array(
          'message' => 'not thing to remove',
        ));
      }
    }
  }else{
    $app->render(400,array(
      'error_code' => 18,
      'message' => 'edge_id and token are require',
    ));
  }
});
?>
