<?php
/*
insert new knowledge node with automatic story edge link
route: /bot/node/append
parameter: storyid,value,type,token,
//TODO: check Access control cross on insert
//TODO: check type is pattern response webhook etc.
*/
$app->post('/add',function() use ($app,$config,$pdo){
  $token = $app->request->post("token");
  $value = $app->request->post("value");
  $storyid = $app->request->post("story_id");
  $type = $app->request->post("type");
  if($token&&$storyid&&$type){
    $userid = jwtToUserId($token);
    if(!$userid){
      $app->render(401,array(
        'error_code' => 6,
        'message' => 'token has been expire',
      ));
    }else{
      //NOT IMPLEMENT YET
    }
  }else{
    $app->render(400,array(
      'error_code' => 15,
      'message' => 'storyid,value,type and token are require',
    ));
  }
});
?>
