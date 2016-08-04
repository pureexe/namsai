<?php
/*
make edge link
route: /bot/edge/add
parameter: node_id,node_next,edge_order
//TODO: check Access control cross on insert
//TODO: check type is pattern response webhook etc.
*/
$app->post('/add',function() use ($app,$config,$pdo){
  $token = $app->request->post("token");
  $node_id = $app->request->post("node_id");
  $node_next = $app->request->post("node_next");
  $edge_order = $app->request->post("edge_order");
  if(isset($token) && isset($node_id) && isset($node_next)){
    $userid = jwtToUserId($token);
    if(!$userid){
      $app->render(401,array(
        'error_code' => 6,
        'message' => 'token has been expire',
      ));
    }else{
      if($edge_order){
        $query = $pdo->insert(array('node_id','node_next','edge_order'))
                  ->into('edge')
                  ->values(array($node_id,$node_id,$edge_order));
      }else{
        $query = $pdo->insert(array('node_id','node_next'))
                  ->into('edge')
                  ->values(array($node_id,$node_next));
      }
      $query->execute();
      $lastid = $pdo->lastInsertId();
      $app->render(200,array(
        'id' => intval($lastid),
        'message' => 'add new edge complete',
      ));
    }
  }else{
    $app->render(400,array(
      'error_code' => 15,
      'message' => 'node_id, node_next and token are require',
    ));
  }
});
?>
