<?php
/*
use for update story name
TODO: Prevent cross Access control hack not implement yet
*/
$app->post('/update',function() use ($app,$config,$pdo){
  $token = $app->request->post("token");
  $name = $app->request->post("name");
  $storyid = $app->request->post("storyid");
  if($token&&$name&&$storyid){
    $userid = jwtToUserId($token);
    if(!$userid){
      $app->render(401,array(
        'error_code' => 6,
        'message' => 'token has been expire',
      ));
    }else{
      $query = $pdo->update(array('story_name' => $name))
                ->table('story')
                ->where('story_id',"=",$storyid);
      $query->execute();
      $app->render(200,array(
        'id' => intval($storyid),
        'name' => $name,
        'message' => 'update story name complete',
      ));
    }
  }else{
    $app->render(400,array(
      'error_code' => 16,
      'message' => 'storyid,name and token are require',
    ));
  }
});
?>
