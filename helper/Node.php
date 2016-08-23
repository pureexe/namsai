<?php
class Node{
  /*
  add Node
  $Data = array($storyid,$type,$value);
  */
  public static function add($Data){
    global $pdo;
    $query = $pdo->insert(array('node_storyid','node_type','node_value'))
              ->into('node')
              ->values($Data);
    $query->execute();
    return $pdo->lastInsertId();
  }
  /*
  update node value
  */
  public static function update($nodeId,$value){
    global $pdo;
    $query = $pdo
      ->update(array('node_value' => $value))
      ->table('node')
      ->where('node_id', '=', $nodeId);
    $result = $query->execute();
  }
  /*
  delete node
  //TODO: must automatic unlink when remove node
  */
  public static function remove($nodeId){
    global $pdo;
    $query = $pdo
      ->delete()
      ->from('node')
      ->where('node_id', '=', $nodeId);
    $query->execute();
  }
  /*
  isExist node
  */
  public static function isExist($nodeId){
    global $pdo;
    $query = $pdo
      ->select()
      ->from('node')
      ->where('node_id','=',$nodeId);
    $result = $query->execute();
    return ($result->rowCount()!=0)?true:false;
  }
  /*
  get node
  */
  public static function get($nodeId){
    global $pdo;
    $query = $pdo
      ->select()
      ->from('node')
      ->where('node_id','=',$nodeId);
    $result = $query->execute();
    if($result->rowCount()==0){
      return null;
    }else{
      $result = $result->fetch();
      $story = Story::get($result['node_storyid']);
      $out = array(
        'id'=>intval($result['node_id']),
        'type'=>$result['node_type'],
        'value'=>$result['node_value'],
      );
      if($story){
        $out['story']=$story;
      }
      return $out;
    }
  }
}
?>
