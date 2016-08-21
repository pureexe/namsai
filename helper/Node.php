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

}
?>
