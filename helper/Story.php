<?php
  class Story{
    /*
    add
    */
    public static function add($repoId,$storyName = '',$order = null){
      global $pdo;
      if($order == null){
        $order = self::getMaxOrder($repoId)+1;
      }
      $query = $pdo
        ->insert(array('story_repoid', 'story_name', 'story_order'))
        ->into('story')
        ->values(array($repoId,$storyName,$order));
      $result = $query->execute();
      return $pdo->lastInsertId();
    }
    /*
    get story id and story name
    */
    public static function get($stroyId){
      global $pdo;
      $query = $pdo
        ->select()
        ->from('story')
        ->where('story_id','=',$stroyId);
      $result = $query->execute();
      if($result->rowCount()==0){
        return null;
      }else{
        $result = $result->fetch();
        return array(
          'id'=>intval($result['story_id']),
          'name'=>$result['story_name'],
        );
      }
    }
    /*
    getRepoId
    */
    public static function getRepoId($storyId){
      global $pdo;
      $query = $pdo
        ->select()
        ->from('story')
        ->where('story_id','=',$stroyId);
      $result = $query->execute();
      if($result->rowCount()==0){
        return null;
      }else{
        return $result->fetch()['story_repoid'];
      }
    }
    /*
    remove
    //TODO: must automatic remove node and edge when remove story
    */
    public static function remove($storyId){
      global $pdo;
      $query = $pdo
        ->delete()
        ->from('story')
        ->where('story_id', '=', $storyId);
      $query->execute();
    }
  /* isExist */
  public static function isExist($storyId){
    global $pdo;
    $query = $pdo
      ->select()
      ->from('story')
      ->where('story_id','=',$storyId);
    $result = $query->execute();
    return ($result->rowCount()!=0)?true:false;
  }
  /* update */
  public static function update($storyId,$name){
    global $pdo;
    $query = $pdo
      ->update(array('story_name' => $name))
      ->table('story')
      ->where('story_id', '=', $storyId);
    $result = $query->execute();
  }
  /*getMaxOrder*/
  public static function getMaxOrder($repoId){
    global $pdo;
    $query = $pdo
      ->select()
      ->from('story')
      ->where('story_repoid','=',$repoId)
      ->orderBy('story_order','DESC')
      ->limit(1);
    $result = $query->execute();
    if($result->rowCount() == 0){
      return null;
    }else{
      return $result->fetch()['story_order'];
    }
  }
}
?>
