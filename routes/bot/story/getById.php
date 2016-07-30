<?php
/*
route: /bot/story/get/:id
parameter: botid,token
TODO: Prevent cross Access control hack for private not implement yet
*/
$app->get('/get/:id',function($id) use ($app,$config,$pdo){
  $token = $app->request->get("token");
  if($id){
    $query = $pdo->select()->from("story")->where("story_id","=",$id);
    $result = $query->execute();
    if($result->rowCount()!=0){
      $storyData = $result->fetch();
      $query = $pdo->prepare("SELECT * FROM `edge` WHERE `node_id` = '0' AND node_next = ANY (SELECT `node_next` FROM `node` WHERE `node_storyid` = ?)");
      $query->execute(array($id));
      $result = $query->fetch();
      if($result != false){
        $tree = array();
        $getTreeFromDB = function ($node_id,&$cursor) use ($pdo,&$getTreeFromDB){
          $query = $pdo->select()->from("node")->where("node_id","=",$node_id);
          $result = $query->execute()->fetch();
          $cursor['type'] = $result['node_type'];
          $cursor['value'] = $result['node_value'];
          $query = $pdo->select()->from("edge")->where("node_id","=",$node_id);
          $result = $query->execute();
          if($result->rowCount()!=0){
            $cursor['next']=array();
            $cursor=&$cursor['next'];
            foreach ($result->fetchAll() as $row) {
              $cursor[] = array();
              $getTreeFromDB($row["node_next"],$cursor[count($cursor)-1]);
            }
          }
        };
        $getTreeFromDB($result["node_next"],$tree);
        $app->render(200,array(
          'id'=>$storyData['story_id'],
          'name'=>$storyData['story_name'],
          'graph'=>$tree
        ));
      }else{
        $app->render(200,array(
          'id'=>$storyData['story_id'],
          'name'=>$storyData['story_name'],
          'graph'=>NULL
        ));
      }
    }else{
      $app->render(404,array(
        'message'=>'id not found',
      ));
    }
  }else{
    $app->render(400,array(
      'error_code' => 12,
      'message' => 'id is require',
    ));
  }
});
?>
