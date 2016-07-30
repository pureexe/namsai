<?php
/*
route: /bot/story/get
parameter: botid,token
TODO: Prevent cross Access control hack for private 1not implement yet
*/
$app->get('/get',function() use ($app,$config,$pdo){
  $token = $app->request->get("token");
  $botid = $app->request->get("botid");
  if($botid){
    $query = $pdo->select()
              ->from('story')
              ->where('bot_id','=',$botid);
    $query->execute();
    $result = $query->execute()->fetchAll();
    $storyData = array();
    foreach ($result as $row) {
      $out = array(
        'id'=>$row["story_id"],
        'name'=>$row["story_name"],
      );
      $storyData[] = $out;
    }
    $app->render(200,array(
      'id'=>intval($botid),
      'story'=>$storyData
    ));
  }else{
    $app->render(400,array(
      'error_code' => 12,
      'message' => 'botid is require',
    ));
  }
});
?>
