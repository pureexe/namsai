<?php
class Story
{
  /*
  add: create new story to system
  */
  public static function add($repoId,$storyName = '',$order = null){
    global $database;
    if($order == null){
      $order = self::getMaxOrder($repoId)+1;
    }
    $data = array(
      'repoid' => $repoId,
      'name' => $storyName,
      'priority' => $order
    );
    $storyId = $database->insert('story',$data);
    return intval($storyId);
  }
  public static function get($storyId){
    global $database;
    $data = $database->get(
      'story',
      array('id','name','repoid','priority(order)'),
      array('id'=>$storyId)
    );
    $data['id']=intval($data['id']);
    $data['repoid']=intval($data['repoid']);
    $data['order']=intval($data['order']);
    return $data;
  }
  public static function getRepoId($storyId){
  }
  /*
  remove: just remove story record but keep store other data
  Don't be confuse with delete
  */
  public static function remove($storyId){
  }
  /*
  delete: delete all data that have relation with story
  Don't be confuse with remove
  */
  public static function delete($storyId){
  }


  public static function update($storyId,$name){

  }
  /*
  isExist: check storyId is exist
  if pass repoId it mean isExist $storyId in $repoId (Check for prevent cross query)
  */
  public static function isExist($storyId,$repoId = null){
    global $database;
    if($repoId != null){
      return $database->has('story',array(
        'AND'=>array(
            'id'=>$storyId,
            'repoid'=>$repoId,
        )
      ));
    }else{
      return $database->has('story',array('id'=>$storyId));
    }
  }
  /*
  getMaxOrder: when you add new story
  you must sure that order is unique for every repo
  */
  public static function getMaxOrder($repoId){
    global $database;
    $maxId = $database->get('story','priority',array(
      'repoid' => $repoId,
      'ORDER' => array(
        'priority' => 'DESC'
      )
    ));
    return intval($maxId);
  }
  public static function isExistOrder($repoId,$order){
    global $database;
    return $database->has('story',array(
      'repoid' => $repoId,
      'priority' => $order
    ));
  }
  public static function getList($repoId){
    global $database;
    $where = array('ORDER'=>array(
      'priority' => 'DESC'
    ));
    $fields = array('id','name','priority');
    $data = $database->select('story',$fields,$where);
    foreach ($data as $key => $value) {
      $data[$key]['id'] = intval($data[$key]['id']) ;
      $data[$key]['order'] = intval($data[$key]['priority']);
      unset($data[$key]['priority']);
    }
    return $data;
  }
  /*
  getKnowledge
  //TODO: must render sort by edge order
  */
  public static function getKnowledge($storyId){

  }
  public static function getRoot($storyId){
  }
}
?>
