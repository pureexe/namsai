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
}
?>
